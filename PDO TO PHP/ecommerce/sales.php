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
        $insertSalesQuery = "INSERT INTO sales (user_id, pay_id, sales_date, ship_contact, ship_name, street1, street2, city, postcode, state, country, orderStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $salesStmt = mysqli_prepare($conn, $insertSalesQuery);
        mysqli_stmt_bind_param($salesStmt, "iissssssssss", $user['id'], $payid, $date, $address['mobile'], $address['name'], $address['street1'], $address['street2'], $address['city'], $address['postcode'], $address['state'], $address['country'], 'Pending');
        $salesResult = mysqli_stmt_execute($salesStmt);

        if ($salesResult) {
            $salesid = mysqli_insert_id($conn);

            $selectCartQuery = "SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=?";
            $cartStmt = mysqli_prepare($conn, $selectCartQuery);
            mysqli_stmt_bind_param($cartStmt, "i", $user['id']);
            mysqli_stmt_execute($cartStmt);
            $cartResult = mysqli_stmt_get_result($cartStmt);

            while ($row = mysqli_fetch_assoc($cartResult)) {
                $insertDetailsQuery = "INSERT INTO details (sales_id, product_id, quantity) VALUES (?, ?, ?)";
                $detailsStmt = mysqli_prepare($conn, $insertDetailsQuery);
                mysqli_stmt_bind_param($detailsStmt, "iii", $salesid, $row['product_id'], $row['quantity']);
                mysqli_stmt_execute($detailsStmt);
            }

            $deleteCartQuery = "DELETE FROM cart WHERE user_id=?";
            $deleteStmt = mysqli_prepare($conn, $deleteCartQuery);
            mysqli_stmt_bind_param($deleteStmt, "i", $user['id']);
            mysqli_stmt_execute($deleteStmt);

            $_SESSION['success'] = 'Transaction successful. Thank you.';
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
