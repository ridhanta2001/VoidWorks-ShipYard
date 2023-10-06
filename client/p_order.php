<?php
include "authguard.php";
print_r($_POST);

$pids = $_POST['pid'];
$userid = $_SESSION['userid'];
$quantities = $_POST['quantity'];

include_once "../shared/connection.php";


foreach ($pids as $pid) {
    $quantity = $quantities[$pid]; 
    $sql = "INSERT INTO orders (pid, userid, name, price, quantity, uploaded_by, impath)
            SELECT pid, $userid, name, price, $quantity, uploaded_by, impath
            FROM product
            WHERE pid = $pid";

    if (mysqli_query($conn, $sql)) {
        echo "Insert successful for PID $pid<br>";
    } else {
        echo "Insert failed for PID $pid: " . mysqli_error($conn) . "<br>";
    }
}

header("location:ty.php");


?>
