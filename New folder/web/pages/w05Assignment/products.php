<?php
  session_start();

  //session_unset();

  @require_once('../../common/initialize.php');
  @require_once('../../common/header.php');
  @require_once('../../common/phpMethods.php');
  @require_once('../../common/dbconnection.php');
  @require_once('../../model/products-model.php');

  if(!isset($_SESSION['checkoutComplete'])) {
    $_SESSION['checkoutComplete'] = 'false';
    //$_SESSION['cart'] = array();
  }

  // Check to see if the user has completed the checkout process.  If so, remove the items from the cart.  Then set the variable to false
  if($_SESSION['checkoutComplete'] == 'true') {
    resetSession();
    
    $_SESSION['checkoutComplete'] = 'false';
  }

// Get a list of all products
$product = getAllProducts();

//Add items to the cart from main product page
if(isset($_POST) && isset($_POST['action']) == "addToCart" && isset($_POST['qty'])) {
// if(isset($_POST) && isset($_POST['action']) == "addToCart" && $_POST['qty'] > 0) {
  
  // For testing
 // print_r($_POST);
  
  additemToCart();
}

// Empty the shopping cart
if(isset($_POST) && isset($_POST['action']) == "addToCart") {
  emptyCart();
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
          <div id="leftSideContent" class="col-10 blue-border-left-side">
            
            <?php

              buildProductDisplay($product);
            ?>
            </div> 
            </div>
          </div>

          <div id="rightSideContent" class="col-2">
              <?php sideBarShoppingCart(); ?>
          </div>
        </div>
      </div>
      <hr>
  </section>
</main>

<?php 
  @include_once('../../common/footer.php');
?>