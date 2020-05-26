<?php

    session_start();

    @require_once('../../common/initialize.php');
    @require_once('../../common/header.php');
    @require_once('../../common/phpMethods.php');
    @require_once('../../common/dbconnection.php');
    @require_once('../../model/products-model.php');

  //Add items to the cart from main product page
  if(isset($_POST) && isset($_POST['action']) == "modifyCart" && isset($_POST['qty'])) {
  // if(isset($_POST) && isset($_POST['action']) == "addToCart" && $_POST['qty'] > 0) {
    
    // For testing
   // print_r($_POST);
    
    modifyCart();
  }
  
  // Empty the shopping cart
  if(isset($_POST) && isset($_POST['action']) == "addToCart") {
    emptyCart();
  }


?>
<main class="rounded-corners">
    <section>
      <div>
        <h1>Shopping Cart</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="shopping-cart-display">
          <?php shoppingCartPageDisplay(); ?>
        </div> 
      </div>
    <div>

    <div class='container'>
      <div class='row'>
      <div class='col-sm-10 float-left'>
        <?php checkoutButton(); ?>
      </div>
      <div class='col-sm-6'>
        <?php resetCartDisplay();  ?>
      </div>
      </div>
    </div>
    <br>
        <?php productsPageLink(); ?>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>