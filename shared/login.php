<?php

session_start();
$_SESSION['login_status'] = false;
$uname = $_POST['uname'];
$upass = $_POST['upass'];
$usertype = $_POST['usertype'];

$hash_pwd = md5($upass);

include_once "connection.php";

// Use prepared statement with parameter binding to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ? AND usertype = ?");
$stmt->bind_param("sss", $uname, $hash_pwd, $usertype);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $_SESSION['login_status'] = true;
    $_SESSION['usertype'] = $row['usertype'];
    $_SESSION['userid'] = $row['userid'];

    if ($row['usertype'] == "Vendor") {
        echo "Vendor Login Success";
        header("location:../vendor/home.php");
    } else {
        echo "Client Login Success";
        header("location:../client/home.php");
    }
} else {
    echo '<script>alert("Login Failed! Invalid Credentials"); window.location="login.html";</script>';
    die;
}

$stmt->close();
$conn->close();
?>
