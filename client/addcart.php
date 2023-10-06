<?php
include "authguard.php";

$pid = $_GET['pid'];
$userid = $_SESSION['userid'];
$quantity = $_GET['quantity']; 

include "../shared/connection.php";


$sql = "INSERT INTO cart (userid, pid, quantity) VALUES ($userid, $pid, $quantity) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)";

if (mysqli_query($conn, $sql)) {
    echo "Added to cart successfully!";
    echo    '<script>res=confirm("Added to Cart! View Cart?");
               if(res){
                   window.location=`cart.php`;
               } else {
                   window.location=`products.php`;
               }
           </script>';
    // echo '<script>alert("Added to Cart"); window.location="cart.php";</>';
} else {
    echo "Failed to Add Cart";
    echo mysqli_error($conn);
}
?>
