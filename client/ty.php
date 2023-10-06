<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<?php
    include "authguard.php";
    include "menu.html";
    include_once "../shared/connection.php";
    $sql_qry=mysqli_query($conn,"select username from user where userid=$_SESSION[userid]");
    $uname=mysqli_fetch_assoc($sql_qry);
?>

<body style="background-image: url(./assets/ty.png);">
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
    <div class="m-4 shadow-lg d-flex justify-content-center align-items-center position-relative" style="min-height: 95vh" >
            <div class="d-flex justify-content-center align-items-center position-relative " style=" padding-left: 1rem; padding-right: 1rem; padding-bottom: 3rem;  height: 30vh; width: 100%; background-color: rgba(255,255,255,0.7); margin: 0 auto;">
            <h1 style="font-family: calibri; font-weight: bold; font-size: 5vh;">Thank you for your order</h1>
                <!-- <img src="./assets/vs_lg_fl.png" alt="" style="max-width: 50vw;  " class="d-block"> -->
                <div class="d-flex justify-content-center align-items-center text-muted position-absolute bottom-0 start-50 p-3 fs-3 mb-5" style="width: fit-content; transform: translateX(-50%);">
                    <a href="orders.php" class="fs-6" style="text-decoration: none; color: white;">
                        <button class="btn-dark p-3 rounded-3">View Orders</button>
                    </a>
                </div>
            </div>
    

    </div>    



    <div class="card-footer text-start bg-dark shadow-lg">
        <img src="../shared/ftr.png" alt="" style="padding-bottom:20px; margin-left: 20px; width: 25vw">
    </div>    

</body>
</html>