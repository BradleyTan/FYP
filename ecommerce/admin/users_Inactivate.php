<?php
include 'includes/session.php';

if(isset($_POST['inactivate'])){
  $id = $_POST['id'];

  $conn = $pdo->open();

  try {
    $stmt = $conn->prepare("UPDATE users SET status=:status WHERE id=:id");
    $stmt->execute(['status'=>0, 'id'=>$id]);
    $_SESSION['success'] = 'User account inactivated successfully';
  } catch(PDOException $e) {
    $_SESSION['error'] = $e->getMessage();
  }

  $pdo->close();

	}
	else{
		$_SESSION['error'] = 'Select user to deactivate first';
	}

	header('location: users.php');
?>