<?php
// MTB Site
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