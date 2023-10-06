<?php

include "authguard.php";
include "../shared/connection.php";

$pid = $_POST["pid"];
$name = $_POST["name"];
$price = $_POST["price"];
$detail = $_POST["detail"];

// Fetch the existing values from the database
$query = "SELECT name, price, detail FROM product WHERE pid = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $pid);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $existingName, $existingPrice, $existingDetail);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

// Update fields only if the corresponding POST data is not empty
if (!empty($name)) {
    $existingName = $name;
}
if (!empty($price)) {
    $existingPrice = $price;
}
if (!empty($detail)) {
    $existingDetail = $detail;
}

// Execute separate update queries for each field
$query = "UPDATE product SET name = ?, price = ?, detail = ? WHERE pid = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sssi", $existingName, $existingPrice, $existingDetail, $pid);

if (mysqli_stmt_execute($stmt)) {
    echo "Record updated successfully.";
    echo '<script>alert("Record Update Successful"); window.location="home.php";</script>';
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);

?>