<?php

// Credentials
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'newPassword';
$dbname = 'acme';

// Create the connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Make sure to test if the connection is successfull or not.  If not, use this message and exit the code
if(mysqli_connect_errno()) {
    $msg = "Database connection failed: ";
    $msg .= " (" . mysqli_connect_errno() . ")";
    exit($msg);
}

// Function to close the connection to the database
function db_close($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}