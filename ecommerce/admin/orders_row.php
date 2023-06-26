<?php 
include 'includes/session.php';

if(isset($_POST['order_id'])){
    $id = $_POST['order_id'];
    
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT sales.id AS order_id, CONCAT(users.firstname, ' ', users.lastname) AS user_name, sales.sales_date AS order_date, sales.orderStatus AS order_status
                            FROM sales
                            INNER JOIN users ON sales.user_id = users.id
                            WHERE sales.id=:order_id");
    $stmt->execute(['order_id'=>$id]);
    $row = $stmt->fetch();
    
    $pdo->close();

    echo json_encode($row);
}
?>
