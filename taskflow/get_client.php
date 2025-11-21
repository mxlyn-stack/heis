<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM clients WHERE id = $id AND user_id = $user_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $client = mysqli_fetch_assoc($result);

    echo json_encode($client);
}
