<?php

require_once('functions.php');

$errors = false;
$message = '';
$successfulRegistration = false;
$userName = '';
// If its set, get the userName value of the get request
if (isset($_GET['userName'])) {
    $userName = validateInput($_GET['userName']);
}

// Check if the user had registered.  If it is change this to true, so a message will be displayed later.
if (isset($_GET['registrationSuccessfull'])) {
    $successfulRegistration = validateInput($_GET['registrationSuccessfull']);
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // print_r($_POST);

    // Save POST data to variables
    $userName = validateInput($_POST['userName']);
    $password = validateInput($_POST['password']);

    // Now validate the password with what is in the database
    $hashedPassword = getPasswordWithUserName($userName);

    // Verify the hashed password matches what the user inputted.  If they do, then send the user to the welcome page. If not, display a message
    if (password_verify($password, $hashedPassword)) {

        header('Location: welcome.php');
        die();

    } else {
        $errors = true;
        $message = 'Sorry, your password is incorrect';
    }

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

        
    </head>

<body>
    <header>
    </header>   
    <main>
        <section>
            <h2>Please Sign In</h2>

            <?php 
                // If registration was successful, display a message.  If the user is just accessing this page on its own, we don't want them to see this message
                if ($successfulRegistration) {
                    echo "<h3>Registration successful</h3>";
                }


                // Display the form so the user can log in
                signUpForm('logInRequest', $userName); 
                if($errors) {
                    echo $message;
                }
            ?>

        </section>
        <hr>

    </main>
    <footer>
    </footer>
</body>
</html>