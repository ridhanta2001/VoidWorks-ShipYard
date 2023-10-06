<?php
include "authguard.php";
$id = $_SESSION['userid'];

// Generate a unique filename for the uploaded image
$time = time();
$fn = $id . '_' . $time . '.png';
$impath = "../shared/images/" . $fn;

// Move the uploaded file to the desired location
if (move_uploaded_file($_FILES["pdtimg"]["tmp_name"], $impath)) {
    // File upload successful

    include_once "../shared/connection.php";

    // Sanitize the user inputs using mysqli_real_escape_string
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $userid = $_SESSION['userid'];

    // Create a prepared statement to safely insert data into the database
    $stmt = mysqli_prepare($conn, "INSERT INTO product (name, price, detail, impath, uploaded_by) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ssssi", $name, $price, $detail, $impath, $userid);

    if (mysqli_stmt_execute($stmt)) {
        // Product inserted successfully
        echo "Product uploaded Successfully";
        echo '<script>alert("Upload Successful"); window.location="home.php";</script>';
    } else {
        // Failed to insert product
        echo "Failed to upload product";
        echo mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    // File upload failed
    echo "Error uploading the file.";
}
?>
