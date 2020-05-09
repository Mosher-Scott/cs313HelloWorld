<?php

    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');

?>
<main class="rounded-corners">
  <section>
    <div>
      <h1>Success!</h1>
      <div class="bluebar">
      </div>
    </div>
  </section>

  <section id="confirmation">
    <h2>Order Success</h2>
    <div>
      <?php
        print_r($_POST);
      ?>
    </div>

  </section>

  <section>
    <div>
      <a href="products.php" class="btn btn-primary">Complete Purchase</a>
      <a href="checkout.php" class="btn btn-primary">&#8592; Back to Cart</a>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>          