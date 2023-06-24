<?php
include 'includes/session.php';
include 'includes/conn.php';

$conn = mysqli_connect("localhost", "root", "", "ecomm");

$slug = $_GET['product'] ?? ''; // empty string is the default value

$stmt = mysqli_prepare($conn, "SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = ?");
mysqli_stmt_bind_param($stmt, "s", $slug);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

// Check if product exists and has all the necessary keys
if (is_array($product) && isset($product['photo']) && isset($product['products_quantity']) && isset($product['prodname']) && isset($product['price']) && isset($product['catname']) && isset($product['description'])) {
    // Page view
    $now = date('Y-m-d');
    if ($product['date_view'] == $now) {
        $stmt = mysqli_prepare($conn, "UPDATE products SET counter=counter+1 WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $product['prodid']);
        mysqli_stmt_execute($stmt);
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE products SET counter=1, date_view=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "si", $now, $product['prodid']);
        mysqli_stmt_execute($stmt);
    }

    include 'includes/header.php';
    ?>
    <head>
        <style>
            .shipping-row {
                display: flex;
                align-items: center;
            }

            .shipping-label {
                margin-right: 10px;
            }

            .shipping-charge {
                color: red;
                font-weight: bold;
            }
        </style>
        <script>

        </script>

    </head>
    <body class="hold-transition skin-blue layout-top-nav">


    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>

        <div class="content-wrapper">
            <div class="container">

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="callout" id="callout" style="display:none">
                                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                                <span class="message"></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="<?php echo (!empty($product['photo'])) ? 'images/' . $product['photo'] : 'images/noimage.jpg'; ?>" width="100%" class="zoom" data-magnify-src="images/large-<?php echo $product['photo']; ?>">
                                    <br><br>
                                    <form class="form-inline" id="productForm" method="GET">
                                        <?php
                                        if ($product['products_quantity'] == 0) {
                                            echo '<h4 style="color:red;">Out Of Stock</h4>';
                                        } else {
                                            echo '<h4 style="color:green;">In Stock</h4>';
                                        }

                                        ?>
                                        <h4>Quantity</h4>
                                        <div class="form-group">
                                            <div class="input-group col-sm-5">
                                                <span class="input-group-btn">
                                                    <button type="button" id="minus" class="btn btn-default btn-flat btn-lg"><i class="fa fa-minus"></i></button>
                                                </span>
                                                <input type="text" name="quantity" id="quantity" class="form-control input-lg" value="1" min="1" max="10">
                                                <span class="input-group-btn">
                                                    <button type="button" id="add" class="btn btn-default btn-flat btn-lg"><i class="fa fa-plus"></i>
                                                    </button>
                                                </span>

                                                <input type="hidden" value="<?php echo $product['prodid']; ?>" name="id">
                                                <?php


                                                if ($product['products_quantity'] > 0) {
                                                    echo '</div>
                                                    <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                                    <p style="color: red">' . $product['products_quantity'] . ' quantity remaining</p>
                                                </div>';
                                                } else {
                                                    echo '</div></div>';
                                                }

                                                ?>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <h1 class="page-header"><?php echo $product['prodname']; ?></h1>
                                    <h3><b>RM <?php echo number_format($product['price'], 2); ?></b></h3>
                                    <p><b>Category:</b> <a href="category.php?category=<?php echo $product['cat_slug']; ?>"><?php echo $product['catname']; ?></a></p>
                                    <p><b>Description:</b></p>
                                    <p><?php echo $product['description']; ?></p>
                                    <div class="shipping-row">
                                        <span class="shipping-label"><b>SHIPPING CHARGE:</b></span>
                                        <h5 class="shipping-charge">Free</h5>
                                    </div>
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
    </div>

    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function () {
            $('#add').click(function (e) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                if (quantity < 10) {
                    quantity++;
                    $('#quantity').val(quantity);
                }
            });
            $('#minus').click(function (e) {
                e.preventDefault();
                var quantity = $('#quantity').val();
                if (quantity > 1) {
                    quantity--;
                    $('#quantity').val(quantity);
                }
            });
            $('#quantity').on('change', function () {
                var quantity = parseInt($(this).val());
                if (quantity < 1) {
                    $(this).val(1);
                } else if (quantity > 10) {
                    $(this).val(10);
                }
            });
        });

    </script>
    </body>
    </html>
    <?php
} else {
    // Product not found or missing keys, handle the error
    echo "Product not found";
    // or redirect to an error page, or display an error message
}
?>
