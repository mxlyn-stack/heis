<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    exit("Unauthorized");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    $clientname  = trim($_POST['clientname']);
    $clientemail = trim($_POST['clientemail']);
    $clientphone = trim($_POST['clientphone']);
    $company     = trim($_POST['companyname']);
    $projectname = trim($_POST['projectname']);

    $sql = "UPDATE clients 
            SET clientname='$clientname', clientemail='$clientemail', clientphone='$clientphone', company='$company', projectname='$projectname'
            WHERE id = $id AND user_id = $user_id";

    if (mysqli_query($conn, $sql)) {
        header("Location: clientpage.php?updated=1");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
