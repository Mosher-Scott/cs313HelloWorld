<?php
session_start();

require_once('functions.php');

$userName = '';


if(isset($_SESSION['userName'])) {
    $userName = $_SESSION['userName'];
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
            if(isset($_SESSION['userName'])) {
                echo "Welcome {$_SESSION['userName']}";
                logOutButton();
            } else{
                //echo "Welcome, but you need to log in.";
                header('Location: signIn.php');
            }
               
               
            ?>

        </section>
        <hr>

    </main>
    <footer>
    </footer>
</body>
</html>