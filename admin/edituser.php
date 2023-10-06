<?php

    include "authguard.php";
    // print_r($_POST);


    // $uname = $_POST['uname'];
    // $nuname = $_POST['nuname'];
    // $upass = $_POST['upass1'];
    // $usertype = $_POST['usertype'];
    // $mobile = $_POST['mobile'];

    // $hash_pwd = md5($upass);
    // echo $hash_pwd;

    include_once "../shared/connection.php";

    $uname = $_POST['uname'];
    $nuname = $_POST['nuname'];
    $upass = $_POST['upass1'];
    $mobile = $_POST['mobile'];
    $usertype = $_POST['usertype'];

    if (empty($nuname) && empty($upass) && empty($mobile)) {
        // No fields to update
        echo "No fields to update.";
    } else {
        $updateFields = array();
        $params = array();
    
        if (!empty($nuname)) {
            $updateFields[] = "username = ?";
            $params[] = $nuname;
        }
    
        if (!empty($upass)) {
            $hash_pwd = md5($upass);
            $updateFields[] = "password = ?";
            $params[] = $hash_pwd;
        }
    
        if (!empty($mobile)) {
            $updateFields[] = "mobile = ?";
            $params[] = $mobile;
        }
    
        $updateValues = implode(', ', $updateFields);
    
        $sql = "UPDATE user SET $updateValues WHERE username = ? AND usertype = ?";
        $params[] = $uname;
        $params[] = $usertype;
    
        $stmt = $conn->prepare($sql);
    
        if ($stmt) {
            $bindTypes = str_repeat('s', count($params)); // Assumes all parameters are strings
            $stmt->bind_param($bindTypes, ...$params);
    
            if ($stmt->execute()) {
                echo '<script>alert("Update Successful!"); window.location="home.php";</script>';
            } else {
                echo "Update failed: " . $stmt->error;
            }
    
            $stmt->close();
        } else {
            echo "Failed to prepare statement: " . $conn->error;
        }
    }
    
    $conn->close();
?>
