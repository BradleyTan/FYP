<?php
//PRASATH
$card_holder_name = strip_tags($_POST['name']);
$card_number = strip_tags($_POST['number']);
$expiration_month = strip_tags($_POST['ccmonth']);
$expiration_year = strip_tags($_POST['ccyear']);
$cvc = strip_tags($_POST['cvc']);

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
        "status"    => false,
        "msg" => $errors
    );
}
else
{
$card_number = 'CC - '.$card_number;
$hashed_cvv = password_hash($card_number, PASSWORD_DEFAULT);

$response = array(
    "status"    => true,
    "msg" => 'Proceed with payment process',
    "data" => $card_number
);
}
echo json_encode($response);
exit;
?>