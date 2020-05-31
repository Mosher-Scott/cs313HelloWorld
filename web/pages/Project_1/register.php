<?php

  $pageTitle = "Registration";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $emptyFields = false;
  $recordsUpdated = 0;
  $successfulRegistration = false;
  $doesEmailExist = false;
  $emailExists = false;
  
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

  $message = '';

  // User is already logged in when they first access the page
  if(isset($_SESSION['loggedIn'])) {
    if ($_SESSION['loggedIn']) {
      $message = "<h3>You are already logged in as {$_SESSION['userInfo'][0]['display_name']}</h3>";
    }
  }

  
  // Get the userID and get data for it
  if(isset($_GET['userId'])) {

    // Get the user details
    $id = $_GET['userId'];

    $id = validateInput($id);

    // Get user info
    $userInfo = getSingleUserDetails($id);
  }

  // TODO: Change this to just being username & password  Address & Info will be filled out during checkout

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
    $doesEmailExist = getEmailCount($email);

    // TODO: Check if username already exists
    
    // It any of these fields are empty, display a message on the page
    if(empty($firstName) || empty($lastName) || empty($email) || empty($address) || empty($city) || empty($state) || empty($zipcode) || empty($phone) || empty($displayName) || empty($password)) {

      $emptyFields = true;
    } 
    // Check to see if email already exists. If so, display an error message
    else if ($doesEmailExist[0]['count'] >= 1){
      $emailExists = true;
        $message = "<h3 class='text-danger'>There is already an account with that email address</h3>";
    }
    
    else {
       // Encrypt the password
       $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Removing this for now
      // Update the database with these details
      $recordsUpdated = registerNewUser($firstName, $lastName, $email, $phone, $address, $city, $state, $zipcode, $displayName, $hashedPassword);
    

      if($recordsUpdated == 1) {
          
        // If successfull, log the user in
        loginUser($email);

        // Set this flag as true
        $successfulRegistration = true;
       
      }
    }
  } // End of processing post request data
  
  //  Now what to display on the page

  // If Registration was successful
  if ($recordsUpdated == 1 && $successfulRegistration) {
    $message = "<h3 class='text-danger'>Thank you for registering, {$displayName}</h3>";
  }

  // If there are empty fields during form submission
  if($emptyFields) {
    $message = "<h3 class='text-danger'>Please fix empty fields</h3>";
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
            if ($recordsUpdated == 1 && $successfulRegistration) {
              echo $message;
            }

            // If the user is already logged in, display a message saying they are already logged in & can't register
            if(isset($_SESSION['loggedIn'])) {
                if ($_SESSION['loggedIn']  && (!$successfulRegistration)) {
                  echo $message;
                }
            } 

            // If there are empty fields in the form, have the user fix & submit
            if($emptyFields) {
              echo $message;
              }

            // If an email address already exists
            if($emailExists ) {
              echo $message;
              }

            if(isset($_SESSION['loggedIn'])) {
              if (!$_SESSION['loggedIn']) {
                userRegistration($firstName, $lastName, $email, $address, $city, $state, $zipcode, $phone, $displayName, $password);  
              }
            }   
            
          ?>
          

      </div>
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>