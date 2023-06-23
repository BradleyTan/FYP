<div class="row">
	<div class="box box-solid">
	  	<div class="box-header with-border">
	    	<h3 class="box-title"><b>Most Viewed Today</b></h3>
	  	</div>
	  	<div class="box-body">
	  		<ul id="trending">
	  		<?php
	  			$now = date('Y-m-d');
	  			$conn = mysqli_connect("localhost", "root", "", "ecomm");

	  			$query = "SELECT * FROM products WHERE date_view='$now' ORDER BY counter DESC LIMIT 10";
	  			$result = mysqli_query($conn, $query);
	  			while($row = mysqli_fetch_assoc($result)){
	  				echo "<li><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></li>";
	  			}

	  			mysqli_close($conn);
	  		?>
	    	</ul>
	  	</div>
	</div>
</div>
