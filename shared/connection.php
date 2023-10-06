<?php
    $conn=new mysqli("localhost","root","","acme23_jul",3306);
    if($conn->connect_error)
    {
        echo "DB Connection Failed";
        die;
    }
?>