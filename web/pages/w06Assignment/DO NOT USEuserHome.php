<?php
  $pageTitle = "Login";
  @require_once('../../common/header.php');
  @require_once('../../model/user-model.php');

  $missingFields = false;

  // What to do if the user is trying to login
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    debugArray($_POST);

    $userEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
    $userEmail = checkEmail($userEmail);
    $password = $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Check if email or password is empty.  They shouldn't be though.
    if(empty($userEmail) || empty($password)) {
        $missingFields = true;
    }
  }
?>

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
        
        if($missingFields == true) {
            echo "<h4>Sorry, you forgot to fill out a field or two.</h4>";
            loginForm($userEmail);
        }
        loginForm(); ?>
      </div>
    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>