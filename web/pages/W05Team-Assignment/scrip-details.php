<?php
  @require_once('../../common/initialize.php');
  @require_once('../../common/header.php');
  @require_once('../../common/phpMethods.php');
  @require_once('../../common/teamAssignmentMethods.php');
  @require_once('../../common/dbconnection.php');
  @require_once('../../model/products-model.php');

  // If the page loads as a GET request, run the query & get the results
  if(isset($_GET['id'])) {
    // This is just for testing to make sure we have the correct text
    //echo "<h1>" . $_POST['bookToFind'] . "</h1>";
    // Validate & sanitize the input
    $searchText = validateInput($_GET['id']);
    // Now run the query to find the text in the database, and then save the results as a variable
    $books = displayQuery($searchText);
  // Test to make sure we are getting the right results
  //print_r($books);
  }

?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>Scripture Detail Page</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="main-container">
              <h2 class="text-center">Your Verse</h2>
              <?php
                if(isset($_GET['id'])) {  
                  foreach ($books as $row)
                  {
                    echo '<strong>' . $row['book'] .' ' . $row['chapter'] .':' . $row['verse'] . '</strong>';
                    echo ' - "' . $row['content'] .'"';
                    echo '<br/><br/>';
                  }
              }

              echo "<a class='btn btn-primary' href='mainpage.php'>Back to Main</a>";
              ?>
          </div>
        </div> 
      </div>     
    </section>                  
  </main>

<?php 
  @include_once('common/footer.php');
?>
