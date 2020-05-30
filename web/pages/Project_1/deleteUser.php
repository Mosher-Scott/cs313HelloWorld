<?php

  $pageTitle = "Delete User";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  // If the user is not an admin, don't let them see the page
  $isAdmin = checkIfAdminUser();

  if($isAdmin){

 
  $message = '';

  $emptyFields = false;
  $recordsUpdated = 0;

  if(!isset($_GET['action'])) {
    $_GET['action'] = '';
  }

  if(isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    $id = validateInput($id);

    $rowsChanged = deleteUser($id);

    if ($rowsChanged == 1) {
      $message = "Successfully deleted user from the system.";
    }
  }

  // Get the userID and get data for it
  if(isset($_GET['userId'])) {

    // Get the user details
    $id = $_GET['userId'];

    $id = validateInput($id);

    $userInfo = getSingleUserDetails($id);

    if(empty($userInfo)) {
      $message = 'Sorry, no users found';
    } else {
      $message = "Are you sure you want to delete this user? This is permanent.";
    }
  }

}

  // debugArray($allUsers);
?>
<nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
</nav>


  <main class="rounded-corners">
  <?php if($isAdmin) { ?>
    <section>
      <div>
        <h1>Delete User</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container">
      <h3 class='text-danger'><?php echo $message; ?></h3>
          <?php 

          if(!isset($userInfo) || empty($userInfo) && $_GET['action'] != 'delete') {
              echo "<h3>Sorry, user not found</h3>";
              
          } else {

            deleteUserTable($userInfo);
            echo "<a href='deleteUser.php?action=delete&id={$id}' class='btn btn-danger'>Delete User</a>";
            echo "<a href='userAdmin.php' class='btn btn-primary btn-sm'>Cancel</a>";
          }
          userAdminPageButton();
          ?>
      </div>
  </section>

  <?php } else {
  notAdminMessage();
}; ?>
</main>

<?php 
  @include_once('common/footer.php');
?>