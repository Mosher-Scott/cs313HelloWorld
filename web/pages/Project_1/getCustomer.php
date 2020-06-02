<?php

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

// Creates the table with the user details for displaying the results
function createUserDetailsTable($users) {
    echo "<table class='table table-striped'>";
   
    // Setup table headers
    echo "<tr>";
    echo "<th scope='col'>ID</th>";
    echo "<th scope='col'>First Name</th>";
    echo "<th scope='col'>Last Name</th>";
    echo "<th scope='col'>Address</th>";
    echo "<th scope='col'>City</th>";
    echo "<th scope='col'>State</th>";
    echo "<th scope='col'>Zip</th>";
    echo "<th scope='col'>Phone</th>";
    echo "<th scope='col'>Email</th>";
    echo "<th scope='col'>Display Name</th>";
    echo "<th scope='col'>Role</th>";
    //echo "<th scope='col'>Options</th>";
    echo "</tr>";

    // Now populate it with data
    foreach ($users as $user) {

        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['first_name']}</td>";
        echo "<td>{$user['last_name']}</td>";
        echo "<td>{$user['billing_address']}</td>";
        echo "<td>{$user['billing_city']}</td>";
        echo "<td>{$user['billing_state']}</td>";
        echo "<td>{$user['billing_zip']}</td>";
        echo "<td>{$user['billing_phone']}</td>";
        echo "<td>{$user['email']}</td>";
        echo "<td>{$user['display_name']}</td>";
        echo "<td>{$user['user_role']}</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Gets all the user info for a single user
function getSingleUserDetails($id) {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name, user_role FROM public.user WHERE id = :id';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

//  When the page is requested as a GET request, do the following

    // First save the get value
    $id = $_GET['id'];

    // Get the user details from the DB
    $userDetails = getSingleUserDetails($id);

    // Now create the table with those details and return the resulting table back to the calling page
    createUserDetailsTable($userDetails);
?>