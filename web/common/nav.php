<?php

//debugArray($_SESSION);

   // Check if the user is logged in
    if(!isset($_SESSION['loggedIn'])) {
        $_SESSION['loggedIn'] = false;
        $_SESSION['userInfo'][0]['user_role'] = 'customer';
        //customerMtbMenu();  
    } 
    if (!isset($_SESSION['userInfo'][0]['user_role'])) {
        $_SESSION['loggedIn'] = false;
        $_SESSION['userInfo'][0]['user_role'] = 'customer';
        customerMtbMenu();
    }
    
    if(isset($_SESSION['loggedIn']) && $_SESSION['userInfo'][0]['user_role'] == 'admin') {
        adminMtbMenu();
    }
    if(isset($_SESSION['userInfo'][0]['display_name'])) {
        echo "<div class='container'>";
        echo "<h5 class='text-right'> Welcome Back {$_SESSION['userInfo'][0]['display_name']}</h5>";
        echo "</div>";
    } if(!$_SESSION['loggedIn'] || $_SESSION['userInfo'][0]['user_role'] == 'customer') {
        customerMtbMenu();
    }
?>
