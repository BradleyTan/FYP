<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Orders
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Orders</li>
                </ol>
            </section>

    <!-- Main content -->
    <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        " . $_SESSION['error'] . "
                    </div>";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        " . $_SESSION['success'] . "
                    </div>";
                    unset($_SESSION['success']);
                }
                ?>

                    <div class="row">
                            <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header with-border">
                                <div class="box-body">
                                    <div id="ordersBtn">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Order Date</th>
                                                <th>Order Status</th>
                                                <th>Actions</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $conn = $pdo->open();

                                            try {
                                                $stmt = $conn->prepare("SELECT sales.id AS order_id, CONCAT(users.firstname, ' ', users.lastname) AS user_name, sales.sales_date AS order_date, sales.orderStatus AS order_status
                                                                        FROM sales
                                                                        INNER JOIN users ON sales.user_id = users.id
                                                                        LEFT JOIN orders ON sales.id = orders.order_id
                                                                        ORDER BY order_id ASC");
                                                $stmt->execute();

                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($stmt as $row) {
                                                        $order_id = $row['order_id'];
                                                        $user_name = $row['user_name'];
                                                        $order_date = $row['order_date'];
                                                        $order_status = $row['order_status'];

                                                        echo "
                                                        <tr>
                                                            <td>" . $row['order_id'] . "</td>
                                                            <td>" . $row['user_name'] . "</td>
                                                            <td>" . date('M d, Y', strtotime($row['order_date'])) . "</td>
                                                            <td>" . $row['order_status'] . "</td>
                                                            <td>                                       
                                                                <button type='button' class='btn btn-info btn-sm btn-flat transact' data-id='".$row['order_id']."'><i class='fa fa-search'></i> View</button>
                                                                <button class='btn btn-success btn-sm edit btn-flat' data-order_id='" . $row['order_id'] . "'>
                                                                    <i class='fa fa-edit'></i> <span>Edit</span>
                                                                </button>
                                                            </td>
                                                        </tr>";
                                                    }

                                                    
                                                    $stmt2 = $conn->prepare("INSERT INTO orders (user_name, order_date, order_status) VALUES (:user_name, :order_date, :order_status)");
                                                    foreach ($stmt as $row) {
                                                        $user_name = $row['user_name'];
                                                        $order_date = $row['order_date'];
                                                        $order_status = $row['order_status'];
                                                    
                                                        $stmt2->execute(['user_name' => $user_name, 'order_date' => $order_date, 'order_status' => $order_status]);
                                                    }
                                                    
                                                } else {
                                                    echo "<tr><td colspan='5'>No records found.</td></tr>";
                                                }
                                            } catch (PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                            }

                                            $pdo->close();
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     
                <div class="modal fade" id="edit">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form class="form-horizontal" method="POST" action="updateOrderStatus.php">
                                    <input type="hidden" class="order_id" name="order_id">
                                    <div class="form-group">
                                        <label for="edit_order_status" class="col-sm-3 control-label">Order Status</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="edit_order_status" name="order_status">
                                            <option value="" disabled selected>Please choose an order status to update</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Shipping">Shipping</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
                                            <i class="fa fa-close"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-success btn-flat" name="edit">
                                            <i class="fa fa-check-square-o"></i> Update
                                        </button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include 'includes/footer.php'; ?>
        <?php include '../includes/profile_modal.php'; ?>
    </div>

<?php include 'includes/scripts.php'; ?>

<script>
    $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        console.log('Edit button clicked');
        $('#edit').modal('show');
        var order_id = $(this).data('order_id');
        getRow(order_id);
    });

    function getRow(order_id) {
        $.ajax({
           type: 'POST',
            url: 'orders_row.php',
            data: {
                order_id: order_id
            },
            dataType: 'json',
            success: function(response) {
                $('.order_id').val(response.order_id);
                $('#edit_order_status').val(response.order_status);
            }
        });
    }
    $(function(){
  $(document).on('click', '.transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'transact.php',
      data: {id:id},
      dataType: 'json',
      success:function(response){
        $('#date').html(response.date);
        $('#transid').html(response.transaction);
        $('#detail').prepend(response.list);
        $('#total').html(response.total);
      }
    });
  });

  $("#transaction").on("hidden.bs.modal", function () {
      $('.prepend_items').remove();
  });
});
</script>
</body>
</html>