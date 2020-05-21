<?php
  @require_once('../../common/initialize.php');
  @require_once('../../common/header.php');
  @require_once('../../common/phpMethods.php');
  @require_once('../../common/teamAssignmentMethods.php');
  @require_once('../../common/dbconnection.php');
  @require_once('../../model/products-model.php');

  $books = getAllBooks();

?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>W05 Team Assignment</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
               <p>Please enter in the name of the book of scripture you want to find</p>
               <?php search(); ?>
            </div>
            <div>
            <h5>Part I</h5>
              <?php
                foreach ($books as $row)
                {
                  echo '<strong>' . $row['book'] .' ' . $row['chapter'] .':' . $row['verse'] . '</strong>';
                  echo ' - "' . $row['content'] .'"';
                  echo '<br/><br/>';
                }
              ?>
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