<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['ordersubmit'])) 
{
	
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);


		foreach($value as $qty=> $val34){



mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
header('location:payment-method.php');
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Shopping Portal | Payment Method</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
		<link rel="stylesheet" href="assets/css/config.css">
        <link rel="stylesheet" href="css/payment.css">
		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" href="assets/images/favicon.ico">
	</head>
    <body class="cnt-home">
	
		
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<body>
<main class="page payment-page">
    <section class="payment-form dark">
      <div class="container">
        <div class="block-heading">
          <h2>Payment</h2>
          <p2>Last step to purchase your item.</p2>
        </div>
        <form>
          <div class="products">
            <h3 class="title">Checkout</h3>
          <div class="card-details">
            <h3 class="title">Credit Card Details</h3>
            <div class="row">
              <div class="form-group col-sm-7">
                <label for="card-holder">Card Holder</label>
                <input id="card-holder" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-5">
                <label for="">Expiration Date</label>
                <div class="input-group expiration-date">
                  <input type="text" class="form-control" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                  <span class="date-separator">/</span>
                  <input type="text" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="form-group col-sm-8">
                <label for="card-number">Card Number</label>
                <input id="card-number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-4">
                <label for="cvc">CVC</label>
                <input id="cvc" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
              </div>
              <div class="form-group col-sm-12">
                <a href="order-history.php" class="btn btn-primary btn-block">Proceed</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </section>
  </main>
</body>
<?php include('includes/footer.php');?>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>