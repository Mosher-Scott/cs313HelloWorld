<?php

/****** Validation Functions *******/
    // Method to validate & sanitize the inputted data sent to it
    function validateInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /****** Page Building Functions *******/
    function buildProductDisplay($products) {

        $itemsPerRow = 0;
        
        foreach($products as $item) {
            if($itemsPerRow / 3 == 1) {
              echo "</div>";
              echo "</div>";
              $itemsPerRow = 0;
            }

            // Start of a new row of products
            if ($itemsPerRow == 0) {
              echo "<div class='container centered'>";
              // Start a new row of 4 products
              echo "<div class='row'>";
            }

              // Now setup individual products
              // Product div start
              echo "<div class='col-sm'>";

              echo "<h4>{$item['name']}</h4>"; // Title
              echo "<img class='product-thumbnail' src='images/{$item['image_name']}' alt='Mountain Bike Image'>"; // Image
              echo "<p>$ {$item['price']}</p>"; // Price
              
              echo "<form method='post'>";
              echo "<input type='hidden' name='action' value='addToCart'>";
              echo "<input type='hidden' name='id' value='{$item['id']}'>";
              echo "<input type='hidden' name='prodName' value='{$item['name']}'>";
              echo "<input type='hidden' name='price' value='{$item['price']}'>";
              echo "<input type='hidden' name='qty' value='1'>";
              echo "<button type='submit' class='btn btn-primary'>Add To Cart</button>";
              echo "</form>";
              
              echo "</div>"; // Product div end
              $itemsPerRow++;
          }
    }

    // Requires an array
    function productFormDisplay($item) {
        echo "<form method='post'>";
        echo "<input type='hidden' name='action' value='addToCart'>";
        echo "<input type='hidden' name='id' value='{$item['id']}'>";
        echo "<input type='hidden' name='prodName' value='{$item['name']}'>";
        echo "<input type='hidden' name='price' value='{$item['price']}'>";
        echo "<input type='hidden' name='qty' value='1'>";
        echo "<button type='submit' class='btn btn-primary'>Add To Cart</button>";
        echo "</form>";
    }

/****** Cart Functions *******/
    function emptyCart(){
        //unset($_SESSION['orderDetails']);
        unset($_SESSION["cart_items"]);
    }

    function resetCartDisplay() {
        echo"<form method='post'>";
        echo "<input type='hidden' name='action' value='emptyCart'>";
        echo "<button type='submit' class='btn btn-danger '>Empty Cart</button>";
        echo "</form>";
    }

    function additemToCart() {
        unset($_POST['action']);

        $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
      
        foreach($_POST as $key => $value) {
          $addedProduct[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
      
        $productFromDb = getSingleProduct($id);

        $addedProduct["id"] = $id;
        $addedProduct["name"] = $productFromDb[0]['name'];
        $addedProduct['price'] = $productFromDb[0]['price'];
        $addedProduct['image'] = $productFromDb[0]['image_name'];

        if(isset($_SESSION["cart_items"][$id]['qty'])) {
            $addedProduct['qty'] = $_SESSION["cart_items"][$id]['qty'] + 1;
        }
        

        if(isset($_SESSION["cart_items"])) {
            if(isset($_SESSION["cart_items"][$addedProduct['id']])) {
                unset($_SESSION["cart_items"][$addedProduct['id']]);
            } 
        }

        $_SESSION["cart_items"][$addedProduct['id']] = $addedProduct;
    }

    function sideBarShoppingCart() {
        echo"<h3>Your Cart</h3>";

        if(!isset($_SESSION["cart_items"])) {
            echo "<h5>Your cart is empty</h5>";
        }
        if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) {
            $total = 0;
            echo "<table class='sidebar-table'>";
            echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Qty  </th>";
            echo "<th>Price</th>";
            echo "</tr>";

            foreach ($_SESSION["cart_items"] AS $item) {
                echo "<tr>";
                echo "<td>{$item['name']}</td>";
                echo "<td>{$item['qty']}</td>";
                echo "<td>{$item['price']}</td>"; 
                echo "</tr>";
            }
            echo "</table>";
            echo"<a href='cart.php' class='btn btn-primary'>View Cart</a>";
            resetCartDisplay();
        }
    }

    function shoppingCartPageDisplay() {
        echo"<h3>Your Cart Items</h3>";

        if(!isset($_SESSION["cart_items"])) {
            echo "<h5>Your cart is empty</h5>";
        }

        if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) {
            $total = 0;
            echo "<table class='cart-page-table'>";
            echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Qty</th>";
            echo "<th>Price</th>";
            echo "<th>Image</th>";
            echo "</tr>";

            foreach ($_SESSION["cart_items"] AS $item) {
                echo "<tr>";
                echo "<td>{$item['name']}</td>";
                echo "<td>{$item['qty']}</td>";
                echo "<td>{$item['price']}</td>"; 
                echo "<td><img class='product-thumbnail' src='images/{$item['image']}' alt='Mountain Bike Image'></td>";
                echo "</tr>";
        }

        echo "</table>";
        resetCartDisplay();
        }
    }

/*********  Misc Functions ***************/

function displayCartArray() {
    print("<pre>".print_r($_SESSION['cart_items'],true)."</pre>");
}
?>