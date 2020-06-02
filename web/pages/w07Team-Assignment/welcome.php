<?php
session_start();

require_once('functions.php');

$errors = false;
$successfulRegistration = false;
$message = '';
$userName = '';
// If its set, get the userName value of the get request
if (isset($_GET['userName'])) {
    $userName = validateInput($_GET['userName']);
}

if (isset($_GET['registrationSuccessfull'])) {
    $successfulRegistration = validateInput($_GET['registrationSuccessfull']);
}

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);

    // Save POST data to variables
    $userName = validateInput($_POST['userName']);
    $password = validateInput($_POST['password']);

    // Now validate the password with what is in the database
    $hashedPassword = getPasswordWithUserName($userName);

    // Verify the hashed password matches what the user inputted.  If they do, then send the user to the welcome page. If not, display a message
    if (password_verify($password, $hashedPassword)) {
        
        // Save username to a session variable
        $_SESSION['userName'] = $userName;

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
            <h2>Welcome!</h2>

            <?php 
                echo "Welcome {$SESSION_['userName']}";
            ?>

        </section>
        <hr>

    </main>
    <footer>
    </footer>
</body>
</html>