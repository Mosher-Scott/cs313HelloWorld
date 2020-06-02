<?php

require_once('functions.php');

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // print_r($_POST);

    // Save POST data to variables
    $userName = validateInput($_POST['userName']);
    $password = validateInput($_POST['password']);

    // Now hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

 // Commented out for testing since I need to create the table
    // Now save the data to the database
    $rowsChanged = registerNewUser($userName, $hashedPassword);

    echo $rowsChanged;

    // If successfully inserted the user info, redirect them to the login page
    if ($rowsChanged == 1) {
        header('Location: signIn.php');
    die();
    }

    // Fow now, just send them to the signin page with the username
    // header('Location: signIn.php?userName=' .$userName . '&registrationSuccessfull=1');
    // die();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="W07 Team Assignment">
        <meta name="author" content="Scott Mosher">
        <meta content="width=device-width, initial-scale=1" name="viewport" />

        <!-- Need to include bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <title>W07 Team Assignment</title>

        <script src="javascript.js"></script>  
    </head>

<body>
    <header>
    </header>   
    <main>
    <!-- ********** NOTE Both signin forms have the same field IDs, so if both are turned on there might be issues **********  -->
        <section>
            <h2>Please Register</h2>
            
            <?php 
            // Display the form with just a single password box
            signUpForm('registrationRequest'); ?>
        </section>
        <hr>
        <section>
            <h2>Please Register with Password Confirmation</h2>
            <p>This will use a 2nd password input box to make sure the user entered in the password they want to use.  It will use an AJAX function to check the passwords to make sure they match</p>
            <?php 
            // Display the form
            signUpFormDoublePassword('registrationRequest'); 
            
            ?>
        </section>
        

    </main>
    <footer>
    </footer>
</body>
</html>