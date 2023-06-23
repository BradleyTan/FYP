<?php
	include('conn.php');
	session_start();

	if(isset($_SESSION['admin'])){
		header('location: admin/home.php');
	}

	if(isset($_SESSION['user'])){
		$conn = mysqli_connect("localhost", "root", "", "ecomm");

		if(!$conn){
			echo "There is some problem in connection: " . mysqli_connect_error();
		}
		else{
			$id = $_SESSION['user'];
			$query = "SELECT * FROM users WHERE id='$id'";
			$result = mysqli_query($conn, $query);
			$user = mysqli_fetch_assoc($result);

			mysqli_close($conn);
		}
	}
?>
