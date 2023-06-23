<?php
$id = $_GET['id'];
$t = preg_replace('/[^0-9]/i', '',$id);
$id = (int)$t;
// PRASATH
include '../../includes/conn.php';
session_start();


$conn = $pdo->open();

$output = array('list'=>'');

$stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id LEFT JOIN sales ON sales.id=details.sales_id WHERE details.sales_id=:id");
$stmt->execute(['id'=>$id]);
// $stmt->debugDumpParams();
$total = 0;
foreach($stmt as $row){
    $output['transaction'] = $row['pay_id'];
    $output['ship_name'] = $row['ship_name'];
    $output['ship_num'] = $row['ship_contact'];

    $output['ship_address'] = $row['street1'].', '.$row['street2'].',<br>'.$row['postcode'].', '.$row['city'].',<br>'.$row['state'].', '.$row['country'];
    $output['date'] = date('M d, Y', strtotime($row['sales_date']));
    $subtotal = $row['price']*$row['quantity'];
    $total += $subtotal;
    $output['list'] .= "
        <tr class='prepend_items'>
            <td>".$row['name']."</td>
            <td>RM ".number_format($row['price'], 2)."</td>
            <td>".$row['quantity']."</td>
            <td>RM ".number_format($subtotal, 2)."</td>
        </tr>
    ";
}

$output['total'] = '<b>RM '.number_format($total, 2).'<b>';
$PDFHEADER = '#INV:'.$output['transaction'];
$pdo->close();
require_once('tcpdf_include.php');
if(isset($_GET['id']))
{
    
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->setCreator(PDF_CREATOR);
    $pdf->setAuthor('Prasath');
    $pdf->setTitle('Invoice ID #'.$_GET['id']);
    $pdf->setSubject('Invoice ID #'.$_GET['id']);

    // set default header data
    $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'INVOICE', $PDFHEADER);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->setFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set font
    $pdf->setFont('dejavusans', '', 10);

    // add a page
    $pdf->AddPage();

    // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
    // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

    // create some HTML content
    $html = '<div class="modal fade" id="transaction">
    <div class="modal-dialog" style="color:black !important;">
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Transaction Full Details</b></h4>
            </div>
        <div class="modal-body">
              <p>
                Date: <span id="date_invoice">'.$output['date'].'</span>
              </p>
              <p>
              <span class="pull-right"  align="right">Invoice ID#: <span id="id_invoice">'.$id.'</span></span> 
             </p>
              <p>
                <span class="pull-right"  align="right">Transaction#: <span id="transid_invoice">'.$output['transaction'].'</span></span> 
              </p>
              <hr>
              <p>
                <b>Delivery Details:</b><br>
                <span id="ship_name_invoice">'.$output['ship_name'].'</span> <br>
                <span id="ship_num_invoice">'.$output['ship_num'].'</span> <br>
                '.$output['ship_address'].'<span id="ship_address_invoice"></span> 
              </p>
              <table border="1" cellspacing="3" cellpadding="4">
                <tr>
                    <th><b>Product</b></th>
                    <th><b>Price</b></th>
                    <th><b>Quantity</b></th>
                    <th><b>Subtotal</b></th>
                </tr>
                '.$output['list'].'
                </table>
            </div>
        </div>
    </div>
</div>';
// echo $html;
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
//               $html = '<table class="table table-bordered">
//                 <thead>
//                   <th>Product</th>
//                   <th>Price</th>
//                   <th>Quantity</th>
//                   <th>Subtotal</th>
//                 </thead>
//                 <tbody id="detail">
//                   <tr>
//                     <td colspan="3" align="right"><b>Total</b></td>
//                     <td><span id="total"></span></td>
//                   </tr>
//                 </tbody>
//               </table>';
//         $pdf->writeHTML($html, true, false, true, false, '');
            
//               $html = '</div>
//             <div class="modal-footer">
//               <button type="button" class="btn btn-default btn-flat pull-right" style="margin-left:10px;" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
//               <button type="button" id="print_invoice" onclick="printInvoice();" class="btn btn-warning btn-flat pull-right" ><i class="fa fa-export"></i> Print Invoice</button>
//             </div>
//         </div>
//     </div>
// </div>';
//     // output the HTML content
    // $pdf->writeHTML($html, true, false, true, false, '');



  

   

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

    // reset pointer to the last page
    $pdf->lastPage();

    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('invoice.pdf', 'I');

    //============================================================+
    // END OF FILE
    //============================================================+
    echo $pdf;
}
else
{
    echo "Oops, no invoice found";
}
  