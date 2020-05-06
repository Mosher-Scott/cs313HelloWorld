<?php

require_once('../library/connections.php');
require_once('../model/acme-model.php');
require_once('../model/products-model.php');
require_once('../common/initialize.php');


$action = $_POST['action'];

if ($action == NULL) {
    $action = 'nothing';
 }

 // This is where we need to make sure the value for $action matches a case. So to test, we can var_dump it and see what the value is
echo('This is the var_dump of $action.  It shows up as type "value": <br>');
 var_dump($action);
 switch($action) {
    case 'addNewCategory':
        
        // TODO: Save post data to variables
        $categoryName = filter_input(INPUT_POST, 'categoryName');
        // TODO: Check for missing data.  If there is, then display error message
        if(empty($categoryName)) {
            $message = '<p class="errorMessage">Please enter in a category name.</p>';
            include '../view/addNewCategory.php';
            exit;
        }

        // Insert data into the database 
    
        $outcome = addCategory($categoryName);

        // See if the insert statement was successfull
        if($outcome === 1) {
            include '../view/productManagement.php';
            exit;
        } else {
            $message = "<p>Sorry, but $categoryName, was not added successfully. Please try again.</p>";
            include '../view/addNewCategory.php';
            exit;
        }

    case 'addNewProduct':

    // Save form data to variables
    $invName = filter_input(INPUT_POST, 'invName');
    

    // Check for empty values.  Display error message if there are
    if(empty($invName)) {
        # Broken, won't work
        echo ('<p class="errorMessage">Please fill out all fields. This showed up because the the $invName variable was empty</p>');
        exit;
    }

    // This is where your sql statement, or whatever else you want to do goes.  I'm just setting it to a number so I can easily break it
    $outcome = 2;

    // Check the response
    if ($outcome === 1) {
        echo("<br><br>");
        echo("You have put $invName to the page. In the real environment, this would be the same as adding it to the database");
        // Include the other page
        exit;
    } else {
        echo('<p class="errorMessage">Sorry, we could not add ' . $invName . ' to the database.  Please try again. </p>');
        // Include the other page
        exit;
    }

    default:
        echo("<br>");
        echo("There is no case option for funStuff, so the default option showed up");
        // Include the other page
        exit;

 }
?>