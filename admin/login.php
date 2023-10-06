<?php

    session_start();
    $_SESSION['login_status']=false;
    $uname=$_POST['uname'];
    $upass=$_POST['upass'];
    

    $hash_pwd=md5($upass);

    // echo $uname,$hash_pwd,$usertype;

    include_once "../shared/connection.php";

    $result=mysqli_query($conn,"select * from user where username='$uname' and password='$hash_pwd' and usertype='Admin'");
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
        // print_r($row);
        $_SESSION['login_status']=true;
        $_SESSION['usertype']=$row['usertype'];
        $_SESSION['userid']=$row['userid'];

        if($_SESSION['login_status']===true)
        {
            echo "Admin Login Success";
            header("location:home.php");
        }

    }

    else
    {
        echo '<script>alert("Login Failed! Invalid Credentials"); window.location="index.php";</script>';
    
        die;
    }
    
    
    


?>