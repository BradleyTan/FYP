<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <?php
        include 'includes/session.php';

        if (isset($_GET['products.id'])) {
            $productID = $_GET['products.id'];

            try {
                $conn = $pdo->open();

                $sql = "SELECT * FROM products WHERE id = :products.id, photo = :products.photo, products.name = :products.name, price = :products.price LEFT JOIN details ON quantity = :details.quantity";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $productID);
                $stmt->execute();

                $count = 1;
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        ?>
                        <tr>
                            <td><?= $count ?></td>
                            <td><img height="80px" src="<?= $row["photo"] ?>"></td>
                            <td><?= $row["products.name"] ?></td>
                            <td><?= $row["quantity"] ?></td>
                            <td><?= $row["price"] ?></td>
                        </tr>
                        <?php
                        $count = $count + 1;
                    }
                } else {
                    echo "No records found.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            $conn = null;
        } else {
            echo "Product ID not specified.";
        }
        ?>
    </table>
</div>
