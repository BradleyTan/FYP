<?php
include 'includes/session.php';
include 'includes/conn.php'; 
if (!isset($_GET['code']) || !isset($_GET['user'])) {
    header('location: index.php');
    exit();
}

$path = 'password_reset.php?code=' . $_GET['code'] . '&user=' . $_GET['user'];

if (isset($_POST['reset'])) {
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    if ($password != $repassword) {
        $_SESSION['error'] = 'Passwords did not match';
        header('location: ' . $path);
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "ecomm");

    if (!$conn) {
        $_SESSION['error'] = mysqli_connect_error();
        header('location: ' . $path);
        exit();
    }

    $code = $_GET['code'];
    $userId = $_GET['user'];

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE reset_code=? AND id=?");
    $stmt->bind_param('si', $code, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['numrows'] > 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param('si', $password, $userId);
        $stmt->execute();

        $_SESSION['success'] = 'Password successfully reset';
        header('location: login.php');
    } else {
        $_SESSION['error'] = 'Code did not match with user';
        header('location: ' . $path);
    }

    mysqli_close($conn);
} else {
    $_SESSION['error'] = 'Input new password first';
    header('location: ' . $path);
}

?>
