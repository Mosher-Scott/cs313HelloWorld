 <!-- <title><?php echo $productName; ?> Product | Acme, Inc.</title> -->
    <main>
        <br>
        
        <?php 
             // If any error messages, display them here
             if(isset($message)) {
                echo $message;
            }

            // Has the person reviewed this product yet
            if (isset($_SESSION['clientData'])) {
                $hasReviewedProduct = hasReviewedProduct($_SESSION['clientData']['clientId'], $productId);
            }

            
            // Product display
            echo $productDisplay;

            echo"<hr><h1 id='reviewTitle'>Customer Reviews</h1>";
            
            if(isset($errorMessage)) {

                echo "<h3 id='emptyReviewMessage'>$errorMessage</h3><br>";
            }

            // Link to log in page if user is not logged in. If logged in, see if they have reviewed the product already
            if ($_SESSION['loggedin'] == TRUE) {

                if (count($hasReviewedProduct) > 0) {
                    echo "<div id='userCreatedReviewAlready' class='centered'><h3>You have already reviewed this product. You can modify your review <a href=" . urlPath('/accounts/index.php?action=userAlreadyLoggedIn') . ">here</a></h3></div>";
                } else {
                                   // Get client screen name
                $userName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];
                echo createReviewForm($_SESSION['clientData']['clientId'], $productId, $userName);

                }
 
            } else {
                echo "<div id='loginLink' class='centered'><h3>You can add in your own review if you <a href=" . urlPath('/accounts/index.php?action=login') . ">log in</a></h3></div>";
            }

            // Review display
            echo $reviewDisplay;


        ?>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>