<?php
// PRASATH
include 'includes/session.php';
include 'includes/conn.php';

$card_holder_name = strip_tags($_POST['name']);
$card_number = strip_tags($_POST['number']);
$expiration_month = strip_tags($_POST['ccmonth']);
$expiration_year = strip_tags($_POST['ccyear']);
$cvc = strip_tags($_POST['cvc']);
$date = date('Y-m-d H:i:s');

// Validate form data
$errors = array();

if (!preg_match('/^[A-Za-z\' ]+$/', $card_holder_name)) {
    $errors[] = "Card holder name can only contain letters, apostrophes, and spaces";
}

if (!preg_match('/^\d{13,16}$/', $card_number)) {
    $errors[] = "Card number must be a 13 to 16 digit number";
}

if (!preg_match('/^(0[1-9]|1[0-2])$/', $expiration_month)) {
    $errors[] = "Expiration month must be a 2-digit number between 01 and 12";
}

if (!preg_match('/^\d{4}$/', $expiration_year)) {
    $errors[] = "Expiration year must be a 4-digit number";
}

if (!preg_match('/^\d{3}$/', $cvc)) {
    $errors[] = "CVV must be a 3-digit number";
}

if (!empty($errors)) {
    $response = array(
        "status" => false,
        "msg" => $errors
    );
} else {
    $conn = mysqli_connect("localhost", "root", "", "ecomm");
    $card_number_label = 'CC - '.$card_number;
    $hashed_cvv = password_hash($card_number, PASSWORD_DEFAULT);

    $response = array(
        "status" => true,
        "msg" => 'Proceed with payment process',
        "data" => $card_number_label
    );

    $stmt = mysqli_prepare($conn, "SELECT * FROM payment_card WHERE user_id=? AND card_num=?");
    mysqli_stmt_bind_param($stmt, 'ss', $user['id'], $card_number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $count = mysqli_num_rows($result);

    if ($count > 0) {

    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO payment_card (user_id, card_name, exp_month, exp_year, card_num, card_verify, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'issssis', $user['id'], $card_holder_name, $expiration_month, $expiration_year, $card_number, '1', $date);
        mysqli_stmt_execute($stmt);
    }

    mysqli_close($conn);
}

echo json_encode($response);
exit;
?>
