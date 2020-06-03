<?php
    require_once('functions.php');
    include_once('../../common/header.php');
    include_once('../../common/nav.php');

    $message = '';

    // Handle POST requests
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //print_r($_POST);
    
        // Save POST data to variables
        $userName = validateInput($_POST['userName']);
        $password = validateInput($_POST['password']);
        $passwordConfirmation = validateInput($_POST['passwordConfirmation']);
    
    
        // Password verify would go here
        $isPasswordGood = checkPassword($password);
    
        if($isPasswordGood && ($password == $passwordConfirmation)) {
            // Now hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Now save the data to the database
            $rowsChanged = registerNewUser($userName, $hashedPassword);
    
            // echo $rowsChanged;
    
            // If successfully inserted the user info, redirect them to the login page
            if ($rowsChanged == 1) {
                header('Location: signIn.php?userName=' . $userName . "&registrationSuccessfull=true");
                die();
            }
    
        } else {
            $message = "<h3 class='text-danger'>Sorry, passwords don't match</h3>";
        }
    }    

?>
  <main class="rounded-corners">

    <section>
      <div class="container-fluid">
      <h2>Please Register</h2>
          <p>This will use a 2nd password input box to make sure the user entered in the password they want to use.  It will use an AJAX function to check the passwords to make sure they match</p>
          <?php 

          echo $message;
          // Display the form
          signUpFormDoublePassword('registrationRequest'); 
            ?>
      </div>
    </section>

</main>

<?php 
  @include_once('common/footer.php');
?>