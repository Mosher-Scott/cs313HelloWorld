<?php

    session_start();

    @require_once('../../common/initialize.php');
    @require_once('../../common/header.php');
    @require_once('../../common/phpMethods.php');
    @require_once('../../common/dbconnection.php');
    @require_once('../../model/products-model.php');


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
        <a href="products.php" class="btn btn-primary">&#8592; Back</a>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>