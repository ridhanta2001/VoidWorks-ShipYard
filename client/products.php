<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
            Products 
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

    <!-- <div class="bg-secondary d-flex justify-content-end p-2 border-top">
        <input class="search" type="text" placeholder="Search...." onkeyup="searchProducts()" id="searchInput">
    </div> -->

    <div id="productContainer" class="d-flex flex-wrap gap-2 p-4 shadow-lg" style="min-height: 100vh; margin-left: 13vw;" >
    
        <?php
        // $sql_result = mysqli_query($conn, "select * from product");
        $sql_result = mysqli_query($conn, "SELECT product.*, user.username FROM  product JOIN user ON product.uploaded_by = user.userid");
        // $aun_qry = mysqli_query($conn,"SELECT user.username, user.userid, product.uploaded_by FROM product INNER JOIN user ON product.uploaded_by=user.userid;");
        // $aun = mysqli_fetch_assoc($aun_qry);

        
        while ($row = mysqli_fetch_assoc($sql_result,)) {
            // $aun = mysqli_fetch_assoc($aun_qry);
            $html = file_get_contents("products.html");
            $html = str_replace('{PRODUCT_ID}', $row['pid'], $html);
            $html = str_replace('{PRODUCT_NAME}', $row['name'], $html);
            $html = str_replace('{PRODUCT_PRICE}', $row['price'] . ' ISK', $html);
            $html = str_replace('{PRODUCT_IMAGE}', $row['impath'] . '?v=' . fileatime($row['impath']), $html);
            $html = str_replace('{PRODUCT_DETAIL}', $row['detail'], $html);
            $html = str_replace('{VENDOR_NAME}', $row['username'], $html);
            echo $html;
        }
        ?>
    </div>
    <div class="card-footer text-start bg-dark shadow-lg">
        <img src="../shared/ftr.png" alt="" style="padding-bottom:20px; margin-left: 20px; width: 25vw">
    </div>    


    <!-- <script>
        // JavaScript function for adding products to the cart
        function addToCart(pid) {
            // You can implement the logic to add the product to the cart here.
            // You might need to use AJAX or a form submission to interact with the server.
            alert("Added to Cart: Product ID " + pid);
        }

        // JavaScript function for searching products
        function searchProducts() {
            const searchInput = document.getElementById('searchInput');
            const productContainer = document.getElementById('productContainer');
            const searchTerm = searchInput.value.toLowerCase();

            // Filter the products based on the search term
            const productCards = productContainer.getElementsByClassName('card');
            for (const card of productCards) {
                const productName = card.getElementsByClassName('name')[0].textContent.toLowerCase();
                card.style.display = productName.includes(searchTerm) ? 'block' : 'none';
            }
        }
    </script> -->

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


    </script>
    

</body>
</html>