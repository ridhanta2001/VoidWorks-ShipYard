<?php
    include "authguard.php";
    include "menu.html";

    include_once "../shared/connection.php";

?>
   <nav class="navbar navbar-light bg-warning">
    <div class="container-fluid">
      <form class="d-flex">
        <input class="form-control me-2" type="text" placeholder="Search..." aria-label="Search" onkeyup="searchProducts()" id="searchInput">

      </form>
    </div>
  </nav>
<div style="margin-left: 13vw;" id="productContainer">
<?php
    $sql_result = mysqli_query($conn, "select * from orders");

        while ($row = mysqli_fetch_assoc($sql_result)) {
            
            $html = file_get_contents("orders.html");
            $html = str_replace('{orderid}', $row['orderid'], $html);
            $html = str_replace('{PRODUCT_NAME}', $row['name'], $html);
            $html = str_replace('{PRODUCT_PRICE}', $row['price'] . ' ISK', $html);
            $html = str_replace('{PRODUCT_IMAGE}', $row['impath'], $html);
            $html = str_replace('{ordertime}', $row['ordertime'], $html);

            echo $html;
        }



?>

</div>
<div class="card-footer  p-5 bg-dark">
<span style="visibility: hidden;" >XXXX</span>
</div>

<script>
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
    </script>