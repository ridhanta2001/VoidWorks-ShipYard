<?php

$uname = $_POST['uname'];
$upass = $_POST['upass1'];
$usertype = $_POST['usertype'];
$mobile = $_POST['mobile'];

$hash_pwd = md5($upass);

include_once "connection.php";

// Check if the username and usertype combination already exists
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND usertype = ?");
$stmt->bind_param("ss", $uname, $usertype);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<script>alert("Signup Failed! User already exists. Go to Login."); window.location="login.html";</script>';
    die;
}

// Insert the user data using prepared statements
$stmt = $conn->prepare("INSERT INTO user (username, password, usertype, mobile) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $uname, $hash_pwd, $usertype, $mobile);

if ($stmt->execute()) {
    echo '<script>alert("Signup Successful!"); window.location="login.html";</script>';
} else {
    echo "Signup Failed";
    echo mysqli_error($conn);
    echo '<a href="Signup.html">Go back to Signup....</a>';
}

$stmt->close();
$conn->close();
?>
