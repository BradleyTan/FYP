<?php
// PRASATH
include 'includes/session.php';

$id = $_POST['id'];

$conn = mysqli_connect("localhost", "root", "", "ecomm");

$output = array('list' => '');

if ($conn) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM details LEFT JOIN products ON products.id=details.product_id LEFT JOIN sales ON sales.id=details.sales_id WHERE details.sales_id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $output['transaction'] = $row['pay_id'];
        $output['sales_id'] = $row['sales_id'];
        $output['ship_name'] = $row['ship_name'];
        $output['ship_num'] = $row['ship_contact'];
        $output['ship_address'] = $row['street1'] . ',<br>' . $row['street2'] . ',<br>' . $row['postcode'] . ', ' . $row['city'] . ',<br>' . $row['state'] . ', ' . $row['country'];
        $output['date'] = date('M d, Y', strtotime($row['sales_date']));
        $subtotal = $row['price'] * $row['quantity'];
        $total += $subtotal;
        $output['list'] .= "
            <tr class='prepend_items'>
                <td>" . $row['name'] . "</td>
                <td>RM " . number_format($row['price'], 2) . "</td>
                <td>" . $row['quantity'] . "</td>
                <td>RM " . number_format($subtotal, 2) . "</td>
            </tr>
        ";
        // update product stock
        $new_stock = $row['products_quantity'] - $row['quantity'];
        $product_id = $row['product_id'];
        mysqli_query($conn, "UPDATE products SET products_quantity='$new_stock' WHERE id='$product_id'");
    }

    $output['total'] = '<b>RM ' . number_format($total, 2) . '</b>';
    mysqli_close($conn);
    echo json_encode($output);
} else {
    echo "Failed to connect to the database.";
}
?>
