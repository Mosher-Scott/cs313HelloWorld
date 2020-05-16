<?php

    $host = "ec2-35-171-31-33.compute-1.amazonaws.com";
    $db_name = "d5lcjqil4snvsb";
    $user = "evojeldfdzzkxp";
    $password = "2367b74cb2f2555fc88be1fea37bdf1acc1d9070729c73c3a4d04029bce6c95e";
    $port = 5432;

    $dsn = "pgsql:host=$host;dbname=$db_name;user=$user;port=$port;password=$password";

    try {
        $db = new PDO($dsn);
    } catch (PDOException $e){
        echo "Connection to the database failed";
    }
?>