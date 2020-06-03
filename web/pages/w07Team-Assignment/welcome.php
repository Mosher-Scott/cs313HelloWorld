<?php
  require_once('functions.php');
  include_once('../../common/header.php');
  include_once('../../common/nav.php');

  $userName = '';

// Check is username is set or not
  if(isset($_SESSION['userName'])) {
      $userName = $_SESSION['userName'];
  }

?>
  <main class="rounded-corners">
    <section>
      <div class="container-fluid">
        <h2>Welcome!</h2>

        <?php 
        if(isset($_SESSION['userName'])) {
            echo "Welcome {$_SESSION['userName']}";
            logOutButton();
        } else{
            //echo "Welcome, but you need to log in.";
            header('Location: signIn.php');
        }
          
          
        ?>
      </div>   
    </section>
  </main>

<?php 
  @include_once('common/footer.php');
?>