<?php
    // Check if the user role is a customer or if they are not logged in
    if(!$_SESSION['loggedIn'] || $_SESSION['userInfo'][0]['user_role'] == 'customer') {
        customerMtbMenu();
    } if( $_SESSION['userInfo'][0]['user_role'] == 'admin') {
        adminMtbMenu();
    } else {
        customerMtbMenu();
    }
    if(isset($_SESSION['userInfo'][0]['display_name'])) {
        echo "<div class='container'>";
        echo "<h5 class='text-right'> Welcome Back {$_SESSION['userInfo'][0]['display_name']}</h5>";
        echo "</div>";
    }
?>
