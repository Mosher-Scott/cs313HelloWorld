<?php
    if (!$_SESSION['loggedin'] || (!isset($_SESSION['clientData']))) {
        header('Location: ../accounts/index.php?action=');
    }

    include_once('../common/header.php');
    include_once('../common/nav.php');
    include_once('../library/functions.php');
    include_once('../model/reviews-model.php');

    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    $singleReview = getSpecificReview($reviewId);

?>

    <main>
        <br>
        <div id="accountInfoDiv">
            
            <h2>Delete Review</h2>
            <hr>
            <br>
            <?php
  
             // If any error messages, display them here
             if(isset($message)) {
                 echo $message;
             }
         ?> 
        
        <h3>Are you sure you want to delete this review?  Remember this cannot be undone.</h3>
        <br>
        <?php echo displaySingleReview($reviewId);
        
        ?>
        <br>
        <form <?php echo "action=" . urlPath('reviews/index.php') . " method='post'"; ?>>
             <input type="submit" value="Delete Review">
             <input type="hidden" name="pageType" value="deleteReview">
             <input type="hidden" name="reviewId" value="<?php echo $reviewId;?>">
        </form>
        <p>Button to click that will actually delete the review</p>
        <p>"No" button that will function as a "back" button</p>
         
         </div>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>
    