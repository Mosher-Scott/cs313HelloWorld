
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
            
            <h2>Account Information</h2>
            <hr>
            <h4>You Are Logged In As: <?php echo ($_SESSION['clientData']['clientFirstname']); ?></h4>

            <?php
  
             // If any error messages, display them here
             if(isset($message)) {
                 echo $message;
             }
       
         ?> 
         <br>
            <ul>
                <li>First Name: <?php echo($_SESSION['clientData']['clientFirstname']); ?></li>
                <li>Last Name: <?php echo($_SESSION['clientData']['clientLastname']); ?></li>
                <li>Email: <?php echo($_SESSION['clientData']['clientEmail']); ?></li>
            </ul>
            
            <hr>
            <h4>Account Tasks</h4>
            <?php 
                // If the client level is greater than 1
                if ($_SESSION['clientData']['clientLevel'] > 1) {
                    echo('<p>You are allowed to modify or add products & categories to the system.
                    You may do so here <a href="' . urlPath('products/index.php') . '">here</a>.');
                }
            ?>  

            <p><a href="../accounts/index.php?action=updateAccount">Update Account Info</a></p>
        </div>

        
        <br>
        <h1>Your Reviews</h1>
        <?php
            if(isset($reviewEditMessage)) {
                echo $reviewEditMessage;
            }
        ?>
        <?php echo displayAllCustomerReviews($_SESSION['clientData']['clientId']); ?>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>
    