<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	$output = array('error' => false);

	if (!empty($_POST['id']) && !empty($_POST['quantity'])) {
		$id = $_POST['id'];
		$quantity = $_POST['quantity'];

		$stmt = $conn->prepare("SELECT products_quantity FROM products WHERE id=?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		if ($row && isset($row['products_quantity'])) {
			$prod_qty = $row['products_quantity'];

			if ($quantity > $prod_qty) {
				$output['error'] = true;
				$output['message'] = "Quantity exceeds product quantity. Please select a lower quantity.";
			} else {
				if (isset($_SESSION['user'])) {
					$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM cart WHERE user_id=? AND product_id=?");
					$stmt->bind_param("ii", $user['id'], $id);
					$stmt->execute();
					$result = $stmt->get_result();
					$row = $result->fetch_assoc();
					if ($row['numrows'] < 1) {
						$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
						$stmt->bind_param("iii", $user['id'], $id, $quantity);
						$stmt->execute();
						$output['message'] = 'Item added to cart';
					} else {
						$output['error'] = true;
						$output['message'] = 'Product already in cart';
					}
				} else {
					if (!isset($_SESSION['cart'])) {
						$_SESSION['cart'] = array();
					}

					$exist = array();

					foreach ($_SESSION['cart'] as $row) {
						array_push($exist, $row['productid']);
					}

					if (in_array($id, $exist)) {
						$output['error'] = true;
						$output['message'] = 'Product already in cart';
					} else {
						$data['productid'] = $id;
						$data['quantity'] = $quantity;

						if (array_push($_SESSION['cart'], $data)) {
							$output['message'] = 'Item added to cart';
						} else {
							$output['error'] = true;
							$output['message'] = 'Cannot add item to cart';
						}
					}
				}
			}
		} else {
			$output['error'] = true;
			$output['message'] = 'Invalid product ID';
		}
	} else {
		$output['error'] = true;
		$output['message'] = 'Missing parameters (id or quantity)';
	}

	$conn->close();
	echo json_encode($output);
?>
