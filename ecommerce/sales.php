<?php
// PRASATH
	include 'includes/session.php';

	if(isset($_POST['pay'])){
		$payid = $_POST['pay'];
		$address = $_POST['address'];
		$date = date('Y-m-d');

		$conn = $pdo->open();
		try{
			
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date, ship_contact, ship_name, street1, street2, city, postcode, state, country, orderStatus) VALUES (:user_id, :pay_id, :sales_date, :ship_contact, :ship_name, :street1, :street2, :city, :postcode, :state, :country, :orderstatus)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date, 'ship_name'=>$address['name'], 'ship_contact'=>$address['mobile'], 'street1'=>$address['street1'], 'street2'=>$address['street2'], 'city'=>$address['city'], 'postcode'=>$address['postcode'], 'country'=>$address['country'], 'state'=>$address['state'], 'orderstatus'=>'Pending']);
			$salesid = $conn->lastInsertId();
			
			try{
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}

				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				$_SESSION['success'] = 'Transaction successful. Thank you.';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	$response = array(
        "status"    => true,
        "msg" => 'Success'
    );
	echo json_encode($response);
exit;
	
?>