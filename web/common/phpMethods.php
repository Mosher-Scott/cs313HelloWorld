<?php

/****** Validation Functions *******/
    // Method to validate & sanitize the inputted data sent to it
    function validateInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate email entry
    function checkEmail($clientEmail) {
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    // Check if the password is valid form
    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
        return preg_match($pattern, $clientPassword);
    }

    // TODO: Write method to check if username & password match.  Returns true or false

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

    // Checkout form
    function checkoutForm() {

        // TODO: Add in payment info
        $name = '';
        $email = '';
        $street = '';
        $city = '';
        $state = '';
        $zipcode = '';
        $phone = '';
        $shipSame ='';
        $comments = '';

        // Error message variables
        $nameError = null;
        $emailError = null;
        $streetError = null;
        $cityError = null;
        $stateError = null;
        $phoneError = null;
        $zipcodeError = null;
        $phone = null;

        // Get all the shipping methods available
        $shipMethods = getShipMethods();

        // Form creation
        echo "<form action='checkout.php' method='post' class='form-horizontal blue-border-left-side'>";
        echo "<div class='form-group'>";
        echo "<label for='nameInputBox' class='col-sm-1 control-label'>Name:</label>";
        echo "<div class='col-sm-6'>    ";
        echo "<input type='text' name='name' id='nameInputBox' class='form-control' placeholder='Enter name' value='{$name}'>";
        echo "<span class='text-danger'>{$nameError}</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='emailInputBox' class='col-sm-2 control-label'>Email:</label>";
        echo "<div class='col-sm-7'>    ";
        echo "<input type='text' name='email' id='emailInputBox' class='form-control' placeholder='Enter email' value='{$email}'>";
        echo "<span class='text-danger'>$emailError</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='phoneInputBox' class='col-sm-1 control-label'>Phone:</label>";
        echo "<div class='col-sm-6'>    ";
        echo "<input type='text' name='phone' id='phoneInputBox' class='form-control' placeholder='Enter Phone' value='{$phone}'>";
        echo "<span class='text-danger'>$phoneError</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='streetInputBox' class='col-sm-1 control-label'>Street:</label>";
        echo "<div class='col-sm-6'>    ";
        echo "<input type='text' name='street' id='streetInputBox' class='form-control' placeholder='Enter Street' value='{$street}'>";
        echo "<span class='text-danger'>$streetError</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='cityInputBox' class='col-sm-1 control-label'>City:</label>";
        echo "<div class='col-sm-6'>    ";
        echo "<input type='text' name='city' id='cityInputBox' class='form-control' placeholder='Enter City' value='{$city}'>";
        echo "<span class='text-danger'>$cityError</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='stateInputBox' class='col-sm-1 control-label'>State:</label>";
        echo "<div class='col-sm-6'>    ";
        echo "<input type='text' name='state' id='stateInputBox' class='form-control' placeholder='Enter State' value='{$state}'>";
        echo "<span class='text-danger'>$stateError</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='zipInputBox' class='col-sm-1 control-label'>Zipcode:</label>";
        echo "<div class='col-sm-6'>    ";
        echo "<input type='text' name='zipcode' id='zipInputBox' class='form-control' placeholder='Enter Zipcode' value='{$zipcode}'>";
        echo "<span class='text-danger'>$zipcodeError</span>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<div class='col-sm-7 checkbox-inline'>";
        echo "<p><b>Shipping the same as Billing?</b></p>";
        echo "<label class='checkbox-inline'><input type='checkbox' name='shipSame' value='1' <?php if(isset($shipSame)) echo 'checked'}> Yes</label>";
        echo "</div>";
        echo "</div>";

        echo "<div class='form-group'>";
        echo "<label for='commentInputBox' class='col-sm-2 control-label'>Comments:</label>";
        echo "<div class='col-sm-7'>";
        echo "<textarea name='comments' id='commentInputBox' class='form-control' placeholder='Comments?'></textarea>";
        echo "</div>";
        echo "</div>";

        echo "<div class='col-lg-2'>";
        echo "<input type='submit' class='btn btn-primary' value='Place Order'></button>";
        echo "</div>";
        echo "</form>";
        
    }

    // Login page method
    function loginForm($email = '') {
        echo "<form class='form-horizontal' method='post'>";

        echo "<div class='form-inline'>";
        echo "<label for='userEmail' class='col-sm-1 control-label'>Email:</label>";
        echo "<div class='col-sm-6'>";
        echo "<input type='text' class='form-control' placeholder='Enter Email' id='userEmail' name='userEmail' required value='{$email}'>";
        echo "</div>";
        echo "</div>";


        echo "<div class='form-inline'>";
        echo "<label for='password' class='col-sm-1 control-label'>Password:</label>";
        echo "<div class='col-med-6'>";
        echo "<input type='text' name='password' id='passwordInputBox' class='form-control' placeholder='Enter password' required>";
        // Original
        // echo "<input type='text' name='password' id='passwordInputBox' class='form-control' placeholder='Enter password' required pattern=(?=echo '.{4,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$>";
        echo "</div>";
        echo "</div>";


        echo "<p class='text-danger'>Passwords must be a minimum of 8 characters, and contain at least 1 of the following: Number, Capital letter, special character</p>";

        echo "<p>Forgot password? <a href=''>Send Reset Email</a>";
        echo "<br>";
        echo "<input type='hidden' name='action' value='loginRequest'>";
        echo "<input type='submit' class='submitButton' value='Sign In'>";
        echo "</form>";
    }

    // "Site" nav bar for customers
    function customerMtbMenu() {
        echo "<div class='container'>";
        echo "<label for='toggle'>Menu</label>";
        echo "<input id='toggle' type='checkbox'>";
        echo "<ul id='menu'>";
        echo "<li class=' btn btn-primary'><a href='products.php'>Products</a></li>";
        echo "<li class=' btn btn-primary'><a href='cart.php'>Cart</a></li>";
        if($_SESSION['loggedIn']) {
            logOutButton();
            
        } else {
            echo "<li class=' btn btn-primary'><a href='login.php'>Login</a></li>";
        }
        echo "</ul>";
        echo "</div>";
    }

    // "Site" nav bar for admins
    function adminMtbMenu() {
        echo "<div class='container'>";
        echo "<label for='toggle'>Menu</label>";
        echo "<input id='toggle' type='checkbox'>";
        echo "<ul id='menu'>";
        echo "<li class=' btn btn-primary'><a href='products.php'>Products</a></li>";
        echo "<li class=' btn btn-primary'><a href='cart.php'>Cart</a></li>";
        echo "<li class=' btn btn-primary'><a href='orderAdmin.php'>Manage Orders</a></li>";
        echo "<li class=' btn btn-primary'><a href='userAdmin.php'>Manage Users</a></li>";
        if($_SESSION['loggedIn']) {
            logOutButton();
            
        } else {
            echo "<li class=' btn btn-primary'><a href='login.php'>Login</a></li>";
        }
        echo "</ul>";
        echo "</div>";
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

    // Logout message 
    function logUserOut() {
        session_destroy();
        $_SESSION['loggedIn'] = false;
        
    }

/****** Buttons *******/ 

    // Products Link Button
    function productsPageLink() {
        echo "<a href='products.php' class='btn btn-primary'>&#8592; Back</a>";
    }

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
        echo "<a href='orderAdmin.php' class='btn btn-primary btn-sm'>Back to Orders Page</a>";
    }

    // Button to click to go back to the admin page.
    function adminPageButton() {
        echo "<a href='orderAdmin.php' class='btn btn-primary btn-sm'>Admin Page</a>";
    }

    // Button for emptying all contents from the shopping cart
    function resetCartDisplay() {
        echo "<form method='post'>";
        echo "<input type='hidden' name='action' value='emptyCart'>";
        echo "<button type='submit' class='btn btn-danger '>Empty Cart</button>";
        echo "</form>";
    }

    // Button for logging a user out
    function logOutButton() {
        echo "<a href='login.php?action=logOut' class='btn btn-danger'>Log Out</a>";
    }

    // Button for going to the user admin page
    function userAdminPageButton() {
        echo "<a href='userAdmin.php' class='btn btn-primary btn-sm'>User Admin Page</a>";
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

/*********  User Display Functions ***************/

// Creates a table showing the details from the user table
function createUserTable($users) {
    echo "<table class='table table-striped'>";
   
    // Setup table headers
    echo "<tr>";
    echo "<th scope='col'>ID</th>";
    echo "<th scope='col'>First Name</th>";
    echo "<th scope='col'>Last Name</th>";
    echo "<th scope='col'>Address</th>";
    echo "<th scope='col'>City</th>";
    echo "<th scope='col'>State</th>";
    echo "<th scope='col'>Zip</th>";
    echo "<th scope='col'>Phone</th>";
    echo "<th scope='col'>Email</th>";
    echo "<th scope='col'>Display Name</th>";
    echo "<th scope='col'>Role</th>";
    echo "<th scope='col'>Options</th>";
    echo "</tr>";

    // Now populate it with data
    foreach ($users as $user) {

        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['first_name']}</td>";
        echo "<td>{$user['last_name']}</td>";
        echo "<td>{$user['billing_address']}</td>";
        echo "<td>{$user['billing_city']}</td>";
        echo "<td>{$user['billing_state']}</td>";
        echo "<td>{$user['billing_zip']}</td>";
        echo "<td>{$user['billing_phone']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['display_name']}</td>";
        echo "<td>{$user['user_role']}</td>";

        echo "<td><a href='editUser.php?userId={$user['id']}' class='btn btn-primary btn-sm'>Edit</a>";
        echo "<td><a href='deleteUser.php?userId={$user['id']}' class='btn btn-primary btn-sm'>Delete</a>";
        echo "</tr>";
    }

    echo "</table>";
}

// Delete Users Table
// Creates a table showing the details from the user table
function deleteUserTable($users) {
    echo "<table class='table table-striped'>";
   
    // Setup table headers
    echo "<tr>";
    echo "<th scope='col'>ID</th>";
    echo "<th scope='col'>First Name</th>";
    echo "<th scope='col'>Last Name</th>";
    echo "<th scope='col'>Address</th>";
    echo "<th scope='col'>City</th>";
    echo "<th scope='col'>State</th>";
    echo "<th scope='col'>Zip</th>";
    echo "<th scope='col'>Phone</th>";
    echo "<th scope='col'>Email</th>";
    echo "<th scope='col'>Display Name</th>";
    echo "<th scope='col'>Role</th>";
    echo "</tr>";

    // Now populate it with data
    foreach ($users as $user) {

        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['first_name']}</td>";
        echo "<td>{$user['last_name']}</td>";
        echo "<td>{$user['billing_address']}</td>";
        echo "<td>{$user['billing_city']}</td>";
        echo "<td>{$user['billing_state']}</td>";
        echo "<td>{$user['billing_zip']}</td>";
        echo "<td>{$user['billing_phone']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['display_name']}</td>";
        echo "<td>{$user['user_role']}</td>";
        echo "</tr>";
    }

    echo "</table>";
}


// Display the form needed to edit a user
function editUserForm($id) {

   $userId = $id[0]['id'];
   $firstName = $id[0]['first_name'];
   $lastName = $id[0]['last_name'];
   $email = $id[0]['email'];
   $address = $id[0]['billing_address'];
   $city = $id[0]['billing_city'];
   $state = $id[0]['billing_state'];
   $zipcode = $id[0]['billing_zip'];
   $phone = $id[0]['billing_phone'];
   $displayName = $id[0]['display_name'];
   $user_role = $id[0]['user_role'];

   // Get all the shipping methods available
   $shipMethods = getShipMethods();
    

    // Form creation

    echo "<form action='editUser.php' method='post' class='form-horizontal'>";

    echo "<div class='form-inline'>";
        echo "<label for='firstNameInputBox' class='control-label col-sm-1'>First Name:</label>";
        echo "<div class='col-med-6'>";
            echo "<input type='text' name='firstName' id='firstNameInputBox' class='form-control' placeholder='Enter name' value='{$firstName}'>";
        echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='lastNameInputBox' class='col-sm-1 control-label'>Last Name:</label>";
    echo "<div class='col-med-6'>";
    echo "<input type='text' name='lastName' id='lastNameInputBox' class='form-control' placeholder='Enter name' value='{$lastName}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='emailInputBox' class='col-sm-1 control-label'>Email:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='email' id='emailInputBox' class='form-control' placeholder='Enter email' value='{$email}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='phoneInputBox' class='col-sm-1 control-label'>Phone:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='phone' id='phoneInputBox' class='form-control' placeholder='Enter Phone' value='{$phone}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='addressInputBox' class='col-sm-1 control-label'>Address:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='street' id='addressInputBox' class='form-control' placeholder='Enter address' value='{$address}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='cityInputBox' class='col-sm-1 control-label'>City:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='city' id='cityInputBox' class='form-control' placeholder='Enter City' value='{$city}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='stateInputBox' class='col-sm-1 control-label'>State:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='state' id='stateInputBox' class='form-control' placeholder='Enter State' value='{$state}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='zipInputBox' class='col-sm-1 control-label'>Zipcode:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='zipcode' id='zipInputBox' class='form-control' placeholder='Enter Zipcode' value='{$zipcode}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='displayNameInputBox' class='col-sm-1 control-label'>UserName:</label>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='text' name='displayName' id='displayNameInputBox' class='form-control' placeholder='displayName' value='{$displayName}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='hidden' name='action' class='form-control' value='editUser'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='hidden' name='id' class='form-control' value='{$userId}'>";
    echo "</div>";
    echo "</div>";

    echo "<div class='form-inline'>";
    echo "<label for='user_role' class='col-sm-1 control-label'>Role:</label>";
    echo "<div class='col-med-6'>";
    echo "<select name='user_role' class='form-control'>";
    if($user_role == 'admin') {
        echo "<option value='admin' selected>Admin</option>";
        echo "<option value='customer'>Customer</option>";
    } else {
        echo "<option value='admin'>Admin</option>";
        echo "<option value='customer' selected>Customer</option>";
    }

    echo "</select>";
    echo "</div>";
    echo "</div>";

    echo "<div class='col-med-6'>";
    echo "<br>";
    echo "<input type='submit' class='btn btn-primary' value='Save Changes'>";
    echo "</div>";
    echo "</form>";

    echo "<form action='userAdmin.php' method='post' class='form-horizontal col-lg-4'>";
    echo "<div class='form-group'>";
    echo "<div class='col-med-6'>    ";
    echo "<input type='hidden' name='action' class='form-control' value='cancelChanges'>";
    echo "</div>";
    echo "</div>";
    echo "<input type='submit' class='btn btn-danger' value='Cancel Changes'>";
    echo "</form>";

}

// Form for creating a new user.  Also will be used for the registration page
function createNewUser() {
    // TODO: Create this.  Will want all the parameters send to this function individually, not as an array. Then can use if statements to set the value if the user messed something up
    $userId = $id[0]['id'];
    $firstName = $id[0]['first_name'];
    $lastName = $id[0]['last_name'];
    $email = $id[0]['email'];
    $address = $id[0]['billing_address'];
    $city = $id[0]['billing_city'];
    $state = $id[0]['billing_state'];
    $zipcode = $id[0]['billing_zip'];
    $phone = $id[0]['billing_phone'];
    $displayName = $id[0]['display_name'];
    $user_role = $id[0]['user_role'];
    
    // Get all the shipping methods available
    $shipMethods = getShipMethods();
        
    
        // Form creation
    
        echo "<form action='editUser.php' method='post' class='form-horizontal'>";
    
        echo "<div class='form-inline'>";
            echo "<label for='firstNameInputBox' class='control-label col-sm-1'>First Name:</label>";
            echo "<div class='col-med-6'>";
                echo "<input type='text' name='firstName' id='firstNameInputBox' class='form-control' placeholder='Enter name' value='{$firstName}'>";
            echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='lastNameInputBox' class='col-sm-1 control-label'>Last Name:</label>";
        echo "<div class='col-med-6'>";
        echo "<input type='text' name='lastName' id='lastNameInputBox' class='form-control' placeholder='Enter name' value='{$lastName}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='emailInputBox' class='col-sm-1 control-label'>Email:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='email' id='emailInputBox' class='form-control' placeholder='Enter email' value='{$email}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='phoneInputBox' class='col-sm-1 control-label'>Phone:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='phone' id='phoneInputBox' class='form-control' placeholder='Enter Phone' value='{$phone}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='addressInputBox' class='col-sm-1 control-label'>Address:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='street' id='addressInputBox' class='form-control' placeholder='Enter address' value='{$address}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='cityInputBox' class='col-sm-1 control-label'>City:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='city' id='cityInputBox' class='form-control' placeholder='Enter City' value='{$city}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='stateInputBox' class='col-sm-1 control-label'>State:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='state' id='stateInputBox' class='form-control' placeholder='Enter State' value='{$state}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='zipInputBox' class='col-sm-1 control-label'>Zipcode:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='zipcode' id='zipInputBox' class='form-control' placeholder='Enter Zipcode' value='{$zipcode}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='displayNameInputBox' class='col-sm-1 control-label'>UserName:</label>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='text' name='displayName' id='displayNameInputBox' class='form-control' placeholder='displayName' value='{$displayName}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='hidden' name='action' class='form-control' value='editUser'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='hidden' name='id' class='form-control' value='{$userId}'>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='form-inline'>";
        echo "<label for='user_role' class='col-sm-1 control-label'>Role:</label>";
        echo "<div class='col-med-6'>";
        echo "<select name='user_role' class='form-control'>";
        if($user_role == 'admin') {
            echo "<option value='admin' selected>Admin</option>";
            echo "<option value='customer'>Customer</option>";
        } else {
            echo "<option value='admin'>Admin</option>";
            echo "<option value='customer' selected>Customer</option>";
        }
    
        echo "</select>";
        echo "</div>";
        echo "</div>";
    
        echo "<div class='col-med-6'>";
        echo "<br>";
        echo "<input type='submit' class='btn btn-primary' value='Save Changes'>";
        echo "</div>";
        echo "</form>";
    
        echo "<form action='userAdmin.php' method='post' class='form-horizontal col-lg-4'>";
        echo "<div class='form-group'>";
        echo "<div class='col-med-6'>    ";
        echo "<input type='hidden' name='action' class='form-control' value='cancelChanges'>";
        echo "</div>";
        echo "</div>";
        echo "<input type='submit' class='btn btn-danger' value='Cancel Changes'>";
        echo "</form>";
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