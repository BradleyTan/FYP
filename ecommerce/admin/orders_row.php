<?php 
include 'includes/session.php';

if(isset($_POST['order_id'])){
    $id = $_POST['order_id'];
    
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=:order_id");
    $stmt->execute(['order_id'=>$id]);
    $row = $stmt->fetch();
    
    $pdo->close();


    echo json_encode($row);
}
?>

