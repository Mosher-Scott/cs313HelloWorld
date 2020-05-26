<?php
require_once('initialize.php');
?>

<!DOCTYPE html>
<html  lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="description" content="Home">
        <meta name="author" content="Scott Mosher">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo urlPath('/css/main.css'); ?>">
        
        <script src="<?php echo urlPath('scripts/javascript.js');?>"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="<?php echo urlPath('/scripts/jquery.js');?>"></script>
        
        <title><?php
        // echo $pageTitle;
            if(isset($pageTitle)) {
                echo "CS313 - {$pageTitle}";
            } else {
                echo "CS313 Assigment";
            }
        ?> </title>

        
        
    </head>

<body>
    <header class="rounded-corners">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h2>CS 313 - Backend Development</h2>
                </div>
                <div class="col-md-6">
                    <nav>
                        <label for="toggle">Menu</label>
                        <input id="toggle" type="checkbox">
                        <ul id="menu">
                            <li class=" btn btn-primary"><a href="<?php echo urlPath('/index.php');?>">Home</a></li>
                            <li class=" btn btn-primary"><a href="<?php echo urlPath('/pages/assignments.php'); ?>">Assignments</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </header>   