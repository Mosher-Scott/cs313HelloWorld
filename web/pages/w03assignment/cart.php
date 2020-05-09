<?php

    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('productDetails.php');


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
        <table>
            <!-- Table Headers -->
            <tr>
              <th class="cart-cell">Product</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Remove Item?</th>
            </tr>

            <!-- Product Info -->
            <?php
              $total = 0;
              foreach ( $_SESSION["cart"] as $i ) {
            ?>
              <!-- Loop through each item in the cart and add data to the column -->
              <tr>
                <td class="cart-cell"><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>

                <td class="cart-cell"><?php echo( $_SESSION["qty"][$i] ); ?></td>

                <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>

                <td><a href="?delete=<?php echo($i); ?>">Yes</a></td>
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

          </table>
        </div> 
      </div>
    <div>
        <a href="products.php" class="btn btn-primary">&#8592; Back to Products</a>
        <a href="checkout.php" class="btn btn-primary">Checkout</a>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>