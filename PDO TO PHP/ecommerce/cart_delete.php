<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	$output = array('error' => false);
	$id = $_POST['id'];

	if (isset($_SESSION['user'])) {
		try {
			$stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE id = ?");
			mysqli_stmt_bind_param($stmt, "i", $id);
			mysqli_stmt_execute($stmt);
			$output['message'] = 'Deleted';
		} catch (Exception $e) {
			$output['message'] = $e->getMessage();
		}
	} else {
		foreach ($_SESSION['cart'] as $key => $row) {
			if ($row['productid'] == $id) {
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}
	}

	mysqli_close($conn);
	echo json_encode($output);

	header('Location: cart_details.php');
	exit();
?>
