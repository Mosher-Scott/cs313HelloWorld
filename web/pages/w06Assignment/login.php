<?php

  $pageTitle = "Login";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $missingFields = false;
  
  if(isset($_GET['action']) && $_GET['action'] == 'logOut') {
    logUserOut();
    header('Location: products.php');
    //debugArray($_SESSION);
  }

  // First check if it is a post request
  if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check to see if the 'action' variable is set, and if it is a login Request, do the following
    if( isset($_POST['action']) && $_POST['action'] == 'loginRequest') {
      $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
      $userEmail = checkEmail($userEmail);
      $password = $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      // Check if email or password is empty.  They shouldn't be though.
      if(empty($userEmail) || empty($password)) {
          $missingFields = true;
      }

      // TODO: Find user in the DB
      $passwordFromDb = getPasswordWithEmail($userEmail);
      
      // Now check if their passwords match
      if ($password == $passwordFromDb[0]['password']) {
        
        // Run the method to log the user in
        loginUser($userEmail);
        
        // Now get user information to see which page they should be directed to
        $userRole = getUserRoleWithEmail($userEmail);

        echo $userRole;
        if ($userRole = 'customer')
          {
            header('Location: products.php');
            die();
          } else {
          // Now send the user to the Admin page
         // header('Location: orderAdmin.php');
          // die();
          }
          

      }
    }
  }
  
?>

<nav class='rounded-corners'>
  <?php require_once('../../common/nav.php'); ?>
</nav>

<main class="rounded-corners">
    <section>
    
      <div>
        <h1>Login</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid text-left">
        <?php  
        //debugArray($_SESSION);
        
        // If the user is logged in, display a logout button
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
          logOutButton();
        } else {
          
          if($missingFields == true) {
            echo "<h4>Sorry, you forgot to fill out a field or two.</h4>";
            loginForm($userEmail);
            
          } else {
            loginForm();
          }
        }
        
         ?>
      </div>
    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>