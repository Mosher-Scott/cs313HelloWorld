<!DOCTYPE html>

<html lang="en">

<?php

// Misc Stuff
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("IMAGES_PATH", PROJECT_PATH . '/images');
    
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '\acme');

     // * Can dynamically find everything in URL up to "/acme"
     $public_end = strpos($_SERVER['SCRIPT_NAME'], '/acme') + 6; // Decides that is where the document root is
     $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
     define("WWW_ROOT", $doc_root);

    // Load the db connection
    require_once(PROJECT_PATH . '/sql/dbConnection.php');

     // Send the function a path
     function urlPath($script_path) {
        // Add the leading / if not present
        if($script_path[0] != '/') {
            $script_path = '/' . $script_path;
        }

        return WWW_ROOT . $script_path;
    }

// Acme Model Function
function getCategories() {
    $db = acmeConnect();

    $sql = 'SELECT categoryName, categoryId FROM categories ORDER BY categoryName ASC';

    $stmt = $db->prepare($sql);

    $stmt -> execute();

    $categories = $stmt->fetchAll();

    $stmt->closeCursor();

    return $categories;
}

// What is in my connections file
function acmeConnect(){
    $server = 'localhost';
    $dbname = 'acme';
    // Change username & password to match your stuff
    $username = 'acmeAdmin';
    $password = 'newPassword'; // Yes, totally secure, I know. Considering you don't have access to my database, I'm not worried :)
    $dsn = 'mysql:host='.$server.';dbname='.$dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    // Create the actual connection object and assign it to a variable
    try {
     $link = new PDO($dsn, $username, $password, $options);
     return $link;
    } catch(PDOException $e) {
     header('Location: /acme/view/500.php');
     exit;
    }
   }

// Need this since it contains my function to get all the inventory items
require_once('forGroup-model.php');

/******************************* 
 * Everything above this would be different than your page,  I combined most of our require_once files and just added them here
 * 
 * *****************************************************/

// Get categories for the nav list
$categories = getCategories();

// Build the nav list
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach($categories as $category){
    $navList .= "<li><a href='/acme/index.php?action=".$category['categoryName']."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= "</ul>";

// Include the nav bar on the page
include_once('../common/nav.php');

// Run the sql query to get a list of all inventory items in the database, and assign the array to $inventoryItems
$inventoryItems = getInventoryData();

?>

<!-- Head & header would normally be in my header.php, but I just moved them here because I can -->
<head>
    <title>Acme</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="all" href="<?php echo urlPath('css/stylesheet.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Chilanka%7cPermanent+Marker&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <div id="topHeader">
        <div id="logo" class="basicGrid">
            <img src="<?php echo urlPath('images/site/logo.gif'); ?>" title="Acme Company Logo" alt="Acme company logo">
        </div>
        <div id="myAccount">  
            <div id="myAccountIcon">
            <a href="<?php echo urlPath('/view/login.php'); ?>"> <img src="<?php echo urlPath('images/site/account.gif'); ?>" title="My Account icon" alt="Icon"></a>
            </div>
            <div id="accountText">  
            <a href="<?php echo urlPath('/view/login.php'); ?>">My Account</a>
            </div>
        </div>
    </div>
</header>

    <main>
        <br>
        <div style="background:white; margin:2%">
            <h3>How I code stuff</h3>
            <p>Need to break down the assignment into small parts, including things to troubleshoot.  I usually test each step.</p>
            <ol>
                <li>Create a page containing a form for a user to enter in a new category</li>
                <li>On form submission, send the user to the controller page</li>
                <li>Create a case for handling the form data.  Check to make sure when submit the form, the controller takes you to the right case.</li>
                <li>Do a var_dump or something on the controller page to make sure your data is all showing up</li>
                <li>Now save data from $_POST to a variable</li>
                <li>Check for empty values & handle it if there are</li>
                <li>Create a variable and use it to call your sql function</li>
                <li>Create your sql statement & bind all the values. Don't write the execute part of your function yet.  Instead after all your bindValue statements, you can do something like echo("working so far").  If you get this far, everything should work</li>
                <li>Now create your execute statement & finish the rest of the function</li>
            </ol>
            <hr>
        </div>
        <div style="background:white; margin:2%">
        <h2>This is using print_r to show what my $inventoryItems array looks like</h2>
        <?php 
            print"<pre>";
            print_r($inventoryItems); 
            print "</pre>";
        ?>

        <hr>
        <p>This is technically an "array of arrays".  At the first line, you see this: Array( [0] => Array.  As you go through the list, you'll see: [1] => Array, [2] => Array, etc
        </p>
        <br>
        <p>Arrays start at 0, so to access the first element in the array, we would use something like this:  $inventoryItems[0].  If I change [0] to another number, I will get different results</p>
        <?php
            print"<pre>";
            print_r($inventoryItems[5]); 
            print "</pre>";
        ?>
    <hr>
<br>
        <p>The arrays we are working with are storing values in a key -> value pairing.  You can get a value, if you specify the key.
        <p>You'll also notice that in the array above, there are duplicate values.  For example you'll see [invName] => Acme Rocket and [1] => Acme Rocket.  We can use either key to get the value.</p>
        <?php
            echo('print_r($inventoryItems[0][2]); ');
            print"<pre>";
            print_r($inventoryItems[0][2]); 
            print "</pre>";
            echo('Or print_r($inventoryItems[0]["invPrice"]); and get the same result:');
            print"<pre>";
            print_r($inventoryItems[0]['invPrice']); 
            print "</pre>";
        ?>
        <hr>
        <br>
        <p>Now we can play with values and see what we get</p>
        <?php
            print"<pre>";
            print_r($inventoryItems[6][8]); 
            print "</pre>";
        ?>
        </div>

        <div style="background:white; margin:2%">
            <h3>Why did I bring this up?</h3>
            <p>Because of our loop we'll be doing, we'll want to look at everything.  For this first one, we'll just create p elements for each item that is in the array.  I'm going to start using 'invStyle', but you can change it to any key in the array.  The key is also the column name in the database.</p>

            <?php
                

                // Now, create a loop that will go through each element of the array, and create a new element for it
                foreach($inventoryItems as $element) {
                    // Create the element, and assign it to a variable
                    $inventoryList = '<p>';

                    // Now, using $element[' '], chose the value you want to display
                    $inventoryList .= $element['invPrice'];

                    // Don't forget to add in your closing tag
                    $inventoryList .= '</p>';

                    // Now for this, display each on the page
                    echo($inventoryList);
                }
                
                echo("<hr>");
                echo("Now lets work on concatenating some elements & strings.  You will need to do this for your dropdown list");
                // Now, create a loop that will go through each element of the array, and create a new element for it
                foreach($inventoryItems as $element) {
                    // Create the element, and assign it to a variable
                    $inventoryList = '<p>';

                    // Now, using $element[' '], choose the value you want to display and append it to the variable
                    $inventoryList .= "The value isdfgsdgsdfgds: " . $element['invStyle'];

                    // Don't forget to add in your closing tag
                    $inventoryList .= '</p>';

                    // Now for this, display each on the page
                    echo($inventoryList);

                    // Note: You could also do the following: 
                    // $inventoryList = '<p> The value is: ' . $element['invName'] . '</p>';
                    
                }

                echo("<hr>");
                echo("Now we'll look create the dropdown menu.  Remember you will need a name attribute, and a value.  Just like you concatenated strings with variables, you can concatenate HTML tags with variables, just like we did with the nav menu.<br>");
                
                
            ?>
        </div>

        <div style="background:white; margin:2%">
                <hr>
            <h3>Foooooooorrrrrrmmmmmssssss</h3>
            <?php
                print("<pre>");
                print('< form action="products/index.php" method="post">');
                print("</pre>");
            ?>
            <p>Action is where the user will be directed once they submit the form, or what will happen next.  Method is how the data will be sent.</p>
            <form action="index.php" method="post">
            <p>name="":  In the $_POST array, this becomes the key.  Example $_POST['invName'] would contain whatever value the user entered in the input box </p>
                <label for="newItemName">Name:</label>
                    <input type="text" placeholder=" Item Name" id="newItemName" name="invName">
                    <br>

                    <?php
                    // Now build the dropdown list. First you need to create the select element
                $inventoryList = '<select id="CategoryDropdown" class="categoryDropdownList" name="invCategory">';

                // I wanted a default value/option to show up first
                $inventoryList .= '<option selected="selected" disabled="disabled">Show inventory item name</option>';

                foreach($inventoryItems as $element) {
                    $inventoryList .= '<option value="' . $element['invName'] . '">' . $element['categoryId'] /* What you want the user to see here. */ . "</option>";
                }
                $inventoryList .= "</select>";

                echo($inventoryList);
                 
                    ?>
                    <p>Now we have a hidden item that contains the key action, and the value addNewProduct</p>
                    <input type="hidden" name="action" value="addNewProduct">
                    <input type="submit" class="submitButton" value="I'm a Button">
                </form>
            </div>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>