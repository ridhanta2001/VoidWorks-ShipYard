<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body style="background-image: url('../shared/vwsy_trans.png');">

<?php
include "authguard.php";
include "menu.html";

include_once "../shared/connection.php";
$sql_qry = mysqli_query($conn, "select username from user where userid=$_SESSION[userid]");
$uname = mysqli_fetch_assoc($sql_qry);
?>

    <nav class="navbar navbar-light bg-warning shadow-lg">
        <div class="container-fluid">
            <form class="d-flex">
                <input class="form-control me-2" type="text" placeholder="Search..." aria-label="Search" onkeyup="searchProducts()" id="searchInput">
            </form>
        </div>
        <div class="d-flex justify-content-center align-items-center text-dark position-absolute top-0 start-50 p-2 fs-3" style="width: fit-content; transform: translateX(-50%);">
            Orders 
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
    <div class="p-4 shadow-lg" style="margin-left: 13vw; min-height: 100vh;" id="productContainer">

        <?php
        $sql_result = mysqli_query($conn, "SELECT orders.*, user.username FROM orders JOIN user ON orders.uploaded_by = user.userid WHERE orders.userid = $_SESSION[userid]");
 


        while ($row = mysqli_fetch_assoc($sql_result)) {

            $total = 0.0;
            $price = floatval(str_replace([',', ' '], '', $row['price']));
            $total = $total+=$price*$row['quantity'];
            $total_price = number_format($total, 0, '.', ',');

            echo '<div class="card mb-3 m-2 shadow-lg" style="max-width: 100vw; height: 20vh; ">';
            echo '<div class="row no-gutters">';
            echo '<div class="col-md-4" style="max-width: 11vw; margin: 1px;">';
            echo '<img class="card-img" src=' . $row['impath'] . "?v=" . fileatime($row['impath']) . '>';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title name">' . $row['name'] . '</h5>';
            echo '<h6 class="card-title text-danger">' . $row['price'] . ' ISK</h6>';
            echo '<h6 class="card-title text-dark position-absolute top-0 end-0 m-4 fw-light">Order Status: ';
            echo '<span class="text-muted fw-bold" id="os1' . $row['orderid'] . '">' . $row['orderstatus'] . '</span></h6>';
            echo '<button class="delete btn-dark p-2 rounded-3 position-absolute end-0 m-4" onclick="altAdd(' . $row['orderid'] . ')" id="btt1' . $row['orderid'] . '">Cancel Order</button>';
            echo '<p class="card-text"><small class="text-muted orderid">Ordered On: ' . $row['ordertime'] . '<span style="margin-left: 10px;">Order ID: ' . $row['orderid'] . '</span></small></p>';
            echo '<p class="card-text"><small class="text-muted uploaded_by">Vendor UID: ' . $row['uploaded_by'] . '<span class="username" style="margin-left: 10px;">Vendor Name: ' . $row['username'] . '</span></small></p>';
            echo '<p class="card-text"><small class="text-muted quantity">QTY: ' . $row['quantity'] . '<span class="total" style="margin-left: 10px;">Total: <span class="text-primary" style="font-family: calibri; font-weight: light;">' . $total_price . ' ISK' . '</span></span></small></p>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="card-footer text-start bg-dark shadow-lg">
        <img src="../shared/ftr.png" alt="" style="padding-bottom:20px; margin-left: 20px; width: 25vw">
    </div>    


    <script>
        // function addToCart(pid) {
        //     alert("Added to Cart: Product ID " + pid);
        // }

        function searchProducts() {
        const searchInput = document.getElementById('searchInput');
        const productContainer = document.getElementById('productContainer');
        const searchTerm = searchInput.value.toLowerCase();

        const productCards = productContainer.getElementsByClassName('card');
        for (const card of productCards) {
            const productName = card.getElementsByClassName('name')[0].textContent.toLowerCase();
            const orderid = card.getElementsByClassName('orderid')[0].textContent.toLowerCase();
            const userid = card.getElementsByClassName('uploaded_by')[0].textContent.toLowerCase();
            const cname = card.getElementsByClassName('username')[0].textContent.toLowerCase();

            if (productName.includes(searchTerm) || orderid.includes(searchTerm) || userid.includes(searchTerm) || cname.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
        }


        function altAdd(orderid) {
            res = confirm("Cancel Order?");
            if (res) {
                window.location=`cancelorder.php?orderid=` + orderid;
            }
        }

        
    
    function checkOrderStatus() {
        const orderStatusElements = document.querySelectorAll('[id^="os1"]');
        const cancelButtonElements = document.querySelectorAll('[id^="btt1"]');

        for (let i = 0; i < orderStatusElements.length; i++) {
            const orderStatusElement = orderStatusElements[i];
            const cancelButtonElement = cancelButtonElements[i];

            const orderStatus = orderStatusElement.textContent.trim();

            if (orderStatus === 'DELIVERED') {
                // Change the class of the span
                orderStatusElement.classList.remove('text-muted');
                orderStatusElement.classList.add('text-success');

                // Hide the button
                cancelButtonElement.style.display = 'none';
            }
        }
    }

    // Call the function to check the order status when the page loads
    window.addEventListener('load', checkOrderStatus);






    </script>
</body>
</html>