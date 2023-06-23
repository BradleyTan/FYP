<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	$output = array('error' => false);
	$id = $_POST['id'];

	if (isset($_SESSION['user'])) {
		$stmt = $connect->prepare("DELETE FROM cart WHERE id=:id");
		$stmt->execute(['id' => $id]);
		$output['message'] = 'Deleted';
	} else {
		foreach ($_SESSION['cart'] as $key => $row) {
			if ($row['productid'] == $id) {
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}
	}

	$connect->close();
	echo json_encode($output);

	header('Location: cart_details.php');
	exit();
?>
