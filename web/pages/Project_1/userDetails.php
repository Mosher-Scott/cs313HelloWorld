<?php

  $pageTitle = "User Details";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $isAdmin = checkIfAdminUser();

  if($isAdmin){

  // If it is a get request, get the user info from the database
  if (isset($_GET['userId'])) {
    $userId = validateInput($_GET['userId']);

    // Get user information
    $accountInfo = getSingleUserDetails($userId);

    // Get order information
    $userOrders = findOrdersByUserId($userId);
  }

}

?>
  <nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
  </nav>

  <main class="rounded-corners">

  <?php if($isAdmin) { ?>
    <section>
      <div>
        <h1>User Information</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
          <?php 
          if(empty($accountInfo)) {
            echo "<h3>Sorry, no user details found</h3>";
          }else {
            createUserDetailsTable($accountInfo); 
          }
          ?>
        </div> 
      </div>
    </section>
    <div class="bluebar">
    </div>

    <section>
      <div>
        <h1>User Orders</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>
    <section>
    <div class="container-fluid">
      <div class="row">
        <?php  
            if(empty($userOrders)) {
              echo "<h3>Sorry, no orders found</h3>";
            }else {
              createOrderDisplayTable($userOrders);
            }
          // Display orders
          

        ?>
      </div> 
    </div>

    </section>
  <?php } else {
    notAdminMessage();
  }; ?> 
  </main>

<?php 
  @include_once('common/footer.php');
?>