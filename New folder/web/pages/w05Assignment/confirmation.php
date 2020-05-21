<?php

    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('productDetails.php');
    
    $_SESSION['checkoutComplete'] = 'true';

    $address1 = $_SESSION['orderDetails']['street'];
    $address2 = "{$_SESSION['orderDetails']['city']}, {$_SESSION['orderDetails']['state']} {$_SESSION['orderDetails']['zipcode']}";

?>

<main class="rounded-corners">
  <section>
    <div>
      <h1>Thank You For Your Order</h1>
      <p class='text-center'>Your order details are below</p>
      <hr>
    </div>
  </section>

  <section id="confirmation">
    <h3 class="text-left">Order Details</h3>
    
    <div>
      <h4 class="text-left"><b>Order # </b><?php echo $_SESSION['orderDetails']['orderNo'] ?></h4>
      <h4 class="text-left"><b>Order Date:</b> <?php echo $_SESSION['orderDetails']['orderDate'] ?></h4>
      <hr>
    </div>

    <div>
      <h3 class="text-left">Customer Information</h3>
      <h4 class="text-left"><b>Name: </b><?php echo $_SESSION['orderDetails']['name'];?></h4>
      <h4 class="text-left"><b>Email: </b><?php echo $_SESSION['orderDetails']['email'];?></h4>
      <h4 class="text-left"><b>Phone:</b><?php echo $_SESSION['orderDetails']['phone'];?></h4>
      <h4 class="text-left"><b>Address 1:</b><?php echo $address1;?></h4>
      <h4 class="text-left"><b>Address 2:</b><?php echo $address2;?></h4>
      <h4 class="text-left"><b>Order Comments: </b><?php echo $_SESSION['orderDetails']['comments'];?></h4>
      <hr>
    </div>

    <div>
      <table class="cart-table">
        <!-- Table Headers -->
        <tr>
          <th class="cart-cell">Product</th>
          <th>Description </th>
          <th>Qty</th>
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
            <td><?php echo( $descriptions[$_SESSION["cart"][$i]] ); ?></td>

            <td><?php echo( $_SESSION["qty"][$i] ); ?></td>

            <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
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
    </div>
  </section>

  <section>
    <div>
      <a href="products.php" class="btn btn-primary">Back to Products</a>
      <!-- <a href="checkout.php" class="btn btn-primary">&#8592; Back to Cart</a> -->
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>          