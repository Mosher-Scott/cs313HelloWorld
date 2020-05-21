<?php
  session_start();

  //session_unset();

  @require_once('../../common/initialize.php');
  @require_once('../../common/header.php');
  @require_once('../../common/phpMethods.php');
  
?>

  <main class="rounded-corners">
    <section>
      <div>
        <h1>Products & Services</h1>
        <div class="bluebar">
        </div>
        <div class="search-bar">
            <?php searchForm(); ?>
        </div>
      </div>
    </section>

    <section>
      <div id="sectionContainer" class="container">
        <div class="row">
          <!-- Product listing -->
          <div id="leftSideContent" class="col-12">
            <div class='container centered'>
              <div class='row'>
                <div class='col-sm'>
                  <h4>Joseph Mosher - Story 1</h4>
                  <iframe width="250" height="156" src="https://www.youtube.com/embed/dcq-umHCHO4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <p>This is about something that happened and is a short description of the video</p>
                </div>
                <div class='col-sm'>
                  <h4>Joseph Mosher - Story 2</h4>
                  <iframe width="250" height="156" src="https://www.youtube.com/embed/XC_xFpg_UmA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <p>Describing a new version of a classic old mountain bike</p>
                </div>
                <div class='col-sm'>
                <h4>Willam Keith Cakebread</h4>
                <iframe width="250" height="156" src="https://www.youtube.com/embed/pvkYwOJZONU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <p>This is about something that happened and is a short description of the video</p>
                </div>
                <div class='col-sm'>
                <h4>Gordon Smurthwaite</h4>
                  <iframe width="250" height="156" src="https://www.youtube.com/embed/-kPnFQlqYJ4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  <p>Yet another description of a video</p>
                </div>
              </div>

              <div class='row'>
                <div class='col-sm'>
                  <h4>42t Chainring</h4>
                  <img class='product-thumbnail' src='images/0.jpg' alt='Mountain Bike Image'>
                  <p>$ 10.00</p>
                </div>
                <div class='col-sm'>
                  <h4>42t Chainring</h4>
                  <img class='product-thumbnail' src='images/0.jpg' alt='Mountain Bike Image'>
                  <p>$ 10.00</p>
                </div>
                <div class='col-sm'>
                  <h4>42t Chainring</h4>
                  <img class='product-thumbnail' src='images/0.jpg' alt='Mountain Bike Image'>
                  <p>$ 10.00</p>
                </div>
                <div class='col-sm'>
                  <h4>42t Chainring</h4>
                  <img class='product-thumbnail' src='images/0.jpg' alt='Mountain Bike Image'>
                  <p>$ 10.00</p>
                </div>
              </div>
            </div> 
          </div>
        </div>
      </div>
      <hr>
  </section>
</main>

<?php 
  @include_once('../../common/footer.php');
?>