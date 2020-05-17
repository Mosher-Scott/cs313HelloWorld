<?php
    @require_once('../../common/initialize.php');
    @require_once('../../common/header.php');
 

    if(isset($_GET['orderId'])){
        $id = $_GET['orderId'];
        validateInput($id);

        $orderInfo = getSingleOrderDetails($id);
    }
?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>Order Details</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <?php 
               if (isset($orderInfo)) {
                createOrderDisplayTable($orderInfo);
               } else {
                   echo "<h5>No order information available</h5>";
               }
               backToAdminPageButton();
                ?>

            </div>
        </div> 
      </div>

    <div class="bluebar">
    </div>
      
    <div class="container-fluid">
      <div class="row">
        <div class="col">
            <h3>TITLE</h3>
        </div>    
      </div>
      <div class="row">
        <div class="col-md-6">
          <p>Left Text</p>
        </div>
        <div class="col-md-6">
          <p>Middle Text</p>
        </div>
        <div class="col-md-6">
          <div class="img-rounded">
          <p>Right Image</p>
          </div>
        </div>
      </div>
    </div>

    <div class="bluebar">
    </div>

    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>