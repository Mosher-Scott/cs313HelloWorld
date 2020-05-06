<?php

if (!isset($_SESSION['clientData']['clientLevel'])) {
    header('location:/acme/');
    exit;
}

include_once('../common/header.php');
include_once('../common/nav.php');

?>

 
    <main>
        <br>
        <div id="accountInfoDiv">

            <?php 
            // var_dump($_SESSION);
            echo "<h2>Welcome ". $_SESSION['clientData']['clientFirstname'] . "</h2>";
            echo "<br><p>Please choose from the following forms to change your account information</p>"
            ?>
            
            <br>

            <?php
                // If any error messages, display them here
                if(isset($message)) {
                    echo $message;
                }
            //var_dump($_POST);
            ?>     
                <div class="formDiv">
                <h3>Change Account Info</h3>
                <form action="<?php echo urlPath('/accounts/index.php'); ?>" method="post">
                    
                    <label for="clientFirstname">First Name:</label>
                    <input type="text" placeholder=" Enter First Name" id="clientFirstname" name="clientFirstname" required <?php 
                    echo "value='" . $_SESSION['clientData']['clientFirstname'] . "'";  
                    ?>>

                    <br>

                    <label for="clientLastname">Last Name:</label>
                    <input type="text" placeholder=" Enter Last Name" id="clientLastname" name="clientLastname" <?php 
                    echo "value='" . $_SESSION['clientData']['clientLastname'] . "'";  ?>  
                    required>

                    <br>

                    <label for="clientEmail">Email:</label>
                    <input type="email" placeholder=" user@acme.com" id="clientEmail" name="clientEmail" <?php 
                    echo "value='" . $_SESSION['clientData']['clientEmail'] . "'"; 
                    ?> required>

                    <input type="hidden" name="pageType" value="updateAccountDetails">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    <br>
                    <input type="submit" class="submitButton" value="Update Account Information">
                </form>
                </div>

                <br>
                <hr>
                <br>
            
                <div class="formDiv">
                <h3>Change Password</h3>
                <form action="<?php echo urlPath('/accounts/index.php'); ?>" method="post">
                <?php
                    if(isset($message2)) {
                        echo $message2;
                    }  ?>
                    <p>Passwords must be a minimum of 8 characters, and contain at least 1 of the following: Number, Capital letter, special character</p>
                    
                    <label for="clientPassword">New Password:  </label>
                    
                    <input type="password" placeholder=" Enter Password" id="clientPassword" name="clientPassword" required >

                    <input type="hidden" name="pageType" value="updateAccountPassword">
                    <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
                    <br>
                    <input type="submit" class="submitButton" value="Update Account Information">
                </form>
                </div>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>