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
    // Builds the webpage used for displaying products on the page
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
              echo "<div class='col-lg'>";

              echo "<h4>{$item['name']}</h4>"; // Title
              echo "<img class='product-thumbnail' src='images/{$item['image_name']}' alt='Mountain Bike Image'>"; // Image
              echo "<p>$ {$item['price']}</p>"; // Price
              echo "<div>";
              echo "<div class='d-inline'>";
              productFormDisplayAddItem($item);
              productFormDisplaysubtractItem($item);
              echo "</div>";
              echo "</div>";

              echo "</div>"; // Product div end
              $itemsPerRow++;
          }
    }

    // Creates a sidebar version of the shopping cart, listing the item, qty, and price
    function sideBarShoppingCart() {
        echo"<h3>Your Cart</h3>";

        if(!isset($_SESSION["cart_items"])) {
            echo "<h5>Your cart is empty</h5>";
        }
        if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) {
            $total = 0;
            echo "<table class='table'>";
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

    // Creates the page for displaying product items.  Includes product name, qty, price, and thumbnail image
    function shoppingCartPageDisplay() {
        echo"<h3>Your Cart Items</h3>";

        if(!isset($_SESSION["cart_items"])) {
            echo "<h5>Your cart is empty</h5>";
        }

        if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) {
            $total = 0;
            echo "<table class='table'>";
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
                echo "<td>$ {$item['price']}</td>"; 
                echo "<td><img class='product-thumbnail' src='images/{$item['image']}' alt='Mountain Bike Image'></td>";
                echo "<td>";
                productFormDisplayAddItem($item);
                echo "</td>";
                echo "<td>";
                productFormDisplaysubtractItem($item);
                echo "</td>";
                echo "</tr>";
        }

        echo "</table>";
        }
    }

    // Creates the page for displaying product items.  Includes product name, qty, price, and thumbnail image

    //TODO: Write this function
    function createOrderDetailDisplay($orderItems) {

        echo "<table class='table'>";
        echo "<tr>";
        echo "<th>Product</th>";
        echo "<th>Qty</th>";
        echo "<th>Image</th>";
        echo "<th>Price</th>";
        echo "<th>Item Total</th>";
        echo "</tr>";

        $orderTotal = 0;
        foreach ($orderItems AS $item) {
            $itemTotal = $item['quantity'] * $item['price'];
            echo "<tr>";
            echo "<td>{$item['name']}</td>";
            echo "<td>{$item['quantity']}</td>";
            echo "<td><img class='product-thumbnail' src='images/{$item['image_name']}' alt='{$item['description']}'></td>";
            echo "<td>$ {$item['price']}</td>"; 
            echo "<td>$ {$itemTotal}";
            echo "</tr>";
            $orderTotal += $itemTotal;
        }

        echo "</table>";
    }

        // Creates confirmation page version of the shopping cart
        function confirmationPageProductDisplay() {
            echo"<h3>Ordered Items</h3>";
    
            if(!isset($_SESSION["cart_items"])) {
                echo "<h5>Your cart is empty</h5>";
            }
            if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"]) > 0) {
                $total = 0;
                echo "<table class='table table-striped'>";
                echo "<tr>";
                echo "<th>Product</th>";
                //echo "<th></th>";
                echo "<th>Qty</th>";
                echo "<th>Price</th>";
                echo "<th>Item Total</th>";
                echo "</tr>";
    
                foreach ($_SESSION["cart_items"] AS $item) {

                    $itemTotal = $item['qty'] * $item['price'];
                    $total += $total + $itemTotal;
                    echo "<tr>";
                    echo "<td>{$item['name']}</td>";
                    //echo "<td><img class='product-thumbnail' src='images/{$item['image']}' alt='Mountain Bike Image'></td>";
                    echo "<td>{$item['qty']}</td>";
                    echo "<td>$ {$item['price']}</td>"; 
                    echo "<td>$ {$itemTotal}</td>"; 
                    echo "</tr>";
                }
                echo "<tr>";
                echo "<td><b>Total:      <span>$ {$total}</span></b></td>";
                echo "</table>";

            }
        }

    // Requires an array. Creates the form for adding an item to the cart
    function productFormDisplayAddItem($item) {
        echo "<form method='post' class='d-inline'>";
        echo "<input type='hidden' name='action' value='modifyCart'>";
        echo "<input type='hidden' name='id' value='{$item['id']}'>";
        echo "<input type='hidden' name='prodName' value='{$item['name']}'>";
        echo "<input type='hidden' name='price' value='{$item['price']}'>";
        echo "<input type='hidden' name='qty' value='1'>";
        echo "<button type='submit' class='btn btn-primary'>Add 1</button>";
        echo "</form>";
    }

    // Requires an array.  Creates the form for removing 1 item from the cart by reducing qty by 1
    function productFormDisplaysubtractItem($item) {
        echo "<form method='post' class='d-inline'>";
        echo "<input type='hidden' name='action' value='modifyCart'>";
        echo "<input type='hidden' name='id' value='{$item['id']}'>";
        echo "<input type='hidden' name='prodName' value='{$item['name']}'>";
        echo "<input type='hidden' name='price' value='{$item['price']}'>";
        echo "<input type='hidden' name='qty' value='-1'>";
        echo "<button type='submit' class='btn btn-primary'>Remove 1</button>";
        echo "</form>";
    }

/****** Search Forms *******/
    // Search for for finding products in the database
    function searchForm() {
        echo "<form method='post'>";
        echo "<label for='searchByName'>Search For Product </label>";
        echo "<input type='text' name='searchByName'>";
        echo "<input type='hidden' name='action' value='productSearch'>";
        echo "<button type='submit' class='btn btn-primary btn-sm'>Submit</button>";
        echo "</form>";
    }

    // Search for order by username
    function searchByFirstName(){
        echo "<form method='post'>";
        echo "<label for='nameToFind'>First Name</label>";
        echo "<input type='text' name='nameToFind'>";
        echo "<input type='hidden' name='action' value='searchByFirstName'>";
        echo "<button type='submit' class='btn btn-primary btn-sm'>Submit</button>";
        echo "</form>";
    }

/****** Buttons *******/  
    // The checkout button.  If cart is empty, the button click will be disabled
    function checkoutButton() {
        if (!isset($_SESSION["cart_items"])) {
            echo "<p class='btn btn-disabled'>Checkout</p>";
          } else {
            echo "<a href='checkout.php' class='btn btn-primary'>Checkout</a>";
          }
    }

    // Button to click to go back to the admin page
    function backToAdminPageButton() {
        echo "<a href='orderAdmin.php' class='btn btn-primary btn-sm'>Back to Admin Page</a>";
    }

    // Button for emptying all contents from the shopping cart
    function resetCartDisplay() {
        echo"<form method='post'>";
        echo "<input type='hidden' name='action' value='emptyCart'>";
        echo "<button type='submit' class='btn btn-danger '>Empty Cart</button>";
        echo "</form>";
    }

/****** Cart Functions *******/

    // Removes all items from the shopping cart
    function emptyCart(){
        //unset($_SESSION['orderDetails']);
        unset($_SESSION["cart_items"]);
    }

    // Modifies the content of the shopping cary session variable.  Will change qty based on the post['qty'] value, either positive or negative.  If the qty value = 0, it will end up being removed from the cart
    function modifyCart() {
        // Unset the action variable from the array, we don't need it
        unset($_POST['action']);

        // Santize the value
        $id = filter_var($_POST['id'], FILTER_SANITIZE_STRING);
        
        // Add each id as a key, after being filtered
        foreach($_POST as $key => $value) {
          $addedProduct[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
      
        // Query the database to make sure the item exists
        $productFromDb = getSingleProduct($id);

        // Add product attributes to the product array
        $addedProduct["id"] = $id;
        $addedProduct["name"] = $productFromDb[0]['name'];
        $addedProduct['price'] = $productFromDb[0]['price'];
        $addedProduct['image'] = $productFromDb[0]['image_name'];
        $qty = $_POST['qty'];

        // If the qty for the session variable has been set, add it back to the $addedProduct array, + 1.
        if(isset($_SESSION["cart_items"][$id]['qty'])) {
            $addedProduct['qty'] = $_SESSION["cart_items"][$id]['qty'] + $qty;
        }

        // Now check if the item is in the session.  If it is, remove it
        if(isset($_SESSION["cart_items"])) {
            if(isset($_SESSION["cart_items"][$addedProduct['id']])) {
                unset($_SESSION["cart_items"][$addedProduct['id']]);
            } 
        }

        // Now add it back in if the qty ordered is more than 1
        if($addedProduct['qty'] > 0) {
            $_SESSION["cart_items"][$addedProduct['id']] = $addedProduct;
        }
    }

/*********  Order Display Functions ***************/

// Creates the table for displaying all orders in the database
function createOrderDisplayTable($orders){
    echo "<table class='table table-striped'>";
   
    // Setup table headers
    echo "<tr>";
    echo "<th scope='col'>Order ID</th>";
    echo "<th scope='col'>Order Date</th>";
    echo "<th scope='col'>Status</th>";
    echo "<th scope='col'h>Ship Method</th>";
    echo "<th scope='col'>First Name</th>";
    echo "<th scope='col'>Last Name</th>";
    echo "<th scope='col'>Address</th>";
    echo "<th scope='col'>City</th>";
    echo "<th scope='col'>State</th>";
    echo "<th scope='col'>Zip</th>";
    echo "<th scope='col'>Email</th>";
    echo "<th scope='col'>Details</th>";
    echo "</tr>";

    // Now populate it with data
    foreach ($orders as $order) {

        $date = $str=substr($order['order_date'], 0, strrpos($order['order_date'], ' '));
        echo "<tr>";
        echo "<td>{$order['id']}</td>";
        echo "<td>$date</td>";
        echo "<td>{$order['status']}</td>";
        echo "<td>{$order['method']}</td>";
        echo "<td>{$order['first_name']}</td>";
        echo "<td>{$order['last_name']}</td>";
        echo "<td>{$order['ship_address']}</td>";
        echo "<td>{$order['ship_city']}</td>";
        echo "<td>{$order['ship_state']}</td>";
        echo "<td>{$order['ship_zip']}</td>";
        echo "<td>{$order['email']}</td>";
        echo "<td><a href='orderDetails.php?orderId={$order['id']}' class='btn btn-primary btn-sm'>Details</a>";
        echo "</tr>";
    }

    echo "</table>";

}

/*********  Misc Functions ***************/
// For troubleshooting

// Displays the session cart items.  
function displayCartArray() {
    print("<pre>".print_r($_SESSION['cart_items'],true)."</pre>");
}

// Will nicely display the items in any array
function debugArray($arraytoView) {
    print("<pre>".print_r($arraytoView,true)."</pre>");
}

?>