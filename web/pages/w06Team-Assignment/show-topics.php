<?php

    @require_once('teamAssignmentMethods.php');
    

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
        <?php // include '../Homepage/php/header.php'; ?>
    </header>
    <main>
        <div class="main-container">
            <h2 class="page-title">Show Topics</h2>

       
       <?php
            // With this being in a function, you could reuse it anywhere 
            getScriptures();
        ?>
 </div>
           

           </main>
       
           <footer>
           
           </footer>
       </body>
       
       </html>