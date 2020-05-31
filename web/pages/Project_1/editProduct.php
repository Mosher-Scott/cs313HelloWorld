<?php

  $pageTitle = "Edit User";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $isAdmin = checkIfAdminUser();

  $emptyFields = false;
  $recordsUpdated = 0;

  if($isAdmin) {
    // Get the userID and get data for it
    if(isset($_GET['userId'])) {

      // Get the user details
      $id = $_GET['productId'];

      $id = validateInput($id);

      // Get product info
      $productInfo = getSingleProduct($id);
    }
  

  // If it is a post request, and the post variable action is set to editUser
  if(isset($_POST) && isset($_POST['action']) == 'editProduct') {
    //debugArray($_POST);

    // Save post data to variables
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_EMAIL);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_STRING);
    $imageName = filter_input(INPUT_POST, 'imageName', FILTER_SANITIZE_STRING);

    
    // It any of these fields are empty, display a message on the page
    if(empty($name) || empty($description) || empty($price) || empty($quantity) || empty($imageName)) {

      // Also same them to the $productInfo array to redisplay them on the page
      $productInfo[0]['id'] = $id;
      $productInfo[0]['name'] = $name;
      $productInfo[0]['created_date'] = $date; 
      $productInfo[0]['description'] = $description;
      $productInfo[0]['price'] = $price;
      $productInfo[0]['quantity'] = $quantity;
      $productInfo[0]['image_name'] = $imageName;

      $emptyFields = true;
    } else {

      // If everything is good, complete the process
      // Update the database with these details
      $recordsUpdated = updateProduct($id, $name, $description, $price, $quantity, $imageName);
      // echo $recordsUpdated;

      if($recordsUpdated == 1) {
          
        // Now get the updated user information & display it
        $userInfo = getSingleUserDetails($id);
      }
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
        <h1>Edit User Information</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container">

          <?php 
    // TODO:  Complete this section
          if(!isset($userInfo)) {
              echo "<h4>Sorry, no users found</h4>";
              
          } else {
            if($emptyFields) {
              echo "<h3 class='text-danger'>Please fix Empty fields</h3>";
            }

            if ($recordsUpdated == 1) {
              echo "<h3 class='text-danger'>Successfully updated details for user ID {$id}</h3>";
              sleep(5);

              // header('Location: userAdmin.php');
              // die();
            }
            editUserForm($userInfo);
          }
          backButton();
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