<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    

<?php

include "authguard.php";
include "menu.html";


include_once "../shared/connection.php";
$sql_qry=mysqli_query($conn,"select username from user where userid=$_SESSION[userid]");
$uname=mysqli_fetch_assoc($sql_qry);

?>

<nav class="navbar navbar-light bg-warning shadow-lg">
    <div class="container-fluid">
    <span style="padding: 7px; visibility: hidden;">XXX</span>
    </div>
    <div class="d-flex align-items-center position-absolute top-0 end-0 p-3">
        <span>
            <img src='../shared/account.png' alt="" width="20" height="20" style="margin-right: 5px;">
        </span>
        <span class="text-dark">
            <?php echo $uname['username']; ?>
        </span>
    </div>
</nav>

<?php
    include "add.html";
?>
<div style="margin-left: 13vw;"></div>
<div class="card-footer text-start bg-dark shadow-lg">
    <img src="../shared/ftr.png" alt="" style="padding-bottom:20px; margin-left: 20px; width: 25vw">
</div> 

</body>
</html>