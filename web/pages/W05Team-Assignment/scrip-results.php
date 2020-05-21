<?php
  @require_once('../../common/initialize.php');
  @require_once('../../common/header.php');
  @require_once('../../common/phpMethods.php');
  @require_once('../../common/teamAssignmentMethods.php');
  @require_once('../../common/dbconnection.php');
  @require_once('../../model/products-model.php');


  // If the page loads as a POST request, look for this variable, and if it is set
  if(isset($_POST['bookToFind'])) {
    // This is just for testing to make sure we have the correct text
    // echo "<h1>" . $_POST['bookToFind'] . "</h1>";
    // Validate & sanitize the input
    $searchText = validateInput($_POST['bookToFind']);
    // Now run the query to find the text in the database, and then save the results as a variable
    $books = searchQuery($searchText);
    // Test this
    //print_r($books);
  }

?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>TITLE</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="main-container">
              <h2 class="text-center">Scripture Resources Results</h2>
              <?php  
                foreach ($books as $row)
                {
                  echo "<a href='scrip-details.php?id={$row['id']}'<strong>" . $row['book'] .' ' . $row['chapter'] .':' . $row['verse'] . '</strong></a>';
                  
                  echo '<br/><br/>';
                }

              ?>
          </div>
        </div> 
      </div>     
    </section>                  
  </main>

<?php 
  @include_once('common/footer.php');
?>