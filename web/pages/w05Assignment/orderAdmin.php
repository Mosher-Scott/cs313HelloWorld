<?php
    @require_once('../../common/initialize.php');
    @require_once('../../common/header.php');
    @require_once('../../common/phpMethods.php');
    @require_once('../../common/dbconnection.php');
    @require_once('../../model/products-model.php');
    @require_once('../../model/orders-model.php');

    // Get all the orders
    $orders = getAllOrders();

    //  debugArray($orders);
?>


<main class="rounded-corners">
    <section>
      <div>
        <h1>Order Admin</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <?php  createOrderDisplayTable($orders); ?>
        </div> 
      </div>


    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>