<?php
    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('../../common/phpMethods.php');
    @include_once('productDetails.php');
    

    if(!isset($_SESSION['checkoutComplete'])) {
      $_SESSION['checkoutComplete'] = 'false';
    }


    // Check to see if the user has completed the checkout process.  If so, remove the items from the cart.  Then set the variable to false
    if($_SESSION['checkoutComplete'] == 'true') {
      resetSession();
      resetCart();
      
      $_SESSION['checkoutComplete'] = 'false';

      $_SESSION['cart'] = array();
    }

    // Cart idea from https://www.withinweb.com/info/a-shopping-cart-using-php-sessions-code/
   
    //Load up session
 if ( !isset($_SESSION["total"]) ) {
  $_SESSION["total"] = 0;
  for ($i=0; $i< count($products); $i++) {
   $_SESSION["qty"][$i] = 0;
  $_SESSION["amounts"][$i] = 0;
 }
}

// Empty the shopping cart
if ( isset($_GET['reset']) )
{
  if ($_GET["reset"] == 'true')
    {
      $_SESSION = array();
  // unset($_SESSION["qty"]); //The quantity for each product
  // unset($_SESSION["amounts"]); //The amount from each product
  // unset($_SESSION["total"]); //The total cost
  // unset($_SESSION["cart"]); //Which item has been chosen
    }
}


//Add items to the cart

// print_r($_GET);
if ( isset($_GET["add"]) )
  {
  $i = $_GET["add"];
  $qty = $_SESSION["qty"][$i] + 1;
  $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
  $_SESSION["cart"][$i] = $i;
  $_SESSION["qty"][$i] = $qty;
}

 //---------------------------
 //Delete
 if ( isset($_GET["delete"]) )
    {
    $i = $_GET["delete"];
    $qty = $_SESSION["qty"][$i];

    // $qty--;  Decreases qty by 1 each time you click the button
    // $_SESSION["qty"][$i] = $qty;  // Now it will set the qty to itself - 1

    // We want to just straight delete it, so we'll just set the qty to 0
    $_SESSION["qty"][$i] = 0; 
    $qty = 0;

    //remove item if quantity is zero
    if ($qty == 0) {
    $_SESSION["amounts"][$i] = 0;
    unset($_SESSION["cart"][$i]);
    }
    else
    {
      $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
    }
  }
?>

  <main class="rounded-corners">
    <section>
      <div>
        <h1>Products & Services</h1>
        <div class="bluebar">
        </div>
      
      </div>
    </section>

    <section>
      <div id="sectionContainer" class="container">
        <div class="row">
          <!-- Product listing -->
          <div id="leftSideContent" class="col-9 blue-border-left-side">
            <?php
              $productNumber = 0;
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

                  echo "<h4>$item</h4>"; // Title
                  echo "<img class='product-thumbnail' src='images/{$productNumber}.jpg' alt='Mountain Bike Image'>"; // Image
                  echo "<p>$ {$amounts[$productNumber]}</p>"; // Price
                  echo "<p><a href='?add={$productNumber}' class='btn btn-primary'>Add to Cart</a></p>"; // Add to cart button
                  
                  echo "</div>"; // Product div end
                  $productNumber++;
                  $itemsPerRow++;
              }
            ?>  
          </div>
        </div>
      </div>

      <div id="rightSideContent" class="col-2">
        <div>
          <h3>Your Cart</h3>

          <?php
            // Check if cart is empty or not
              if (count($_SESSION['cart']) == 0) {
                echo "<h5>CART IS EMPTY</h5>";
              } else {

              ?>

          <!-- Shopping Cart table -->
          <table>
            <!-- Table Headers -->
            <tr>
              <th>Product</th>
              <th>Qty  </th>
              <th>Price</th>
            </tr>

            <!-- Product Info -->
            <?php
              $total = 0;
              foreach ( $_SESSION["cart"] as $i ) {
            ?>
              <!-- Loop through each item in the cart and add data to the column -->
              <tr>
                <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>

                <td><?php echo( $_SESSION["qty"][$i] ); ?></td>

                <td>$<?php echo( $_SESSION["amounts"][$i] ); ?></td>

                <td><a href="?delete=<?php echo($i); ?>" class="btn-sm btn-primary">Remove</a></td>
              </tr>

            <!-- Now update the total with the total for each item -->
            <?php
              $total = $total + $_SESSION["amounts"][$i];
              }
              // Update the session variable with the total
              $_SESSION["total"] = $total;
            ?>
            <tr  class="blue-border-top">
              <!-- Cart Total -->
              <td colspan="2"><b>Total :</b></td>
              
              <td >$<?php echo($total); ?></td>
            </tr>
            <tr>
              <!-- Product Info -->
              <td colspan="4"><a href="cart.php" class="btn btn-primary">Checkout</td>
            </tr>
          </table>
            <?php };?>
          
      </div>
    </div>

  </section>
</main>

<?php 
  @include_once('../../common/footer.php');
?>