<?php
// PRASATH
include 'includes/session.php';
include 'includes/conn.php'; 

if (isset($_POST['pay'])) {
    $payid = $_POST['pay'];
    $address = $_POST['address'];
    $date = date('Y-m-d');

    $conn = mysqli_connect("localhost", "root", "", "ecomm");

    if ($conn) {
        $updateUserQuery = "UPDATE users SET street1=?, street2=?, city=?, postcode=?, state=?, country=? WHERE id=?";
        $userStmt = mysqli_prepare($conn, $updateUserQuery);
        mysqli_stmt_bind_param($userStmt, "ssssssi", $address['street1'], $address['street2'], $address['city'], $address['postcode'], $address['state'], $address['country'], $user['id']);
        $userResult = mysqli_stmt_execute($userStmt);

        if ($userResult) {
            $salesid = mysqli_insert_id($conn);
        } else {
            $_SESSION['error'] = mysqli_error($conn);
        }

        mysqli_close($conn);
    } else {
        $_SESSION['error'] = 'Failed to connect to the database.';
    }
}

$response = array(
    "status" => true,
    "msg" => 'Success'
);
echo json_encode($response);
exit;
