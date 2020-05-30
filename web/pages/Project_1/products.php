<?php
  session_start();

  $pageTitle = 'Products & Services';

  //session_unset();

  @require_once('../../common/initialize.php');
  @require_once('../../common/header.php');
  @require_once('../../common/phpMethods.php');
  @require_once('../../common/dbconnection.php');
  @require_once('../../model/products-model.php');

// Get a list of all products
$product = getAllProducts();

//Add items to the cart from main product page
if(isset($_POST) && isset($_POST['action']) == "modifyCart" && isset($_POST['qty'])) {
  
  modifyCart();
}

// Empty the shopping cart
if(isset($_POST) && isset($_POST['action']) == "addToCart") {
  emptyCart();
}

// If the page request is a post and the user is searching for a value
if(isset($_POST) && isset($_POST['action']) == "productSearch") {

  $nameToFind = $_POST['searchByName'];

  validateInput($nameToFind);

  // Product variable will only contain 
  $product = searchByPartialProductName($nameToFind);

}

?>


<nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
</nav>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>Products & Services</h1>
        <div class="bluebar">
        </div>
        <div class="container">
            <?php searchForm(); ?>
        </div>
      </div>
    </section>

    <section>
      <div id="sectionContainer" class="container">
        <div class="row">
          <!-- Product listing -->
          <div id="leftSideContent" class="col-lg-10 blue-border-left-side">
            
            <?php
            // Checking search results or anything else
              if(count($product) == 0) {
                echo "<h5>Sorry, no results found</h5>";
                echo "<a href='products.php' class= 'btn btn-primary'>View All Products</a>";
              } else {
                buildProductDisplay($product);
              } 
            ?>
          </div> 
        </div>
      </div>

          <div id="rightSideContent" class="col-med-1">
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