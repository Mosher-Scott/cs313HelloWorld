<?php
    function DbConnection() {
        $host = "ec2-35-171-31-33.compute-1.amazonaws.com";
        $db_name = "d5lcjqil4snvsb";
        $user = "evojeldfdzzkxp";
        $password = "2367b74cb2f2555fc88be1fea37bdf1acc1d9070729c73c3a4d04029bce6c95e";
        $port = 5432;
    
        $dsn = "pgsql:host=$host;dbname=$db_name;user=$user;port=$port;password=$password";
    
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $db = new PDO($dsn);
            return $db;
        } catch (PDOException $e){
            echo "Connection to the database failed";

            echo $e;
        }
    }

    function DbConnectionNonMtb() {
        $host = "ec2-18-233-32-61.compute-1.amazonaws.com";
        $db_name = "d3h9884il9ijro";
        $user = "ukrrsviyqnkmor";
        $password = "d1294a18dbc2a6656d417615b810c6285bd0c3fc477873b4a9d84737425d0082";
        $port = 5432;
    
        $dsn = "pgsql:host=$host;dbname=$db_name;user=$user;port=$port;password=$password";
    
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $db = new PDO($dsn);
            return $db;
        } catch (PDOException $e){
            echo "Connection to the database failed";

            echo $e;
        }
    }
?>