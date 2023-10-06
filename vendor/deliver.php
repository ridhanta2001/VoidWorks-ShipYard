<?php
include "authguard.php";
include_once "../shared/connection.php"; 


// Check if orderid is provided in the GET request.
if (isset($_GET['orderid'])) {
    $orderid = $_GET['orderid'];

    // Check if the order exists in the database.
    $checkOrderQuery = "SELECT * FROM orders WHERE orderid = '$orderid'";
    $result = mysqli_query($conn, $checkOrderQuery);

    if (mysqli_num_rows($result) > 0) {
        // The order exists; update its status to "DELIVERED."
        $updateQuery = "UPDATE orders SET orderstatus = 'DELIVERED' WHERE orderid = '$orderid'";

        if (mysqli_query($conn, $updateQuery)) {
            echo '<script>alert("Oreder DELIVERED!"); window.location="orders.php";</script>';
        } else {
            echo "Error updating order status: " . mysqli_error($conn);
        }
    } else {
        echo '<script>alert("Oreder Delivery Failed! Order was CANCELLED by CLIENT!"); window.location="orders.php";</script>';
    }
} else {
    echo "Order ID not provided in the GET request.";
}
?>



<!-- // Check if orderid is provided in the GET request.
if (isset($_GET['orderid'])) {
    // Sanitize the input to prevent SQL injection.
    $orderid = mysqli_real_escape_string($conn, $_GET['orderid']);

    // SQL query to update the order status to "DELIVERED."
    $sql = "UPDATE orders SET orderstatus = 'DELIVERED' WHERE orderid = '$orderid'";

    if (mysqli_query($conn, $sql)) {
        echo "Order status updated to DELIVERED for Order ID $orderid.";
        header("location:orders.php");
    } else {
        echo "Error updating order status: " . mysqli_error($conn);
    }
} else {
    echo "Order ID not provided in the GET request.";
} -->


