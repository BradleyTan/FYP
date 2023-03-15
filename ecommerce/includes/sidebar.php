<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Most Viewed Today</b></h3>
	  	</div>
	  	<div class="box-body">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
				  $dsn = 'mysql:host=localhost;dbname=ecomm';
				  $username = 'root';
				  $password = '';
				  try {
					  $pdo = new PDO($dsn, $username, $password);
					  $conn = $pdo;
				  } catch (PDOException $e) {
					  echo 'Connection failed: ' . $e->getMessage();
				  }
				  
	  			$stmt = $conn->prepare("SELECT * FROM products WHERE date_view=:now ORDER BY counter DESC LIMIT 10");
	  			$stmt->execute(['now'=>$now]);
	  			foreach($stmt as $row){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  		?>
	    	<ul>
	  	</div>
	</div>
</div>




