<?php
require_once "db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "UPDATE team_members SET status = 'inactive' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Team member set to inactive successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
