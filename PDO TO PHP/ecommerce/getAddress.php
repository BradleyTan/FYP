<?php
// PRASATH
	include 'includes/session.php';
	$conn = $pdo->open();

	$output = array('list'=>'');

	if(isset($_SESSION['user'])){
		try{
			$total = 0;
			$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user");
			$stmt->execute(['user'=>$user['id']]);
            foreach($stmt as $row){
                $output['first_name'] = $row['ship_name'];
                $output['contact_info'] = $row['ship_contact'];
                $output['street1'] = $row['street1'];
                $output['street2'] = $row['street2'];
                $output['postcode'] = $row['postcode'];
                $output['city'] = $row['city'];
                $output['state'] = $row['state'];
                $output['country'] = $row['country'];
                $subtotal = $row['price']*$row['quantity'];
        
            }			

		}
		catch(PDOException $e){
			$output .= $e->getMessage();
		}

	}
	else{
		
		
	}

	$pdo->close();
	echo json_encode($output);

?>

