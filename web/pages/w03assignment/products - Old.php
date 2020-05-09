<?php
    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('productDetails.php');
   

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // echo "Post request";
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

    <section class="products">
      <div class="container centered">
        <div class="row">
          <div class="col-sm">
              <h4><?php echo $products[0]; ?></h4>
              <img class="product-thumbnail" src="images/01.jpg" alt="Mountain Bike Image">
              <form action="addToCart.php" method="post">
                <input type="hidden" name="productId" value="0"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>

          <div class="col-sm">
            <h4><?php echo $products[1]; ?></h4>
            <img class="product-thumbnail" src="images/02.jpg" alt="Mountain Bike Image">
            <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="1"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>
          <div class="col-sm">
            <h4><?php echo $products[2]; ?></h4>
            <img class="product-thumbnail" src="images/03.jpg" alt="Mountain Bike Image">
            <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="2"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>
          <div class="col-sm">
            <h4><?php echo $products[3]; ?></h4>
            <img class="product-thumbnail" src="images/04.jpg" alt="Mountain Bike Image">
            <form action="addToCart.php" method="post">
              <input type="hidden" name="productId" value="3"> 
                <input type="submit" class="btn btn-primary" value="Add to Cart">
              </form>
          </div>
        </div>
      </div>
      <hr class="bluebar-product-width">
      <div class="container centered">
        <div class="row">
          <div class="col-sm">
            <h4>Cleaning Services</h4>
            <img class="product-thumbnail" src="images/05.jpg" alt="Mountain Bike Image"> 
          </div>
          <div class="col-sm">
            <h4>Technical Downhill Skills</h4>
            <img class="product-thumbnail" src="images/06.jpg" alt="Mountain Bike Image">
          </div>
          <div class="col-sm">
            <h4>North Shore Style Techniques</h4>
            <img class="product-thumbnail" src="images/07.jpg" alt="Mountain Bike Image">
          </div>
          <div class="col-sm">
            <h4>Downhill Cornering</h4>
            <img class="product-thumbnail" src="images/08.jpg" alt="Mountain Bike Image">
          </div>
        </div>
      </div>

    </div>

    
  </section>

</main>

<?php 
  @include_once('../common/footer.php');
?>