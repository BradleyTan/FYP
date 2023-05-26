<?php
include 'includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['order_id'];
    $status = $_POST['order_status'];

    $conn = $pdo->open();

    try {
        $stmt = $conn->prepare("UPDATE orders SET order_status=:order_status WHERE order_id=:order_id");
        $stmt->execute(['order_status' => $status, 'order_id' => $id]);
        $_SESSION['success'] = 'Order status updated successfully';
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }

    $pdo->close();
} else {
    $_SESSION['error'] = 'Fill up the edit order form first';
}

header('location: orders.php');
?>

