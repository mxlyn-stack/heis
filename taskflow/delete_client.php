<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "unauthorized";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $client_id = (int)$_POST["id"];
    $user_id = $_SESSION['user_id'];

    // First, verify the client belongs to the logged-in user
    $check_sql = "SELECT id FROM clients WHERE id = '$client_id' AND user_id = '$user_id' LIMIT 1";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) === 0) {
        echo "not_found";
        exit;
    }

    // Start transaction for safety
    mysqli_begin_transaction($conn);

    try {
        // Delete all projects linked to this client
        $delete_projects_sql = "DELETE FROM projects WHERE client_id = '$client_id'";
        mysqli_query($conn, $delete_projects_sql);

        // Then delete the client
        $delete_client_sql = "UPDATE clients SET status='deleted' WHERE id = '$client_id'";
        mysqli_query($conn, $delete_client_sql);

        // Commit all changes
        mysqli_commit($conn);

        echo "success";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "error: " . $e->getMessage();
    }
} else {
    echo "invalid_request";
}
?>
