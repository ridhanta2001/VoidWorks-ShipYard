<?php

include "authguard.php";
// print_r($_POST);

$uname = $_POST['uname'];
$usertype = $_POST['usertype'];

include_once "../shared/connection.php";

if (!empty($uname) && !empty($usertype)) {
    
    $sql = "DELETE FROM user WHERE username = ? AND usertype = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $uname, $usertype);

        if ($stmt->execute()) {
            echo '<script>alert("User deleted from database!"); window.location="home.php";</script>';
        } else {
            echo "Error deleting row: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }
} else {
    echo "Both 'uname' and 'usertype' parameters are required for deletion.";
}

$conn->close();

?>
