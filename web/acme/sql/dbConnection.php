<?php

$server="localhost";
$dbname="acme";
// $username="root";  // Laptop
$username="acmeAdmin"; // Desktop
$password="newPassword";
$dsn='mysql:host='.$server.';dbname='.$dbname;
$options=array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
} catch(PDOException $e) {
     header('Location: /acme/view/500.php');
    echo 'Sorry, the connection failed';
    exit;
}

?>