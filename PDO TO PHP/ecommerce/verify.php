<?php
include 'includes/session.php';
include 'includes/conn.php'; 

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "", "ecomm");

    if (!$conn) {
        $_SESSION['error'] = mysqli_connect_error();
        header('location: login.php');
        exit();
    }

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['numrows'] > 0) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['status']) {
            if (password_verify($password, $row['password'])) {
                if ($row['type']) {
                    $_SESSION['admin'] = $row['id'];
                } else {
                    $_SESSION['user'] = $row['id'];
                }
            } else {
                $_SESSION['error'] = 'Incorrect Password';
            }
        } else {
            $_SESSION['error'] = 'Account not activated.';
        }
    } else {
        $_SESSION['error'] = 'Email not found';
    }

    mysqli_close($conn);
} else {
    $_SESSION['error'] = 'Input login credentials first';
}

header('location: login.php');
