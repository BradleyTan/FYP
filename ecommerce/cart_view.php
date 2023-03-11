<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	<?php
	session_start();
	if(isset($_SESSION['cart_items'])) {
    	unset($_SESSION['cart_items']);
	}
	?>	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
							echo '<div><button type="submit" name="ordersubmit">PROCEED TO CHECKOUT</button></div>';
						}
						
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}

						if(isset($_POST['ordersubmit'])) 
						{
							
						if(strlen($_SESSION['login'])==0)
							{   
						header('location:login.php');
						}
						else{
						
							$qty=$_POST['quantity'];
							$pdd=$_SESSION['pid'];
							$value=array_combine($pdd,$qty);
						
						
								foreach($value as $qty=> $val34){
						
						
						
						mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
						header('location:payment-method.php');
						}
						}

						$user_id = $_SESSION['user_id']; //Retrieve the user ID from the session

						$sql = "SELECT * FROM orders WHERE user_id='$user_id'";
						$result = mysqli_query($conn, $sql);
						
						if(mysqli_num_rows($result) > 0) {
						//Delete the orders with the same user ID
						$sql = "DELETE FROM orders WHERE user_id='$user_id'";
						mysqli_query($conn, $sql);
						}
						
						$sql = "SELECT * FROM orders WHERE order_id='$order_id'";
						$result = mysqli_query($conn, $sql);
						
						while($row = mysqli_fetch_assoc($result)) {	
							// Process order...
							if($order_successful) {
    							// code to process the order

    							// start a session and unset "cart_items" if it exists
    							session_start();

    							if(isset($_SESSION['cart_items'])) {
        							unset($_SESSION['cart_items']);
    							}
							}
						}

						
					}						
	        		?>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
</body>
</html>