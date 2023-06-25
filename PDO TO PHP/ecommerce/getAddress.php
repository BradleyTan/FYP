<?php
include 'includes/session.php';
include 'includes/conn.php';

$output = array('list' => '');

if (isset($_SESSION['user'])) {
    $conn = mysqli_connect("localhost", "root", "", "ecomm");

    if (!$conn) {
        $output['error'] = mysqli_connect_error();
    } else {
        try {
            $total = 0;
            // Retrieve the user ID from the session
            $userId = $_SESSION['user']['id'];
            $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
            $stmt->bind_param('i', $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any rows are returned
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $output['first_name'] = $row['first_name'];
                    $output['contact_info'] = $row['contact_info'];
                    $output['street1'] = $row['street1'];
                    $output['street2'] = $row['street2'];
                    $output['postcode'] = $row['postcode'];
                    $output['city'] = $row['city'];
                    $output['state'] = $row['state'];
                    $output['country'] = $row['country'];
                    // Assuming the columns 'price' and 'quantity' exist in the 'users' table
                    $subtotal = $row['price'] * $row['quantity'];
                    $total += $subtotal;
                }
                $output['total'] = $total;
            } else {
                $output['error'] = "No user found with the provided ID";
            }
        } catch (Exception $e) {
            $output['error'] = $e->getMessage();
        }

        mysqli_close($conn);
    }
} else {
    $output['error'] = "User not logged in";
}

echo json_encode($output);
?>
