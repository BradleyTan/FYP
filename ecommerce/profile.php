<?php include 'includes/session.php'; ?>
<?php
  if(!isset($_SESSION['user'])){
    header('location: index.php');
  }
?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
   
    <div class="content-wrapper">
      <div class="container">

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-sm-9">
              <?php
                if(isset($_SESSION['error'])){
                  echo "
                    <div class='callout callout-danger'>
                      ".$_SESSION['error']."
                    </div>
                  ";
                  unset($_SESSION['error']);
                }

                if(isset($_SESSION['success'])){
                  echo "
                    <div class='callout callout-success'>
                      ".$_SESSION['success']."
                    </div>
                  ";
                  unset($_SESSION['success']);
                }
              ?>
              <div class="box box-solid">
                <div class="box-body">
                  <div class="col-sm-3">
                    <img src="<?php echo (!empty($user['photo'])) ? 'images/'.$user['photo'] : 'images/profile.jpg'; ?>" width="100%">
                  </div>
                  <div class="col-sm-9">
                    <div class="row">
                      <div class="col-sm-3">
                        <h4>Name:</h4>
                        <h4>Email:</h4>
                        <h4>Contact Info:</h4>
                        <h4>Address:</h4>
                        <h4>Member Since:</h4>
                      </div>
                      <div class="col-sm-9">
                        <h4><?php echo $user['firstname'].' '.$user['lastname']; ?>
                          <span class="pull-right">
                            <a href="#edit" class="btn btn-success btn-flat btn-sm" data-toggle="modal"><i class="fa fa-edit"></i> Edit</a>
                          </span>
                        </h4>
                        <h4><?php echo $user['email']; ?></h4>
                        <h4><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : 'N/a'; ?></h4>
                        <h4><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></h4>
                        <h4><?php echo date('M d, Y', strtotime($user['created_on'])); ?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h4 class="box-title"><i class="fa fa-calendar"></i> <b>Transaction History</b></h4>
                  <!-- PRASATH -->
                </div>
                <div class="box-body">
                  <table class="table table-bordered" id="example1">
                    <thead>
                      <th class="hidden"></th>
                      <th>Date</th>
                      <th>Transaction#</th>
                      <th class='center'>Amount</th>
                      <th class="center">Order Status</th>
                      <th class="center">Full Details</th>
                    </thead>
                    <tbody>
					<?php
$conn = $pdo->open();

try {
  $stmt = $conn->prepare("SELECT * FROM sales WHERE user_id=:user_id ORDER BY sales_date DESC");
  $stmt->execute(['user_id'=>$user['id']]);
  foreach($stmt as $row) {
    $stmt2 = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
    $stmt2->execute(['id'=>$row['id']]);
    $total = 0;

    if($row['orderStatus'] == 'Delivered') {
      $statusclass = 'green !important';
    } else if($row['orderStatus'] == 'Shipping') {
      $statusclass = 'orange !important';
    } else {
      $statusclass = '#d9500f !important';
    }

	$stmt3 = $conn->prepare("SELECT order_status FROM orders WHERE order_id IN (SELECT order_id FROM sales WHERE id=:sales_id)");
	$stmt3->execute(['sales_id' => $row['id']]);
	$orderStatus = $stmt3->fetchColumn();
	
	if ($orderStatus !== false) {
		$row['orderStatus'] = $orderStatus;
	}
	
    foreach($stmt2 as $row2) {
      $subtotal = $row2['price'] * $row2['quantity'];
      $total += $subtotal;
    }	

    echo "
      <tr>
        <td class='hidden'></td>
        <td>".date('M d, Y', strtotime($row['sales_date']))."</td>
        <td>".$row['pay_id']."</td>
        <td class='center'>RM ".number_format($total, 2)."</td>
        <td class='center' style='text-transform:uppercase;text-align:center;color:".$statusclass.";'>".$row['orderStatus']."</td>
        <td class='center'><button class='btn btn-sm btn-flat btn-info transact' data-id='".$row['id']."'><i class='fa fa-search'></i> View</button></td>
      </tr>
    ";


  }
} catch(PDOException $e) {
  echo "There is some problem in connection: " . $e->getMessage();
}

$pdo->close();
?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <?php include 'includes/sidebar.php'; ?>
            </div>
          </div>
        </section>
       
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/profile_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  // PRASATH
  $(document).on('click', '.transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'transaction.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
        $('#date').html(response.date);
        $('#transid').html(response.transaction);
        $('#ship_name').html(response.ship_name);
        $('#ship_num').html(response.ship_num);
        $('#ship_address').html(response.ship_address);
        $('#detail').prepend(response.list);
        $('#total').html(response.total);
        $('#sales_id').val(response.sales_id);
      }
    });
  });

  $("#transaction").on("hidden.bs.modal", function () {
    $('.prepend_items').remove();
  });
});
// Update order status
$(document).on('change', '.status-select', function(e){
  e.preventDefault();
  var orderId = $(this).data('orderid');
  var status = $(this).val();
  $.ajax({
    type: 'POST',
    url: 'update_status.php',
    data: {orderid: orderId, order_status: status},
    success:function(response){
    }
  });
});


function printInvoice()
{
  let invoiceid = $("#sales_id").val();
  window.open('tcpdf/examples/print_invoice.php?id="'+invoiceid+'"',"_blank");
}  

</script>
</body>
</html>
