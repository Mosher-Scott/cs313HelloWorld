<?php

  $pageTitle = "Delete User";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $emptyFields = false;
  $recordsUpdated = 0;
  if(!isset($_GET['action'])) {
    $_GET['action'] = '';
  }

  
  // Get the userID and get data for it
  if(isset($_GET['userId'])) {

    // Get the user details
    $id = $_GET['userId'];

    $id = validateInput($id);

    // If it isn't a delete GET request
    if($_GET['action'] != 'delete') {
      // Get user info
      $userInfo = getSingleUserDetails($id);
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete') {
      $id = $_GET['userId'];

      $id = validateInput($id);

      deleteUser($id);
    }


  }

  // debugArray($allUsers);
?>
<nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
</nav>

  <main class="rounded-corners">
    <section>
      <div>
        <h1>Delete User</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container">
      <h3 class='text-danger'>Are you sure you want to delete this user? This is permanent.</h3>
          <?php 

          if(!isset($userInfo)) {
              echo "<h4>Sorry, no users found</h4>";
              
          } else {

          if ($recordsUpdated == 1) {
            echo "<h3 class='text-danger'>Successfully deleted details for user ID {$id}</h3>";

          }
            deleteUserTable($userInfo);
          }
          ?>
          <a href='deleteUser.php?action=delete?id=<?php echo $id;?>' class='btn btn-danger'>Delete User</a>
          <a href='userAdmin.php' class='btn btn-primary btn-sm'>Cancel</a>

      </div>
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>