<?php
include "authguard.php";
$pid = $_GET['pid'];
include_once "../shared/connection.php";


$result = mysqli_query($conn, "SELECT impath FROM product WHERE pid = $pid");

if ($result && $row = mysqli_fetch_assoc($result)) {
    $impath = $row['impath'];


    $deleteStatus = mysqli_query($conn, "DELETE FROM product WHERE pid = $pid");

    if ($deleteStatus) {

        echo '<script>alert("Product Deleted!"); window.location="home.php";</script>';

        // echo "Item removed successfully";
        
        // // // Delete the file from the server
        // // if (file_exists($impath) && unlink($impath)) {
        // //     echo "File deleted successfully";
        // // } else {
        // //     echo "Failed to delete the file";
        // // }
        
        // header("location: home.php");
    } else {
        echo "Failed to delete item";
        echo mysqli_error($conn);
    }
} else {
    echo "Failed to retrieve impath";
}

?>
