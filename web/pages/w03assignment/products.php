<?php
    SESSION_START();

    @include_once('../common/header.php');
    @include_once('../common/nav.php');
    //@include_once('productDetails.php');

    $products = array("XC Fitness", "Cornering Techniques", "Used Bicycles", "Learning Drops");
    $descriptions = array("Be able to climb those hills and ride long distances", "Feel more confident and get faster when turning your bike", "Sometimes an old bike is just as good as a new bike, for less than half the cost", "Want to learn how to safely glide off those rocks and drops?");
    $amounts = array("19.99", "10.99", "2.99", "8.99");
   
    //Load up session
 if ( !isset($_SESSION["total"]) ) {
  $_SESSION["total"] = 0;
  for ($i=0; $i< count($products); $i++) {
   $_SESSION["qty"][$i] = 0;
  $_SESSION["amounts"][$i] = 0;
 }
}

//---------------------------
//Reset
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

//---------------------------
//Add

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
    <table>
    <tr>
    <th>Products</th>
    <th>Description</th>
    <th>Amount</th>
    <th>Action</th>
      <?php
        for ($i =0; $i < count($products); $i++) {
        ?>
        <tr>
        <td><?php echo($products[$i]); ?></td>
        <td><?php echo($descriptions[$i]); ?></td>
        <td><?php echo($amounts[$i]); ?></td>
        <td><a href="?add=<?php echo($i); ?>"> Add to Cart</a?</td>
      <?php
        }
      ?>
      </table>
      <a href="?reset=true">Empty Cart</a>
    </section>

    <section>
        <div>
          <h4>Cart Information</h4>
          <?php
          if ( isset($_SESSION["cart"]) ) {
 ?>
 <br/><br/><br/>
 <h2>Cart</h2>
 <table>
 <tr>
 <th>Product</th>
 <th width="10px">&nbsp;</th>
 <th>Qty</th>
 <th width="10px">&nbsp;</th>
 <th>Amount</th>
 <th width="10px">&nbsp;</th>
 <th>Action</th>
 </tr>
 <?php
 $total = 0;
 foreach ( $_SESSION["cart"] as $i ) {
 ?>
 <tr>
 <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
 <td width="10px">&nbsp;</td>
 <td><?php echo( $_SESSION["qty"][$i] ); ?></td>
 <td width="10px">&nbsp;</td>
 <td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
 <td width="10px">&nbsp;</td>
 <td><a href="?delete=<?php echo($i); ?>">Delete from cart</a></td>
 </tr>
 <?php
 $total = $total + $_SESSION["amounts"][$i];
 }
 $_SESSION["total"] = $total;
 ?>
 <tr>
 <td colspan="7">Total : <?php echo($total); ?></td>
 </tr>
 </table>
 <?php
 }
 ?>
        </div>
    </section>



<!-- Old stuff
    <section class="products">
      <div class="container centered">
        <div class="row">
          <div class="col-sm-3">
            <div class="col-lg">
              <h4><?php echo $products[0]; ?></h4>
              <img class="product-thumbnail" src="images/01.jpg" alt="Mountain Bike Image">
              <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="0"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
            </div>
          </div>
          <div class="col-sm">
            <h4><?php echo $products[1]; ?></h4>
            <img class="product-thumbnail" src="images/02.jpg" alt="Mountain Bike Image">
            <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="1"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>
          <div class="col-sm">
            <h4><?php echo $products[2]; ?></h4>
            <img class="product-thumbnail" src="images/03.jpg" alt="Mountain Bike Image">
            <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="2"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>
          <div class="col-sm">
            <h4><?php echo $products[3]; ?></h4>
            <img class="product-thumbnail" src="images/04.jpg" alt="Mountain Bike Image">
            <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="3"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>
        </div>
      </div>
      <hr class="bluebar-product-width">
      <div class="container centered">
        <div class="row">
          <div class="col-sm">
            <h4>Cleaning Services</h4>
            <img class="product-thumbnail" src="images/05.jpg" alt="Mountain Bike Image"> 
          </div>
          <div class="col-sm">
            <h4>Technical Downhill Skills</h4>
            <img class="product-thumbnail" src="images/06.jpg" alt="Mountain Bike Image">
          </div>
          <div class="col-sm">
            <h4>North Shore Style Techniques</h4>
            <img class="product-thumbnail" src="images/07.jpg" alt="Mountain Bike Image">
          </div>
          <div class="col-sm">
            <h4>Downhill Cornering</h4>
            <img class="product-thumbnail" src="images/08.jpg" alt="Mountain Bike Image">
          </div>
        </div>
      </div>

    </div>
  </section>
   -->

</main>

<?php 
  @include_once('../common/footer.php');
?>