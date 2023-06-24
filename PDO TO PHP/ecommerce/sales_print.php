<?php
include 'includes/session.php';
include 'includes/conn.php'; 

function generateRow($from, $to, $conn)
{
    $contents = '';

    $stmt = $conn->prepare("SELECT *, sales.id AS salesid FROM sales LEFT JOIN users ON users.id=sales.user_id WHERE sales_date BETWEEN ? AND ? ORDER BY sales_date DESC");
    $stmt->bind_param("ss", $from, $to);
    $stmt->execute();
    $result = $stmt->get_result();

    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $detailsStmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=?");
        $detailsStmt->bind_param("i", $row['salesid']);
        $detailsStmt->execute();
        $detailsResult = $detailsStmt->get_result();

        $amount = 0;
        while ($details = $detailsResult->fetch_assoc()) {
            $subtotal = $details['price'] * $details['quantity'];
            $amount += $subtotal;
        }
        $total += $amount;
        $contents .= '
        <tr>
            <td>' . date('M d, Y', strtotime($row['sales_date'])) . '</td>
            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
            <td>' . $row['pay_id'] . '</td>
            <td align="right">RM ' . number_format($amount, 2) . '</td>
        </tr>
        ';
    }

    $contents .= '
        <tr>
            <td colspan="3" align="right"><b>Total</b></td>
            <td align="right"><b>RM ' . number_format($total, 2) . '</b></td>
        </tr>
    ';
    return $contents;
}

if (strpos($_POST['date_range'], ' - ') !== false) {
    $ex = explode(' - ', $_POST['date_range']);
    $from = date('Y-m-d', strtotime($ex[0]));
    $to = date('Y-m-d', strtotime($ex[1]));
    $from_title = date('M d, Y', strtotime($ex[0]));
    $to_title = date('M d, Y', strtotime($ex[1]));

    $conn = mysqli_connect("localhost", "root", "", "ecomm");

    require_once('tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetTitle('Sales Report: ' . $from_title . ' - ' . $to_title);
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->AddPage();
    $content = '';
    $content .= '
        <h2 align="center">ShopEz</h2>
        <h4 align="center">SALES REPORT</h4>
        <h4 align="center">' . $from_title . " - " . $to_title . '</h4>
        <table border="1" cellspacing="0" cellpadding="3">
           <tr>
                <th width="15%" align="center"><b>Date</b></th>
                <th width="30%" align="center"><b>Buyer Name</b></th>
                <th width="40%" align="center"><b>Transaction#</b></th>
                <th width="15%" align="center"><b>Amount</b></th>
           </tr>
      ';
    $content .= generateRow($from, $to, $conn);
    $content .= '</table>';
    $pdf->writeHTML($content);
    $pdf->Output('sales.pdf', 'I');

    mysqli_close($conn);
} else {
    $_SESSION['error'] = 'Need date range to provide sales print';
    header('location: sales.php');
}
