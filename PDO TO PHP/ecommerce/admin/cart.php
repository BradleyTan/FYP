<?php include 'includes/session.php'; ?>
<?php
  if(!isset($_GET['user'])){
    header('location: users.php');
    exit();
  }
  else{
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
    $stmt->execute(['id'=>$_GET['user']]);
    $user = $stmt->fetch();

    $pdo->close();
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $user['firstname'].' '.$user['lastname'].'`s Cart' ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Users</li>
        <li class="active">Cart</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="users.php" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Users</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Product Name</th>
                  <th>Quantity</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $stmt = $conn->prepare("SELECT *, cart.id AS cartid FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
                      $stmt->execute(['user_id'=>$user['id']]);
                      foreach($stmt as $row){
                        echo "
                          <tr>
                            <td>".$row['name']."</td>
                            <td>".$row['quantity']."</td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/cart_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
function getProducts(id){
  $.ajax({
    type: 'POST',
    url: 'products_all.php',
    dataType: 'json',
    success: function(response){
      $('#product').append(response);
      $('.userid').val(id);
    }
  });
}

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'cart_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.cartid').val(response.cartid);
      $('.userid').val(response.user_id);
      $('.productname').html(response.name);
    }
  });
}
</script>
</body>
</html>
