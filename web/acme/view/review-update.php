<?php
    if (!$_SESSION['loggedin'] || (!isset($_SESSION['clientData']))) {
        header('Location: ../accounts/index.php?action=');
    }

    include_once('../common/header.php');
    include_once('../common/nav.php');
    include_once('../library/functions.php');
    include_once('../model/reviews-model.php');

?>

    <main>
        <br>
        <div id="accountInfoDiv">
            
            <h2>Update Review</h2>
            <hr>
            <br>
            <?php
  
             // If any error messages, display them here
             if(isset($message)) {
                 echo $message;
             }

             echo updateReviewForm($userName, $reviewId, $clientId, $reviewText);
       
         ?> 
        </div>
         
    </main>

    <?php
        require_once('../common/footer.php');
    ?>
    