<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>
<body style="background-image: url('../shared/vwsy_trans.png');">
<?php

    include "authguard.php";
    include_once "../shared/connection.php";
    include "menu.html";

    $sql_qry=mysqli_query($conn,"select username from user where userid=$_SESSION[userid]");
    $uname=mysqli_fetch_assoc($sql_qry);
    
    ?>

    <nav class="navbar navbar-light bg-warning shadow-lg">
        <div class="container-fluid">
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search..." aria-label="Search" onkeyup="searchProducts()" id="searchInput">
            </form>
        </div>
        <div class="d-flex justify-content-center align-items-center text-dark position-absolute top-0 start-50 p-2 fs-3" style="width: fit-content; transform: translateX(-50%);">
            Home 
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

    

    <div id="productContainer" class="d-flex flex-wrap gap-2 p-4 shadow-lg" style="min-height: 100vh; margin-left: 13vw;" >
        <?php
        $sql_result=mysqli_query($conn,"select * from product where uploaded_by=$_SESSION[userid]");
        // print_r($sql_result);

        while ($row = mysqli_fetch_assoc($sql_result)) {
            
            $html = file_get_contents("view.html");
            $html = str_replace('{PRODUCT_ID}', $row['pid'], $html);
            $html = str_replace('{PRODUCT_NAME}', $row['name'], $html);
            $html = str_replace('{PRODUCT_PRICE}', $row['price'] . ' ISK', $html);
            $html = str_replace('{PRODUCT_IMAGE}', $row['impath'] . '?v=' . fileatime($row['impath']), $html);
            $html = str_replace('{PRODUCT_DETAIL}', $row['detail'], $html);
            
            echo $html;
        }

        ?>
    </div>

    <div class="card-footer text-start bg-dark shadow-lg">
        <img src="../shared/ftr.png" alt="" style="padding-bottom:20px; margin-left: 20px; width: 25vw">
    </div>    


    <script>


        function searchProducts() {
            const searchInput = document.getElementById('searchInput');
            const productContainer = document.getElementById('productContainer');
            const searchTerm = searchInput.value.toLowerCase();

            const productCards = productContainer.getElementsByClassName('card');
            for (const card of productCards) {
                const productName = card.getElementsByClassName('name')[0].textContent.toLowerCase();
                const productPid = card.getElementsByClassName('pid')[0].textContent.toLowerCase();
                const productDetail = card.getElementsByClassName('detail')[0].textContent.toLowerCase();

                if (productName.includes(searchTerm) || productPid.includes(searchTerm) || productDetail.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        }
        


    </script>


    
</body>    
</html>    
