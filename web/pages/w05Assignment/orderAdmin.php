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

    // Post requests for search forms
    if(isset($_POST['action'])) {
      if($_POST['action'] == 'searchByFirstName') {

        $name = validateInput($_POST['nameToFind']);

        $orders = findOrdersByFirstName($name);
      }
    }

?>


<main class="rounded-corners">
    <section>
      <div>
        <h1>Order Admin</h1>
        <div class="bluebar">
        </div>
        <div id="searches">
          <h5>Search</h5>
          <?php searchByFirstName();?>
          <a href='orderAdmin.php' class='btn btn-primary'>All Orders</a>
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <?php  
            
            if(empty($orders)) {
              echo "<h5>Sorry, no orders for that name could be found.  Please try your search again.</h5>";
            } else {
              createOrderDisplayTable($orders);
             } ?>
        </div> 
      </div>


    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>