<!DOCTYPE html>

<html lang="en">

<?php
    include_once('../common/header.php');
    include_once('../common/nav.php');

?>

    <main>
        <br>
        <div id="formDiv">

            <h2>Registration</h2>
            
            <?php
                if(isset($message)) {
                    echo $message;
                }
            ?>
            

            <form action="<?php echo urlPath('accounts/index.php'); ?>" method="post">

                <label for="firstName">First Name:</label>
                <input type="text" placeholder=" Enter First Name" id="clientFirstname" name="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>
                <br>
                <label for="lastName">Last Name:</label>
                <input type="text" placeholder=" Enter Last Name" id="clientLastname" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required>
                <br>
                <label for="email">Email:</label>
                <input type="email" placeholder=" user@acme.com" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
                <br>
                <label for="password">Password:  </label>
                <span>Passwords must be a minimum of 8 characters, and contain at least 1 of the following: Number, Capital letter, special character</span>
                <input type="password" placeholder=" Enter Password" id="clientPassword" name="clientPassword" required pattern=(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$>
                <br>
                <input type="hidden" name="pageType" value="register">

                <br>
                <input type="submit" class="submitButton" value="Complete Registration">
            </form>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>