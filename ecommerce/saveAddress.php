<?php
// PRASATH
	include 'includes/session.php';

	if(isset($_POST['pay'])){
		$payid = $_POST['pay'];
		$address = $_POST['address'];
		$date = date('Y-m-d');

		$conn = $pdo->open();
		try{
			
			$stmt = $conn->prepare("UPDATE users SET street1=:street1, street1=:street2, street1=:city, street1=:postcode, street1=:state, street1=:country  WHERE id=:id");
			$stmt->execute(['id'=>$user['id'], 'street1'=>$address['street1'], 'street2'=>$address['street2'], 'city'=>$address['city'], 'postcode'=>$address['postcode'], 'country'=>$address['country'], 'state'=>$address['state']]);
			$salesid = $conn->lastInsertId();
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