<?php
include "authguard.php";
$orderid=$_GET['orderid'];
include_once "../shared/connection.php";


$order_stat=mysqli_query($conn,"SELECT orderstatus FROM orders WHERE orderid=$orderid");
$stat=mysqli_fetch_assoc($order_stat);
if($stat['orderstatus'] == 'NOT DELIVERED'){
    $status=mysqli_query($conn,"DELETE FROM orders WHERE orderid=$orderid");
    if($status){
        echo "Order Cancelled";
        echo '<script>alert("Oreder CANCELLED"); window.location="orders.php";</script>';

    }
    else{
        echo "Order cancel failed";
        echo mysqli_error($conn);
    }
}
else{
    echo '<script>alert("Oreder Cancel Failed! Order was already DELIVERED!"); window.location="orders.php";</script>';

}



?>

