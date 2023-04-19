<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<!-- PRASATH -->
<style>
#validationmessage
{
	color:red;
	height: 100%;
	text-align: left;
	margin-top: 3px;
	font-size: 15px;

}
.modal-payment-summary {
    position: absolute;
    bottom: 55px;
    left: 0;
    width: 100%;
    height: 55px;
    display: flex;
}

.modal-payment-footer {
    height: 45px;
    background: green;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: bold;
	float:right;
	padding:10px;
	margin:10px;
}

.reset-payment-btn {
    width: 100%;
    height: 39px;
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    border: none;
}
.modal-container
{
	position:relative;
	width:500px;
	margin:0 auto;
	background:#fff;
}
.modal-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-wrapper.active {
  z-index: 10000;
  opacity: 1;
}

.modal-header {
  position: relative;
  padding: 15px;
  border-bottom: 1px solid #ddd;
  font-weight: 600;
}

.modal-header button {
  position: absolute;
  top: 13px;
  right: 7px;
  background: #000;
  border: none;
  font-size: 20px;
  color: #fff;
}

.modal-content {
  position: relative;
  padding: 15px;
}
.loader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: -1;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  color: #fff;
  font-size: 20px;
  line-height: 1.5;
  font-weight: bold;
}
.loader img
{
	position: absolute;
	margin-bottom: 25%;
}
.loader.active {
  z-index: 9999;
  opacity: 1;
}
.payment-cc {
  appearance: none;
  backface-visibility: hidden;
  background-color: #2f80ed;
  border-radius: 10px;
  border-style: none;
  box-shadow: none;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  font-family: Inter,-apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif;
  font-size: 14px;
  font-weight: 500;
  height: 35px;
  letter-spacing: normal;
  line-height: 1.5;
  outline: none;
  overflow: hidden;
  padding: 6px 30px;
  position: relative;
  text-align: center;
  text-decoration: none;
  transform: translate3d(0, 0, 0);
  transition: all .3s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: top;
  white-space: nowrap;
}

.payment-cc:hover {
  background-color: #1366d6;
  box-shadow: rgba(0, 0, 0, .05) 0 5px 30px, rgba(0, 0, 0, .05) 0 1px 4px;
  opacity: 1;
  transform: translateY(0);
  transition-duration: .35s;
}

.payment-cc:hover:after {
  opacity: .5;
}

.payment-cc:active {
  box-shadow: rgba(0, 0, 0, .1) 0 3px 6px 0, rgba(0, 0, 0, .1) 0 0 10px 0, rgba(0, 0, 0, .1) 0 1px 4px -1px;
  transform: translateY(2px);
  transition-duration: .35s;
}

.payment-cc:active:after {
  opacity: 1;
}

@media (min-width: 768px) {
  .payment-cc {
    padding: 6px 22px;
    width: 176px;
  }
}
</style>
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

function verifyData(e) {
   	e.preventDefault();
   	var name = $("#card_holder_name").val();  
	var number = $("#card_number").val();  
	var cvc = $("#cvc").val();  
	var ccmonth = $("#ccmonth").val();  
	var ccyear = $("#ccyear").val();  
	console.log(name);
	$.ajax({  
			type:"POST",  
			url:"process_payment.php",  
			data:"number="+number+'&name='+name+'&cvc='+cvc+'&ccmonth='+ccmonth+'&ccyear='+ccyear,  
			success:function(data){  
			var obj = JSON.parse(data);
			let msg = obj.msg;
			if(obj.status)
			{
				if (confirm('Card verified, proceed payment?')) {
					window.location = 'sales.php?pay='+obj.data;
				} else {
					return;
				}
				$("#validationmessage").html(''); 
			}
			else
			{
				var text = '<ul>';
				for (let i = 0; i < msg.length; i++) 
				{
					text += "<li>"+ msg[i] + "</li>";
				} 
				text += "</ul>";
				$("#validationmessage").html(text); 
			}
		}  
		});
}

// $("#checkout").click(function(e) {
// 	var name = $("#card_holder_name").val();  
//     var number = $("#card_number").val();  
//     var cvc = $("#cvc").val();  
//     var ccmonth = $("#ccmonth").val();  
//     var ccyear = $("#ccyear").val();  
// 	console.log(name);
// 	$.ajax({  
//          type:"POST",  
//          url:"process_payment.php",  
//          data:"number="+number+'&name='+name+'&cvc='+cvc+'&ccmonth='+ccmonth+'&ccyear='+ccyear,  
//          success:function(data){  
// 			console.log(data);
// 			e.preventDefault();
// 		}  
//       });
// });



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

function ccPaymentMethod()
{
	$('.loader').addClass('active');
	$('#paymentmodal').addClass('active');
	$('.total-amounts').html(parseFloat(total).toFixed(2));
}
function closePayment()
{
	$('.loader').removeClass('active');
	$('#paymentmodal').removeClass('active');
}
function clearConsole()
{
	document.getElementById("ccform").reset(); 
}
</script>
<!-- Paypal Express -->
<script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: parseFloat(total).toFixed(2), 
                        	currency: 'RM' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script>
<body class="hold-transition skin-blue layout-top-nav">
<div class="loader">
  <img id="loading-image" src="assets/images/loading.gif" alt="Loading..." />
  <br><br>
	Your payment is being processed.
	<br>
	Please do not close this window or press the browser back button
	<br>
	until submission is complete
</div>

<div id="paymentmodal" class="modal-wrapper">
        <div class="modal-container">
            <div class="modal-header">
				Checkout
				<button class="close-modal-btn" onclick="closePayment()" style="width: 40px; font-size: 20px; cursor: pointer">
	                <i class="fas fa-times"></i>
    	        </button> 
            </div>
            <div class="modal-content" style="padding: 10px 0 110px 0">
                <form id="ccform">
					<div class="products" style="padding:10px;">
          				<div class="card-details">
            				<h3 class="title">Credit Card Details</h3>
							<div class="row">
								<div class="form-group col-sm-7">
									<label for="card_holder_name">Card Holder Name</label>
									<input id="card_holder_name" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder Name" aria-describedby="basic-addon1">
								</div>
								<div class="form-group col-sm-5">
									<label for="">Expiration Date</label>
									<div class="input-group expiration-date">
									<div class="form-group col-sm-5" style="padding:0px !important;">
										<select class="form-control" id="ccmonth">
										<?php
										for ($i = 1; $i <= 12; $i ++) {
											$monthValue = $i;
											if (strlen($i) < 2) {
												$monthValue = "0" . $monthValue;
											}
											?>
										<option value="<?php echo $monthValue; ?>"><?php echo $monthValue; ?></option>
										<?php
										}
										?>
										</select>
									</div>
									<div class="form-group col-sm-2">
									<span class="date-separator">/</span>
									</div>
									<div class="form-group col-sm-5" style="padding:0px !important;">
										<select class="form-control" id="ccyear">
										<?php
										$date = date('Y');
										for ($i = 0; $i <= 10; $i ++) {
											$yearvalue = $i+$date;
										?>
										<option value="<?php echo $yearvalue; ?>"><?php echo $yearvalue; ?></option>
										<?php
										}
										?>
										</select>
									</div>
									</div>
								</div>
								<div class="form-group col-sm-8">
									<label for="card_number">Card Number</label>
									<input id="card_number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1"  onkeyup="checkCCFormat();">
								</div>
								<div class="form-group col-sm-4">
									<label for="cvc">CVC</label>
									<input id="cvc" type="password" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1" inputmode="numeric" minlength="3" maxlength="3" >
								</div>
								<div class="form-group col-sm-12">
									<button type="button" id="checkout" onclick="verifyData(event);" class="btn btn-primary btn-block">Proceed</button>
								</div>
							</div>
          				</div>
					</div>
				</form>   
            </div>
            <div class="modal-payment-summary">
				<div class="item-footer-summary" style="width: 65%;">
                    <div id="validationmessage" class="item-footer-content">
						
					</div>
                </div>
                <div class="item-footer-summary" style="width: 15%;">
                    <div class="item-footer-content" style="height: 100%;text-align: right;margin-top: 3px;font-size: 20px;">
                        <i class="fas fa-cash-register"></i> <span class="total-amounts">0.00</span>
                    </div>
                </div>
				<div style="padding:10px;width:20%;margin-top:-12px;">
                <button class="reset-payment-btn" onclick="clearConsole()">
						<i class="fas fa-refresh"></i> 
                </button>
				</div>
            </div>
        </div>
    </div>
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
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
	        				echo "
								<h1 class='page-header'>Payment Method</h1>
								<div class='row'>
	        						<div class='col-sm-3'>
	        							<div id='paypal-button' style='display:inline'></div>
									</div>
	        						<div class='col-sm-3'>
	        							<button class='payment-cc' id='payment-cc' onclick='ccPaymentMethod()'>Credit/Debit Card</button>
									</div>
								</div>
						";
							
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
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


</body>
</html>