<?php
	include 'includes/session.php';
	include 'includes/conn.php';
	
	if (isset($_SESSION['user'])) {
		
	
		$user_id = $user['id'];
	
		$stmt = mysqli_prepare($conn, "SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=?");
		mysqli_stmt_bind_param($stmt, "i", $user_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
	
		$total = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$subtotal = $row['price'] * $row['quantity'];
			$total += $subtotal;
		}
	
		mysqli_close($conn);
	
		echo json_encode($total);
	}
	?>
	