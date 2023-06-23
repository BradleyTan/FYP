<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }

?>
<?php include 'includes/header.php'; ?>
<head>
<style>
    body{
    background-image: url("images/1.jpg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;
}
  </style>
</head>
<body>
<div class="register-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="register-box-body">
    	<p class="login-box-msg">Register a new membership</p>

    	<form action="register.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>" required>
            <span class="glyphicon glyphicon-user form-control-feedback" style="position:absolute; height: 10px"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" title="Your email address should be in the format: name@example.com" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="pass" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <div class="input-group"><!-- input-group Starts -->
              <span class="input-group-addon"><!-- input-group-addon Starts -->
                <div id="meter_wrapper"><!-- meter_wrapper Starts -->
                  <span id="pass_type"> </span>
                  <div id="meter"> </div>
                </div><!-- meter_wrapper Ends -->  
              </span><!-- input-group-addon Ends -->
            </div><!-- input-group Ends --> 
          </div>
          
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="repassword" placeholder="Retype password" title="Retype password must be the same as the password above" required>
          </div>

          <hr>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"> Sign Up</button>
        		</div>
      		</div>
    	</form>
      <br>
      <a href="login.php">I already have a membership</a><br>
      <a href="index.php">Home</a>
  	</div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
</html>