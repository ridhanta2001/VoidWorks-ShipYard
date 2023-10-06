<?php
// print_r($_POST);

$uname = $_POST['uname'];
$upassro = $_POST['upasso'];
$upass = $_POST['upass1'];
$usertype = $_POST['usertype'];

$hash_pwd = md5($upassro);
$hash_pwd2 = md5($upass);
include_once "connection.php";


$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ? AND usertype = ?");
$stmt->bind_param("sss", $uname, $hash_pwd, $usertype);
$stmt->execute();
$result = $stmt->get_result();

// print_r(mysqli_fetch_assoc($result));

if ($result->num_rows == 1) {
    
    $updateStmt = $conn->prepare("UPDATE user SET password = ? WHERE username = ? AND usertype = ?");
    $updateStmt->bind_param("sss", $hash_pwd2, $uname, $usertype);
    
    if ($updateStmt->execute()) {
        
        echo '<script>alert("Password Updated Successfully! Go to Login!"); window.location="login.html";</script>';
    } else {
        
        echo "Failed to update password: " . mysqli_error($conn);
    }

    $updateStmt->close();
} else {
    echo '<script>alert("Password Update Failed! Invalid Credentials"); window.location="resetpass.html";</script>';
}

$stmt->close();
$conn->close();
?>
