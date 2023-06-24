<?php
	include 'includes/session.php';
	include 'includes/conn.php';

	$output = '';

	if (isset($_SESSION['user'])) {
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $row) {
				$stmt = mysqli_prepare($conn, "SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=? AND product_id=?");
				mysqli_stmt_bind_param($stmt, "ii", $user['id'], $row['productid']);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$crow = mysqli_fetch_assoc($result);
				if ($crow['numrows'] < 1) {
					$stmt = mysqli_prepare($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
					mysqli_stmt_bind_param($stmt, "iii", $user['id'], $row['productid'], $row['quantity']);
					mysqli_stmt_execute($stmt);
				} else {
					$stmt = mysqli_prepare($conn, "UPDATE cart SET quantity=? WHERE user_id=? AND product_id=?");
					mysqli_stmt_bind_param($stmt, "iii", $row['quantity'], $user['id'], $row['productid']);
					mysqli_stmt_execute($stmt);
				}
			}
			unset($_SESSION['cart']);
		}
	
		try {
			$total = 0;
			$stmt = mysqli_prepare($conn, "SELECT *, cart.id AS cartid, products_quantity AS products_quantity FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=?");
			mysqli_stmt_bind_param($stmt, "i", $user['id']);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			while ($row = mysqli_fetch_assoc($result)) {
				$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
				$subtotal = $row['price'] * $row['quantity'];
				$total += $subtotal;
				$maxQuantity = min($row['products_quantity'], 10); // Maximum quantity allowed for purchase
				$output .= "
				<tr>
				<td><button type='button' data-id='" . $row['cartid'] . "' class='btn btn-danger btn-flat cart_delete'><i class='fa fa-remove'></i></button></td>
				<td><img src='" . $image . "' width='30px' height='30px'></td>
				<td>" . $row['name'] . "
					<p style='color: red'>" . $row['products_quantity'] . " quantity remaining</p>
				</td>
				<td>RM " . number_format($row['price'], 2) . "</td>
				<td class='input-group'>
					<span class='input-group-btn'>
						<button type='button' id='minus_" . $row['cartid'] . "' class='btn btn-default btn-flat minus' data-id='" . $row['cartid'] . "'><i class='fa fa-minus'></i></button>
					</span>
					<input type='number' class='form-control' value='" . min($row['quantity'], $maxQuantity) . "' id='qty_" . $row['cartid'] . "' min='1' max='" . $maxQuantity . "'>
					<span class='input-group-btn'>
						<button type='button' id='add_" . $row['cartid'] . "' class='btn btn-default btn-flat add' data-id='" . $row['cartid'] . "'><i class='fa fa-plus'></i></button>
					</span>
				</td>
				<td id='subtotal_" . $row['cartid'] . "'>RM " . number_format($subtotal, 2) . "</td>
			</tr>
			<script>
			document.getElementById('add_".$row['cartid']."').addEventListener('click', function() {
				var quantityInput = document.getElementById('qty_".$row['cartid']."');
				var currentQuantity = parseInt(quantityInput.value);
				var maxQuantity = parseInt(quantityInput.getAttribute('max'));
				var addButton = document.getElementById('add_" . $row['cartid'] . "');
			
				if (currentQuantity >= maxQuantity) {
					// Display an error message or provide visual feedback to indicate the maximum quantity has been reached
					addButton.disabled = true;
					alert('Maximum quantity reached. You cannot add more of this product.');
					return;		
				} else {
					// Increment the quantity
					var newQuantity = currentQuantity + 1;
					if (newQuantity > maxQuantity) {
						newQuantity = maxQuantity; // Set the new quantity to the maximum limit
					}
					
					// Calculate and update the subtotal only if the new quantity is within the maximum limit
					if (newQuantity <= maxQuantity) {
						quantityInput.value = newQuantity;
						var price = parseFloat(".$row['price'].");
						var subtotal = price * newQuantity;
						var subtotalElement = document.getElementById('subtotal_".$row['cartid']."');
						subtotalElement.textContent = 'RM ' + subtotal.toFixed(2);
					}
				}
			});
			</script>
				";
			}
			$output .= "
				<tr>
					<td colspan='5' align='right'><b>Total</b></td>
					<td><b>RM ".number_format($total, 2)."</b></td>
				<tr>
			";
		} catch (Exception $e) {
			$output .= $e->getMessage();
		}

	}
	else{
		if(count($_SESSION['cart']) != 0){
			$total = 0;
			foreach($_SESSION['cart'] as $row){
				$stmt = mysqli_prepare($conn, "SELECT *, products_quantity AS products_quantity, products.name AS prodname, category.name AS catname FROM products LEFT JOIN category ON category.id=products.category_id WHERE products.id=?");
				mysqli_stmt_bind_param($stmt, "i", $row['productid']);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$product = mysqli_fetch_assoc($result);
				$image = (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg';
				$subtotal = $product['price']*$row['quantity'];
				$total += $subtotal;
				$maxQuantity = min($product['products_quantity'], 10); // Maximum quantity allowed for purchase
				$output .= "
				<tr>
					<td><button type='button' data-id='".$row['productid']."' class='btn btn-danger btn-flat cart_delete'><i class='fa fa-remove'></i></button></td>
					<td><img src='".$image."' width='30px' height='30px'></td>
					<td>".$product['name']."</td>
					<td>RM ".number_format($product['price'], 2)."</td>
					<td class='input-group'>
						<span class='input-group-btn'>
							<button type='button' id='minus_".$row['cartid']."' class='btn btn-default btn-flat minus' data-id='".$row['cartid']."'><i class='fa fa-minus'></i></button>
						</span>
						<input type='number' class='form-control' value='".min($row['quantity'], $maxQuantity)."' id='qty_".$row['cartid']."' min='1' max='".$maxQuantity."'>
						<span class='input-group-btn'>
							<button type='button' id='add_".$row['cartid']."' class='btn btn-default btn-flat add' data-id='".$row['cartid']."'><i class='fa fa-plus'></i></button>
						</span>
					</td>
					<td>RM ".number_format($subtotal, 2)."</td>
				</tr>
				
				<script>
				document.getElementById('add_".$row['cartid']."').addEventListener('click', function() {
					var quantityInput = document.getElementById('qty_".$row['cartid']."');
					var currentQuantity = parseInt(quantityInput.value);
					var maxQuantity = parseInt(quantityInput.getAttribute('max'));
					var addButton = document.getElementById('add_" . $row['cartid'] . "');
				
					if (currentQuantity >= maxQuantity) {
						// Display an error message or provide visual feedback to indicate the maximum quantity has been reached
						addButton.disabled = true;
						alert('Maximum quantity reached. You cannot add more of this product.');
						return;		
					} else {
						// Increment the quantity
						var newQuantity = currentQuantity + 1;
						if (newQuantity > maxQuantity) {
							newQuantity = maxQuantity; // Set the new quantity to the maximum limit
						}
						
						// Calculate and update the subtotal only if the new quantity is within the maximum limit
						if (newQuantity <= maxQuantity) {
							quantityInput.value = newQuantity;
							var price = parseFloat(".$row['price'].");
							var subtotal = price * newQuantity;
							var subtotalElement = document.getElementById('subtotal_".$row['cartid']."');
							subtotalElement.textContent = 'RM ' + subtotal.toFixed(2);
						}
					}
				});
				</script>
			";
			
				
			}

			$output .= "
				<tr>
					<td colspan='5' align='right'><b>Total</b></td>
					<td><b>RM ".number_format($total, 2)."</b></td>
				<tr>
			";
		}

		else{
			$output .= "
				<tr>
					<td colspan='6' align='center'>Shopping cart empty</td>
				<tr>
			";
		}
		
	}

	mysqli_close($conn);
	echo json_encode($output);

?>
