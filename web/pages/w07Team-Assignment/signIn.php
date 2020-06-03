<?php
   // session_start();
    require_once('functions.php');
    include_once('../../common/header.php');
    include_once('../../common/nav.php');



  $errors = false;
  $message = '';
  $successfulRegistration = false;
  $userName = '';

  // 
  if(isset($_GET['action']) && $_GET['action'] == 'logOut') {
      session_destroy();  
  }

  // If its set, get the userName value of the get request
  if (isset($_GET['userName'])) {
      $userName = validateInput($_GET['userName']);
  }

  // Check if the user had registered.  If it is change this to true, so a message will be displayed later.
  if (isset($_GET['registrationSuccessfull'])) {
      $successfulRegistration = validateInput($_GET['registrationSuccessfull']);
  }

  // Handle POST requests
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // print_r($_POST);

      // Save POST data to variables
      $userName = validateInput($_POST['userName']);
      $password = validateInput($_POST['password']);

      // Now validate the password with what is in the database
      $hashedPassword = getPasswordWithUserName($userName);

      // Just get the password from the variable
      $hashedPassword = $hashedPassword[0]['password'];

      // Verify the hashed password matches what the user inputted.  If they do, then send the user to the welcome page. If not, display a message
      if (password_verify($password, $hashedPassword)) {

          $_SESSION['userName'] = $userName;
          header('Location: welcome.php');
          die();

      } else {
          $errors = true;
          $message = 'Sorry, your password is incorrect';
      }

  }

?>
  <main class="rounded-corners">
    <section>
      <div class="container">
        <h2>Please Sign In</h2>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
    <div class="container">
    <?php 
      // If registration was successful, display a message.  If the user is just accessing this page on its own, we don't want them to see this message
      if ($successfulRegistration) {
          echo "<h3>Registration successful</h3>";
      }


      // Display the form so the user can log in
     // signUpForm('logInRequest', $userName); 
      if($errors) {
          echo $message;
      }

      signUpFormDoublePassword('hi');
    ?>
      <p>Don't have an account? <a href="signUp.php">sign up</a></p>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>