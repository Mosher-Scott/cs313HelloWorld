<?php

/*********  Login Functions **********/

    // Validate email format
    function checkEmail($clientEmail) {
        $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
        return $valEmail;
    }

    // Check if the password is the correct pattern
    function checkPassword($clientPassword) {
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
        return preg_match($pattern, $clientPassword);
    }

    // Log the user in
    function loginUser($userEmail) {
        $_SESSION['loggedIn'] = true;

        $userInfo = getSingleUserDetailsByEmail($userEmail);

        // Store user data to be used in the future
        $_SESSION['userInfo'] = $userInfo;
    }

    // Logout the user
    function logUserOut() {
        session_destroy();          
    }

    // Checks if the user is logged in as an admin. 
    function checkIfAdminUser() {
        // If the user is not an admin, don't let them see the page

    if(!isset($_SESSION['userInfo']) || $_SESSION['userInfo'][0]['user_role'] == 'customer') {

        return false;
        } else { return true;}
    } 

    // Message to display if the user is not an admin user
    function notAdminMessage() {
        echo "<div class='container'>";
        echo "<h3> You must have administrative privleges to view this page.</h3>";

        loginPageButton();
    }


?>