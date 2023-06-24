<?php
    include 'includes/session.php';
    include '../includes/conn.php';

    if(isset($_POST['add'])){
        $id = $_POST['id'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];


        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT COUNT(*) AS numrows FROM cart WHERE product_id='$product'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if($row['numrows'] > 0){
            $_SESSION['error'] = 'Product exists in cart';
        }
        else{
            try{
                $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$id', '$product', '$quantity')";
                mysqli_query($conn, $query);

                $_SESSION['success'] = 'Product added to cart';
            }
            catch(Exception $e){
                $_SESSION['error'] = $e->getMessage();
            }
        }

        mysqli_close($conn);

        header('location: cart.php?user='.$id);
    }
?>
