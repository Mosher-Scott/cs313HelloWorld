<?php
    // Check if the user role is a customer or if they are not logged in
    if(!$_SESSION['loggedIn'] || $_SESSION['userInfo'][0]['user_role'] == 'customer') {
        customerMtbMenu();
    } else {
        adminMtbMenu();
    }
    if(isset($_SESSION['userInfo'][0]['display_name'])) {
        echo "<div class='container'>";
        echo "<h5 class='text-right'> Welcome Back {$_SESSION['userInfo'][0]['display_name']}</h5>";
        echo "</div>";
    }
?>

ALTER TABLE public.user ADD COLUMN user_role varchar(30) DEFAULT 'customer';
