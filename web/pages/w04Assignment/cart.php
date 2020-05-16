<?php

    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('productDetails.php');


    // Allow adding an item to the cart to change the number
    if ( isset($_GET["add"]) )
        {
        $i = $_GET["add"];
        $qty = $_SESSION["qty"][$i] + 1;
        $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
        $_SESSION["cart"][$i] = $i;
        $_SESSION["qty"][$i] = $qty;
        }

    // Decrease the qty of an item in the cart
    if ( isset($_GET["subtract"]) )
    {
        $i = $_GET["subtract"];
        $qty = $_SESSION["qty"][$i];

        $qty--;  // Decreases qty by 1 each time you click the button
        $_SESSION["qty"][$i] = $qty;  // Now it will set the qty to itself - 1

        if ($_SESSION["qty"][$i] == 0) {
            unset($_SESSION["cart"][$i]);
        }
    }

    //Delete items
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
  $empty = false;
  $numItems = count($_SESSION['cart']);
  if($numItems == 0) {
    $empty = true;
  }
?>
<main class="rounded-corners">
    <section>
      <div>
        <h1>Your Cart</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">

        
        <?php
            // Check if cart is empty or not
              if ($empty) {
                echo "<h5>CART IS EMPTY</h5>";
              } else {

              ?>

        <table class="cart-table">
            <!-- Table Headers -->
            <tr>
              <th class="cart-cell">Product</th>
              <th>Description </th>
              <th>Qty</th>
              <th>Price</th>
              <th>Cart Actions</th>
            </tr>

            <!-- Product Info -->
            <?php
              $total = 0;
              foreach ( $_SESSION["cart"] as $i ) {
            ?>
              <!-- Loop through each item in the cart and add data to the column -->
              <tr>
                <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
                <td><?php echo( $descriptions[$_SESSION["cart"][$i]] ); ?></td>

                <td><?php echo( $_SESSION["qty"][$i] ); ?></td>

                <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
                <td><a href="?add=<?php  echo($i); ?>" class='btn-sm btn-primary'>Add One</a> <a href="?subtract=<?php  echo($i);?>" class='btn-sm btn-primary'>Remove One</a> <a href="?delete=<?php echo($i); ?>" class="btn-sm btn-danger">Remove All</a></td>
                <!-- <td class="cart-cell"><a href="?subtract=<?php  echo($i);?>" class='btn-sm btn-primary'>Remove One</a></td>
                <td class="cart-cell"><a href="?delete=<?php echo($i); ?>" class="btn-sm btn-danger">Remove All</a></td> -->
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
              <td><b>Total: </b>$<?php echo($total); ?></td>
            </tr>

          </table>
          <?php };?>
        </div> 
      </div>
    <div>
        <a href="products.php" class="btn btn-primary">&#8592; Back to Products</a>
        <?php 
          if ($empty == true) {
            echo "<p class='btn btn-disabled'>Checkout</p>";
          } else {
            echo "<a href='checkout.php' class='btn btn-primary'>Checkout</a>";
          }
        ?>

    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>