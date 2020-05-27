<?php

  $pageTitle = "User Administration";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');


  // Get all the users
  $allUsers = getAllUsers();
  // debugArray($allUsers);
?>
  <nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
  </nav>

  <main class="rounded-corners">
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
          <?php createUserTable($allUsers); ?>
        </div> 
      </div>

    <div class="bluebar">
    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>