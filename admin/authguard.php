<?php
    session_start();

    if(!isset($_SESSION['login_status'])){
        echo "Login First, Unauthorised Attempt";
        header("location:index.php");
        die;
    }
    if($_SESSION['login_status']==false){
        echo "Failed Login Attempt,Illegal Access";
        header("location:index.php");
        die;
    }
    if($_SESSION['usertype']!='Admin'){
        echo "Unauthorized to access this resource";
        header("location:index.php");
        die;
    }
?>