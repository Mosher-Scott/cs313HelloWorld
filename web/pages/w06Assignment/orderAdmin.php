<?php

    @require_once('../../common/initialize.php');
    @require_once('../../common/header.php');
    @require_once('../../common/phpMethods.php');
    @require_once('../../common/dbconnection.php');
    @require_once('../../model/products-model.php');
    @require_once('../../model/orders-model.php');

    
    // If the user isn't logged in, then send them back to the login page.
    if(!isset($_SESSION['loggedIn'])) {
      header('Location: login.php');
    }

    // If they are logged in go to the next step
    if($_SESSION['loggedIn'] && isset($_SESSION['userInfo'][0]['user_role'])) {

      // If their role is an admin, display the page
      if($_SESSION['userInfo'][0]['user_role'] == 'admin') {
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
      }
    }
    

?>
<nav class='rounded-corners'>
<?php require_once('../../common/nav.php'); ?>
</nav>

<main class="rounded-corners">
    <section>
      <div>
        <h1>Order Admin</h1>
        <div class="bluebar">
        </div>

        <?php
          if(!$_SESSION['loggedIn']) {
            echo "<h5>You do not have the rights to this page</h5>";
          } else {
        ?>
        <div id="searches">
          <h5>Search</h5>
          <?php searchByFirstName();?>
          <a href='orderAdmin.php' class='btn btn-primary'>All Orders</a>
          <?php productsPageLink(); ?>
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

            <?php }; ?>


    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>