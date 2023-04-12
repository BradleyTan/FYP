<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: index.php');
  }

?>
<?php include 'includes/header.php'; ?>
<head>
<link rel='stylesheet' type="text/css" href="style.css">;
<style>
        .tooltip {
    position: absolute;
    background-color: #333;
    color: #fff;
    padding: 5px;
    font-size: 12px;
    border-radius: 3px;
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    }

    .tooltip.visible {
    opacity: 1;
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
        		<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>" required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="repassword" placeholder="Retype password" required>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>

          <hr>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"> Sign Up</button>
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
      <a href="login.php">I already have a membership</a><br>
      <a href="index.php">Home</a>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>