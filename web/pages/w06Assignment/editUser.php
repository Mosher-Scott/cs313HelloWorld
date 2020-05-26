<?php
  $pageTitle = "Edit User";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $emptyFields = false;
  $recordsUpdated = 0;
  
  // Get the userID and get data for it
  if(isset($_GET['userId'])) {

    // Get the user details
    $id = $_GET['userId'];

    $id = validateInput($id);

    // Get user info
    $userInfo = getSingleUserDetails($id);

    //debugArray($userInfo);
  }

  // If it is a post request, and the post variable action is set to editUser
  if(isset($_POST) && isset($_POST['action']) == 'editUser') {
    // debugArray($_POST);

    // Save post data to variables
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $address = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $displayName = filter_input(INPUT_POST, 'displayName', FILTER_SANITIZE_STRING);

    // It any of these fields are empty, display a message on the page
    if(empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zipcode) || empty($phone) || empty($displayName)) {

      // Also same them to the $userInfo array to redisplay them on the page
      $userInfo[0]['id'] = $id;
      $userInfo[0]['first_name'] = $firstName;
      $userInfo[0]['last_name'] = $lastName; 
      $userInfo[0]['email'] = $email;
      $userInfo[0]['billing_address'] = $address;
      $userInfo[0]['billing_city'] = $city;
      $userInfo[0]['billing_state'] = $state;
      $userInfo[0]['billing_zip'] = $zipcode;
      $userInfo[0]['billing_phone'] = $phone;
      $userInfo[0]['display_name'] = $displayName;

      $emptyFields = true;
    } else {
      $emptyFields = false;

      // Update the database with these details
      $recordsUpdated = updateUserDetails($id, $firstName, $lastName, $email, $phone, $address, $city, $state, $zipcode, $displayName);
      echo $recordsUpdated;

      if($recordsUpdated == 1) {
          
        // Now get the updated user information & display it
        $userInfo = getSingleUserDetails($id);
      }
    }
  }
  
  // debugArray($allUsers);
?>
  <main class="rounded-corners">
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

          if(!isset($userInfo)) {
              echo "<h4>Sorry, no users found</h4>";
              echo "<a href='userAdmin.php' class='btn btn-primary'>Back to Users</a>";
          } else {
            if($emptyFields) {
              echo "<h3 class='text-danger'>Please fix Empty fields</h3>";
            }

            if ($recordsUpdated == 1) {
              echo "<h3 class='text-danger'>Successfully updated details for user ID {$id}</h3>";

            }
            editUserForm($userInfo);
          }
          ?>
          

      </div>
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>