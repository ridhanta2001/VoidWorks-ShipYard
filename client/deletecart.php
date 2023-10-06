<?php
include "authguard.php";
$cartid=$_GET['cartid'];
include_once "../shared/connection.php";

$status=mysqli_query($conn,"delete from cart where cartid=$cartid");
if($status){
    // echo "Cart item removed successfully";
    // header("location:cart.php");
    echo '<script>alert("Item removed from Cart!"); window.location="cart.php";</script>';
}
else{
    echo "Failed to delete cart item";
    echo mysqli_error($conn);
}


?>

