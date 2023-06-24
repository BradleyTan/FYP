<?php include 'includes/session.php'; ?>
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
	            <?php
	       			
	       			$conn = mysqli_connect("localhost", "root", "", "ecomm");

	       			if ($conn) {
						$stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS numrows FROM products WHERE name LIKE ?");
						mysqli_stmt_bind_param($stmt, "s", $keyword);
						$keyword = '%' . $_POST['keyword'] . '%';
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$row = mysqli_fetch_assoc($result);

						if ($row['numrows'] < 1) {
							echo '<h1 class="page-header">No results found for <i>' . $_POST['keyword'] . '</i></h1>';
						} else {
							echo '<h1 class="page-header">Search results for <i>' . $_POST['keyword'] . '</i></h1>';
							try {
								$inc = 3;
								$stmt = mysqli_prepare($conn, "SELECT * FROM products WHERE name LIKE ?");
								mysqli_stmt_bind_param($stmt, "s", $keyword);
								mysqli_stmt_execute($stmt);
								$result = mysqli_stmt_get_result($stmt);

								while ($row = mysqli_fetch_assoc($result)) {
									$highlighted = preg_filter('/' . preg_quote($_POST['keyword'], '/') . '/i', '<b>$0</b>', $row['name']);
									$image = (!empty($row['photo'])) ? 'images/' . $row['photo'] : 'images/noimage.jpg';
									$inc = ($inc == 3) ? 1 : $inc + 1;
									if ($inc == 1) echo "<div class='row'>";
									echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='" . $image . "' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=" . $row['slug'] . "'>" . $highlighted . "</a></h5>
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

							} catch (PDOException $e) {
								echo "There is some problem in connection: " . $e->getMessage();
							}
						}

						mysqli_close($conn);
					} else {
						echo "Failed to connect to the database.";
					}

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
