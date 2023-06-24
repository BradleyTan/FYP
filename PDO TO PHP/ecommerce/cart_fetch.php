<?php
include 'includes/session.php';
include 'includes/conn.php'; 

$output = array('list'=>'','count'=>0);

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['id'];
    $query = "SELECT *, products.name AS prodname, category.name AS catname 
              FROM cart 
              LEFT JOIN products ON products.id=cart.product_id 
              LEFT JOIN category ON category.id=products.category_id 
              WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        $output['count']++;
        $image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
        $productname = (strlen($row['prodname']) > 30) ? substr_replace($row['prodname'], '...', 27) : $row['prodname'];
        $output['list'] .= "
            <li>
                <a href='product.php?product=".$row['slug']."'>
                    <div class='pull-left'>
                        <img src='".$image."' class='thumbnail' alt='User Image'>
                    </div>
                    <h4>
                        <b>".$row['catname']."</b>
                        <small>&times; ".$row['quantity']."</small>
                    </h4>
                    <p>".$productname."</p>
                </a>
            </li>
        ";
    }
}
else{
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

    if(empty($_SESSION['cart'])){
        $output['count'] = 0;
    }
    else{
        foreach($_SESSION['cart'] as $row){
            $output['count']++;
            $product_id = $row['productid'];
            $query = "SELECT *, products.name AS prodname, category.name AS catname 
                      FROM products 
                      LEFT JOIN category ON category.id=products.category_id 
                      WHERE products.id='$product_id'";
            $result = mysqli_query($conn, $query);
            $product = mysqli_fetch_assoc($result);
            $image = (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg';
            $output['list'] .= "
                <li>
                    <a href='product.php?product=".$product['slug']."'>
                        <div class='pull-left'>
                            <img src='".$image."' class='img-circle' alt='User Image'>
                        </div>
                        <h4>
                            <b>".$product['catname']."</b>
                            <small>&times; ".$row['quantity']."</small>
                        </h4>
                        <p>".$product['prodname']."</p>
                    </a>
                </li>
            ";
        }
    }
}

mysqli_close($conn);
echo json_encode($output);

?>

