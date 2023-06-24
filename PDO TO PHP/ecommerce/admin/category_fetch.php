<?php
	include 'includes/session.php';
	include '../includes/conn.php';

	$output = '';

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$query = "SELECT * FROM category";
	$result = mysqli_query($conn, $query);

	while($row = mysqli_fetch_assoc($result)){
		$output .= "
			<option value='".$row['id']."' class='append_items'>".$row['name']."</option>
		";
	}

	mysqli_close($conn);
	echo json_encode($output);
?>
