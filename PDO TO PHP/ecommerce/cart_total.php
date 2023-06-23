<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	if(isset($_SESSION['user'])){
		$conn = mysqli_connect("localhost", "root", "password", "ecomm");

		$user_id = $_SESSION['user']['id'];

		$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.id=cart.product_id WHERE user_id=?");
		$stmt->bind_param('i', $user_id);
		$stmt->execute();

		$result = $stmt->get_result();

		$total = 0;
		while($row = $result->fetch_assoc()){
			$subtotal = $row['price'] * $row['quantity'];
			$total += $subtotal;
		}

		mysqli_close($conn);

		echo json_encode($total);
	}
?>
