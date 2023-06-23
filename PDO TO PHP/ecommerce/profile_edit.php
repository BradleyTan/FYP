<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	$curr_password = $_POST['curr_password'] ?? '';
	$email = $_POST['email'] ?? '';
	$password = $_POST['password'] ?? '';
	$firstname = $_POST['firstname'] ?? '';
	$lastname = $_POST['lastname'] ?? '';
	$contact = $_POST['contact'] ?? '';
	$address = $_POST['address'] ?? '';
	$photo = $_FILES['photo']['name'] ?? '';

	$conn = mysqli_connect("localhost", "root", "", "ecomm");

	if(isset($_POST['edit'])){
		if(!empty($curr_password) && !empty($email) && !empty($password) && !empty($firstname) && !empty($lastname) && !empty($contact) && !empty($address)){
			$curr_password = mysqli_real_escape_string($conn, $curr_password);
			$email = mysqli_real_escape_string($conn, $email);
			$password = mysqli_real_escape_string($conn, $password);
			$firstname = mysqli_real_escape_string($conn, $firstname);
			$lastname = mysqli_real_escape_string($conn, $lastname);
			$contact = mysqli_real_escape_string($conn, $contact);
			$address = mysqli_real_escape_string($conn, $address);

			$user_id = $_SESSION['user']['id'];

			$photo_path = '';

			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
				$photo_path = 'images/'.$photo;
			}

			$query = "SELECT * FROM users WHERE id = '$user_id' AND password = '$curr_password'";
			$result = mysqli_query($conn, $query);

			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_assoc($result);

				if($password == $row['password']){
					$password = $row['password'];
				}
				else{
					$password = password_hash($password, PASSWORD_DEFAULT);
				}

				$update_query = "UPDATE users SET email='$email', password='$password', firstname='$firstname', lastname='$lastname', contact_info='$contact', address='$address', photo='$photo_path' WHERE id='$user_id'";
				$update_result = mysqli_query($conn, $update_query);

				if($update_result){
					$_SESSION['success'] = 'Account updated successfully';
				}
				else{
					$_SESSION['error'] = 'An error occurred while updating the account';
				}
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
			}
		}
		else{
			$_SESSION['error'] = 'Fill up the edit form first';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up the edit form first';
	}

	mysqli_close($conn);

	header('location: profile.php');
?>
