<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	$conn = mysqli_connect("localhost", "root", "", "ecomm");

	$output = array('error' => false);

	$id = $_POST['id'];
	$qty = $_POST['qty'];

	if(isset($_SESSION['user'])){
		try{
			$stmt = $conn->prepare("UPDATE cart SET quantity=? WHERE id=?");
			$stmt->bind_param('ii', $qty, $id);
			$stmt->execute();
			$output['message'] = 'Updated';
		}
		catch(Exception $e){
			$output['message'] = $e->getMessage();
		}
	}
	else{
		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				$_SESSION['cart'][$key]['quantity'] = $qty;
				$output['message'] = 'Updated';
			}
		}
	}

	mysqli_close($conn);
	echo json_encode($output);
?>
