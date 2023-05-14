<?php
	include 'includes/session.php';
	$conn = $pdo->open();

	$output = '';

	if(isset($_SESSION['user'])){
		try{
			$total = 0;
			$stmt = $conn->prepare("SELECT * FROM payment_card WHERE user_id=:user");
			$stmt->execute(['user'=>$user['id']]);
            $count = $stmt->rowCount();
            $output .= "<option>Select Card</option>";
            if($count > 0)
            {
                foreach($stmt as $row){
                
                    $output .= "<option data-num='".$row['card_num']."' data-month='".$row['exp_month']."' data-year='".$row['exp_year']."' data-name='".$row['card_name']."' value='".$row['id']."'>".$row['card_name']."-".$row['card_num']."</option>";
                }
            }
            else
            {
                $output = 'No card';
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

