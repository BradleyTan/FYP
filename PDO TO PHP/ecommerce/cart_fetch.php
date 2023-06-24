<?php
include 'includes/session.php';
include 'includes/conn.php'; 

	

	$output = array('list' => '', 'count' => 0);

	if (isset($_SESSION['user'])) {
		try {
			$stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN category ON category.id=products.category_id WHERE user_id=?");
			$stmt->bind_param("i", $user['id']);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_assoc()) {
				$output['count']++;
				$image = (!empty($row['photo'])) ? 'images/' . $row['photo'] : 'images/noimage.jpg';
				$productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];
				$output['list'] .= "
					<li>
						<a href='product.php?product=" . $row['slug'] . "'>
							<div class='pull-left'>
								<img src='" . $image . "' class='thumbnail' alt='User Image'>
							</div>
							<h4>
		                        <b>" . $row['catname'] . "</b>
		                        <small>&times; " . $row['quantity'] . "</small>
		                    </h4>
		                    <p>" . $productname . "</p>
						</a>
					</li>
				";
			}
		} catch (Exception $e) {
			$output['message'] = $e->getMessage();
		}
	} else {
		if (!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
		}

		if (empty($_SESSION['cart'])) {
			$output['count'] = 0;
		} else {
			foreach ($_SESSION['cart'] as $row) {
				$output['count']++;
				$stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id=?");
				$stmt->bind_param("i", $row['productid']);
				$stmt->execute();
				$result = $stmt->get_result();
				$product = $result->fetch_assoc();
				$image = (!empty($product['photo'])) ? 'images/' . $product['photo'] : 'images/noimage.jpg';
				$output['list'] .= "
					<li>
						<a href='product.php?product=" . $product['slug'] . "'>
							<div class='pull-left'>
								<img src='" . $image . "' class='img-circle' alt='User Image'>
							</div>
							<h4>
		                        <b>" . $product['catname'] . "</b>
		                        <small>&times; " . $row['quantity'] . "</small>
		                    </h4>
		                    <p>" . $product['prodname'] . "</p>
						</a>
					</li>
				";
			}
		}
	}

	mysqli_close($conn);
	echo json_encode($output);
?>
