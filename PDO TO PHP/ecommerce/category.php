<?php include 'includes/session.php'; ?>
<?php include 'includes/conn.php'; ?>

<?php
    $slug = $_GET['category'];

    $conn = mysqli_connect("localhost", "root", "", "ecomm");

    if (!$conn) {
        echo "There is some problem in connection: " . mysqli_connect_error();
    }

    try {
        $stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = ?");
        $stmt->bind_param('s', $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $cat = $result->fetch_assoc();
        $catid = $cat['id'];
    } catch (Exception $e) {
        echo "There is some problem in connection: " . $e->getMessage();
    }

    mysqli_close($conn);
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
                            <h1 class="page-header"><?php echo $cat['name']; ?></h1>
                            <?php
                                $conn = mysqli_connect("localhost", "root", "", "ecomm");

                                if (!$conn) {
                                    echo "There is some problem in connection: " . mysqli_connect_error();
                                }

                                try {
                                    $inc = 3;
                                    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
                                    $stmt->bind_param('i', $catid);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    while ($row = $result->fetch_assoc()) {
                                        $image = (!empty($row['photo'])) ? 'images/' . $row['photo'] : 'images/noimage.jpg';
                                        $inc = ($inc == 3) ? 1 : $inc + 1;
                                        if ($inc == 1) echo "<div class='row'>";
                                        echo "
                                            <div class='col-sm-4'>
                                                <div class='box box-solid'>
                                                    <div class='box-body prod-body'>
                                                        <img src='" . $image . "' width='100%' height='230px' class='thumbnail'>
                                                        <h5><a href='product.php?product=" . $row['slug'] . "'>" . $row['name'] . "</a></h5>
                                                    </div>
                                                    <div class='box-footer'>
                                                        <b>RM " . number_format($row['price'], 2) . "</b>
                                                    </div>
                                                </div>
                                            </div>
                                        ";
                                        if ($inc == 3) echo "</div>";
                                    }
                                    if ($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>";
                                    if ($inc == 2) echo "<div class='col-sm-4'></div></div>";
                                } catch (Exception $e) {
                                    echo "There is some problem in connection: " . $e->getMessage();
                                }

                                mysqli_close($conn);
                            ?>
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
