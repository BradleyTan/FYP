<?php include 'includes/session.php'; ?>
<?php
	$output = '';
	if(!isset($_GET['code']) OR !isset($_GET['user'])){
		$output .= '
			<div class="alert alert-danger">
                <h4><i class="icon fa fa-warning"></i> Error!</h4>
                Code to activate account not found.
            </div>
            <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
		'; 
	}
	else{
		$conn = mysqli_connect("localhost", "root", "", "ecomm");

		$code = $_GET['code'];
		$userID = $_GET['user'];

		$query = "SELECT *, COUNT(*) AS numrows FROM users WHERE activate_code='$code' AND id='$userID'";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if($row['numrows'] > 0){
			if($row['status']){
				$output .= '
					<div class="alert alert-danger">
		                <h4><i class="icon fa fa-warning"></i> Error!</h4>
		                Account already activated.
		            </div>
		            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
				';
			}
			else{
				$status = 1;
				$id = $row['id'];

				$updateQuery = "UPDATE users SET status='$status' WHERE id='$id'";
				if(mysqli_query($conn, $updateQuery)){
					$output .= '
						<div class="alert alert-success">
			                <h4><i class="icon fa fa-check"></i> Success!</h4>
			                Account activated - Email: <b>'.$row['email'].'</b>.
			            </div>
			            <h4>You may <a href="login.php">Login</a> or back to <a href="index.php">Homepage</a>.</h4>
					';
				}
				else{
					$error = mysqli_error($conn);
					$output .= '
						<div class="alert alert-danger">
			                <h4><i class="icon fa fa-warning"></i> Error!</h4>
			                '.$error.'
			            </div>
			            <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
					';
				}

			}
			
		}
		else{
			$output .= '
				<div class="alert alert-danger">
	                <h4><i class="icon fa fa-warning"></i> Error!</h4>
	                Cannot activate account. Wrong code.
	            </div>
	            <h4>You may <a href="signup.php">Signup</a> or back to <a href="index.php">Homepage</a>.</h4>
			';
		}

		mysqli_close($conn);
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
	        		<?php echo $output; ?>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
