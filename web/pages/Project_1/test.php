<?php

// Need to setup the page to receive the request and process it
//  https://www.w3schools.com/js/tryit.asp?filename=tryjs_ajax_database

// When trying this live, it won't be needed since it is already in the other file
function DbConnection() {
    $host = "ec2-54-236-169-55.compute-1.amazonaws.com";
    $db_name = "d5392qgm4bnosd";
    $user = "yyoehwuqwyqgnn";
    $password = "6362c80a60d68d910405f108339ca094e8d5666a40bfd9646da4e23759c0f7c5";
    $port = 5432;

    $dsn = "pgsql:host=$host;dbname=$db_name;user=$user;port=$port;password=$password;sslmode=require";

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $db = new PDO($dsn);
        return $db;
    } catch (PDOException $e){
        echo "Connection to the database failed";

        echo $e;
    }
}

// Creates a dropdown with IDs
function createIdForm($ids){
    echo "<form action=' '>";
    echo "<select name='Ids' onchange='showCustomer(this.value)'>";
    echo "<option value=' '>Choose ID</option>";
    foreach($ids as $id) {
        echo "<option value='{$id['id']}'>{$id['display_name']}</option>";
    }
    echo "</select>";

    echo "</form>";
}

// Connects to DB and gets the ID of all users
function getAllUserIdsAndDisplayName() {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, display_name FROM public.user';
        $stmt = $db -> prepare($sql);
        $stmt -> execute();
    
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}


$idsAndDisplayNames = getAllUserIdsAndDisplayName();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Test AJAX Calls">
        <meta name="author" content="Scott Mosher">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
    
        <title>Hello World</title>

        <!-- The script that runs when a user changes the dropdown display name -->
        <script>
            function showCustomer(str)
            {
                // Create the variable to hold the request
                var xhttp;

                if(str == " ") {
                    document.getElementById("txtHint".innerHTML) = '';
                    return;
                }

                // Now create the request
                xhttp = new XMLHttpRequest();

                // On state change, run this function
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Response text will be changed to what is returned
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                // Now this is how we're going to process the request, and where it will be processed
                xhttp.open("GET", "getCustomer.php?id="+str, true);

                // Send the request
                xhttp.send();
            }        
 </script>
    </head>

<body>
    <header>
    </header>   
    <main>
        <section>
            <h2>Please pick a display name</h2>
            <?php createIdForm($idsAndDisplayNames); ?>
        </section>
        <hr>
        <section  id="txtHint"> This is where results will be displayed
        </section>
    </main>
    <footer>
    </footer>
</body>
</html>