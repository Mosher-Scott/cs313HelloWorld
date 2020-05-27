<?php

  $pageTitle = "Registration";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $emptyFields = false;
  $recordsUpdated = 0;
  $successfulRegistration = false;
  
  $firstName = '';
  $lastName = '';
  $email = '';
  $address = '';
  $city = '';
  $state = '';
  $zipcode = '';
  $phone = '';
  $displayName = '';
  $password = '';

  
  // Get the userID and get data for it
  if(isset($_GET['userId'])) {

    // Get the user details
    $id = $_GET['userId'];

    $id = validateInput($id);

    // Get user info
    $userInfo = getSingleUserDetails($id);
  }

  // If it is a post request, and the post variable action is set to addUser
  if(isset($_POST) && isset($_POST['action']) == 'addUser') {

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
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // TODO: Check if email already exists

    // TODO: Check if username already exists
    
    // It any of these fields are empty, display a message on the page
    if(empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zipcode) || empty($phone) || empty($displayName) || empty($password)) {

      $emptyFields = true;
    } else {

      // Update the database with these details
      $recordsUpdated = registerNewUser($firstName, $lastName, $email, $phone, $address, $city, $state, $zipcode, $displayName, $password);
    

      if($recordsUpdated == 1) {
          
        // If successfull, log the user in
        loginUser($email);

        // Set this flag as true
        $successfulRegistration = true;
       
      }
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
        <h1>Create Account</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container">

          <?php 

            // If it was successfull adding the user, display a message
            if ($recordsUpdated == 1) {
              echo "<h3 class='text-danger'>Successfully updated details for user {$displayName}</h3>";
            }

            // If the user is already logged in, display a message saying they are already logged in & can't register
            if(isset($_SESSION['loggedIn'])) {
                if ($_SESSION['loggedIn']) {
                  echo "<h4>You are logged in as {$_SESSION['userInfo'][0]['display_name']}</h4>";
                }
            } 
            // If there are empty fields in the form, have the user fix & submit
            else {
              if($emptyFields) {
                echo "<h3 class='text-danger'>Please fix Empty fields</h3>";
              }
              // Display the form
              userRegistration($firstName, $lastName, $email, $address, $city, $state, $zipcode, $phone, $displayName, $password);  
            }
         
          ?>
          

      </div>
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>