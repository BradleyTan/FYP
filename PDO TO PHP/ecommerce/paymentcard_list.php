<?php
include 'includes/session.php';
include 'includes/conn.php'; 

$conn = mysqli_connect("localhost", "root", "", "ecomm");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$output = '';

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $query = "SELECT * FROM payment_card WHERE user_id = (SELECT id FROM users WHERE email = ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if ($count > 0) {
        $output .= "<option>Select Card</option>";
        while ($row = $result->fetch_assoc()) {
            $output .= "<option data-num='".$row['card_num']."' data-month='".$row['exp_month']."' data-year='".$row['exp_year']."' data-name='".$row['card_name']."' value='".$row['id']."'>".$row['card_name']."-".$row['card_num']."</option>";
        }
    } else {
        $output = 'No card';
    }
} else {
	header('location: login.php');
    exit();
}

mysqli_close($conn);
echo json_encode($output);
?>
