<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        /* .sticky {
            position: top;
            top: 20px; 
            background-color: #f1f1f1; 
            padding: 10px;
        } */
        .sticky {
            position: sticky;
            bottom: 0;
            background-color: yellow;
            height: 54px;
            
        }

    </style>
</head>
<body style="background-image: url('../shared/vwsy_trans.png');">
    
</body>
</html>


<?php

    include "authguard.php";
    include "menu.html";
    include_once "../shared/connection.php";
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
        Cart 
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


    $sql_result = mysqli_query($conn, "SELECT product.*, user.username, cart.cartid, cart.quantity FROM cart JOIN product ON cart.pid = product.pid JOIN user ON product.uploaded_by = user.userid WHERE cart.userid = $_SESSION[userid]");

    // $sql_result=mysqli_query($conn,"select * from cart join product on cart.pid=product.pid where cart.userid=$_SESSION[userid]");
    
    $pidInputs = [];
    $quantities = []; 
    $total=0.0;
    while($row=mysqli_fetch_assoc($sql_result))
    {
        $price = floatval(str_replace([',', ' '], '', $row['price']));   
        $total+=$price*$row['quantity'];
        $html = file_get_contents("cart.html");
        $html = str_replace('{Cart_id}', $row['cartid'], $html);
        $html = str_replace('{PRODUCT_ID}', $row['pid'], $html);
        $html = str_replace('{PRODUCT_NAME}', $row['name'], $html);
        $html = str_replace('{PRODUCT_PRICE}', $row['price'] . ' ISK', $html);
        $html = str_replace('{PRODUCT_IMAGE}', $row['impath'] . '?v=' . fileatime($row['impath']), $html);
        $html = str_replace('{PRODUCT_DETAIL}', $row['detail'], $html);
        $html = str_replace('{VENDOR_NAME}', $row['username'], $html);
        $html = str_replace('{QTY}', $row['quantity'], $html);

        $pidInputs[] = $row['pid'];
        $quantities[$row['pid']] = $row['quantity'];

        // $pidInputs[] = '<input type="hidden" name="pid[]" value="' . $row['pid'] . '">';

        echo $html;
        
    }
    $total_price = number_format($total, 0, '.', ',');

    // $totalFormatted = number_format($total, 0, '.', ',');
    // $checkoutHtml = file_get_contents("total.html");
    // $checkoutHtml = str_replace('{total}', $totalFormatted.' ISK', $checkoutHtml);
    // $checkoutHtml = str_replace('{pidInputs}', implode('', $pidInputs), $checkoutHtml);

    // $margineHtml = file_get_contents("margine.html");
    // echo $margineHtml;
    // echo "<div class='fixed-bottom'>$checkoutHtml</div>";
    ?>
</div>


<div class="bg-warning shadow-lg sticky">
    <form action="p_order.php" method="post" id="orderForm">
        <div class='text-end p-2'>
            <span class="fw-bold fs-5" style="margin-right: 5px; font-family: calibri;"> Order Total:
                <span class="text-danger"><?php echo $total_price . ' ISK'; ?></span>
            </span>

            
            <?php
            foreach ($pidInputs as $pid) {
                $quantity = $quantities[$pid]; 
                echo '<input type="hidden" name="pid[]" value="' . $pid . '">';
                echo '<input type="hidden" name="quantity[' . $pid . ']" value="' . $quantity . '">';
            }
            ?>

            <button type="submit" class="btn btn-dark p-2" id="bt1">Place Order</button>
        </div>
    </form>
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
        const name = card.getElementsByClassName('name')[0].textContent.toLowerCase();
        const pid = card.getElementsByClassName('pid')[0].textContent.toLowerCase();
        const detail = card.getElementsByClassName('detail')[0].textContent.toLowerCase();
        const username = card.getElementsByClassName('username')[0].textContent.toLowerCase();

        if (name.includes(searchTerm) || pid.includes(searchTerm) || detail.includes(searchTerm) || username.includes(searchTerm)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    }
}

    var pidInputs = document.getElementById("orderForm").querySelectorAll("input[name^='pid']");
    if (pidInputs.length === 0) {
        document.getElementById("bt1").style.display = "none"; // Hide the button
    }

</script>