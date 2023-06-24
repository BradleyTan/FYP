<?php
include '../includes/conn.php';
session_start();

if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
    header('location: ../index.php');
    exit();
}


$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $_SESSION['admin']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$admin = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
