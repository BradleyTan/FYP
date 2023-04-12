<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="login-box">
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
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form action="verify.php" method="POST" >
      		<div class="form-group has-feedback">
        		<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login">Sign In</button>
        		</div>
      		</div>
    	</form>
      <script>
          const emailInput = document.getElementById('email');
          const tooltip = document.createElement('div');
          tooltip.classList.add('tooltip');
          tooltip.textContent = 'Your email address should be in the format: name@example.com';
          
          emailInput.addEventListener('mouseover', () => {
            tooltip.classList.add('visible');
            emailInput.parentNode.insertBefore(tooltip, emailInput.nextSibling);
          });
          
          emailInput.addEventListener('mouseout', () => {
            tooltip.classList.remove('visible');
            tooltip.remove();
          });       
      </script> 	      
      <br>
      <a href="password_forgot.php">I forgot my password</a><br>
      <a href="signup.php" class="text-center">Register a new membership</a><br>
      <a href="index.php">Home</a>
  	</div>
</div>

<?php include 'includes/scripts.php' ?>
</body>
</html>