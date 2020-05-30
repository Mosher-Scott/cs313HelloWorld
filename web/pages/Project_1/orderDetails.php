<?php
  $pageTitle = "Order Details";
    @require_once('../../common/initialize.php');
    @require_once('../../common/header.php');
 
    // If the user is not an admin, don't let them see the page
    if(!$_SESSION['userInfo'][0]['user_role'] == 'admin') {
      header('Location: login.php');
    }

    if(isset($_GET['orderId'])){
        $id = $_GET['orderId'];
        validateInput($id);

        $orderInfo = getSingleOrderDetails($id);
        $paymentInfo = getPaymentDetails($id);
        $orderItems = getAllProductsInOrder($id);

    }
?>

<nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
  </nav>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>Order Details</h1>
        <div class="bluebar"></div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <?php 
                   // Back to previous page
                   backButton();

                  if (isset($orderInfo)) {
                    // TODO: Modify this so instead of details, there is now a link editing the details
                    createOrderDisplayTableForSingleOrder($orderInfo);

                  } else {
                      echo "<h5>No order information available</h5>";
                  }
           
                ?>

            </div>
        </div> 
      </div>

    <div class="bluebar"> </div>
      <div class="col">
          <h3>Payment Information</h3>
      </div>    
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <?php displayPaymentInformation($paymentInfo); ?>
          </div>
        </div>
      </div>

    <div class="bluebar"> </div> 

    <div class="container-fluid">
      <div class="row">
        <div class="col">
            <h3>Products</h3>
        </div>    
      </div>
      <div class="row">
        <div class="col-md-6">
          <?php
          // TODO: Modify this to add a link to edit order quantities 
          createOrderDetailDisplay($orderItems); ?>
          </div>
      </div>
    </div>

    <div class="bluebar">
    </div>
    <div>
    <?php backButton(); ?>
    </div>
    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>