<?php
    
// Make sure this file is in the folder with the rest of the files
@require_once('teamAssignmentMethods.php');

// If POST is set, then do the following
if(isset($_POST)) {

    // Moved all this to a function.  Why?  Because we are going to have to do the same work on the scripturesStretchChallenge.php page
    processPostDataForNewScripture();

    // Now redirect to the new page.  Technically you'd want to check if values were inserted, and if successfull redirect the user, but this works for now
    // finally, redirect them to a new page to actually show the topics
    header("Location: show-topics.php");

    die(); // we always include a die after redirects. In this case, there would be no
    //        // harm if the user got the rest of the page, because there is nothing else
    //        // but in general, there could be things after here that we don't want them
    //        // to see.

}
     
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>CTE341 | Web Backend Development II | Scripture Details</title>

    <link rel="stylesheet" href="../Homepage/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&Oswald&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <?php // include 'Homepage/php/header.php'; ?>
    </header>
    <main>
        <div class="main-container">
            <h2 class="page-title">Insert Scriptures</h2>
         
       
        </div>
           

    </main>

    <footer>
    
    </footer>
</body>

</html>