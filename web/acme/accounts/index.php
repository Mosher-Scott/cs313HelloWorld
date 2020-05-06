<?php
// Start the session, if it hasn't already
session_start();

require_once('../common/initialize.php');
require_once('../library/connections.php');
require_once('../model/acme-model.php');
require_once('../model/accounts-model.php');
include_once('../library/functions.php');


$action = filter_input(INPUT_POST,'pageType');

// For checking the action variable to make sure it is correct
// echo($action);

if ($action == NULL) {
    $action = filter_input(INPUT_GET,'action');
 }

 switch($action) {
    case 'newUser':
        // include_once('../common/header.php');
        // include_once('../common/nav.php');
        include '../view/register.php';
        break;

    case 'login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);

        // If anything is wrong, send the user back to the page & have them fix things
        if (empty($clientEmail) || empty($clientPassword)) {
            $message = '<p class="errorMessage">Please enter a valid email address and password</p>';
            // include_once('../common/header.php');
            // include_once('../common/nav.php');
            include '../view/login.php';
            exit;
        }

        // If you've gotten this far, then the user inputs are valid.  Now get the user data
        $clientData = getClient($clientEmail);

        // Now verify the passwords match
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        if (!$hashCheck) {
            $message = '<p class="errorMessage">Please enter a valid password</p>';
            include '../view/login.php';
            exit;
        }

        // If their login information is good, store some of it in the session data
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the session data
        array_pop($clientData);

        // Now store the rest in the session array
        $_SESSION['clientData'] = $clientData;


        include '../view/admin.php';
        break;
    

    case 'userAlreadyLoggedIn':

        // If the user is already logged in, they should be able to access the admin page
        if ($_SESSION['loggedin'] = TRUE){
            include '../view/admin.php';
        } else {
            include '../index.php';
        }
        
    break;

    case 'signInRequest':

        $clientEmail = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Validate password & email 
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

         // Now check for any missing form data
         if(empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="errorMessage">Please provide information for all form fields.</p>';
            include '../view/login.php';
            exit;
        }

        // If you've gotten this far, then the user inputs are valid.  Now get the user data
        $clientData = getClient($clientEmail);

        // Now verify the passwords match
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);

        if (!$hashCheck) {
            $message = '<p class="errorMessage">Please enter a valid password</p>';
            include '../view/login.php';
            exit;
        }

        // If their login information is good, store some of it in the session data
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the session data
        array_pop($clientData);

        // Now store the rest in the session array
        $_SESSION['clientData'] = $clientData;

        $cookie_name = 'firstname';
        // Remove cookie
        setcookie($cookie_name,'scotty' , 1, '/');
            unset($_COOKIE[$cookie_name]);

        include '../view/admin.php';
        break;
    
        case 'register':

        // Save the data to variables
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        
        // Validate password & email 
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Now check for any missing form data
        if(empty($clientFirstname)|| empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
            include '../view/register.php';
            exit;
        }

        // Check if the email address exists in the database already
        $doesEmailExist = checkExistingEmail($clientEmail);

        if ($doesEmailExist == 1) {
            $message = '<p class="errorMessage">That email address already exists.  Do you need to log in instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Encrypt the password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // If data is all there, then insert it into the database
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check the result of the insert statement
        if($regOutcome === 1) {
            $cookie_name = 'firstname';
            setcookie($cookie_name, $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p>Thanks for registering $clientFirstname.  Please use your email and password to login.</p>";
            include '../view/login.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

   
        case 'logout':

            if ($_SESSION['loggedin'] == TRUE && isset($_SESSION['clientData'])) {
                $isLoggedIn = 'Yes';

                $cookie_name = 'firstname';
            $name = $_SESSION['clientData']['clientFirstname'];

            setcookie($cookie_name,$name , 1, '/');
            unset($_COOKIE[$cookie_name]);
            } else {
                $isLoggedIn = 'No';
            }
     
            
            $_SESSION = array();
            
            $_SESSION['loggedin'] = FALSE;

            // Destroy the session
            session_destroy();
            
            include '../view/login.php';

        break;

    // For requests coming from admin.php
    case 'updateAccount':
        // include_once('../common/header.php');
        // include_once('../common/nav.php');

        // Send them to the correct page to update their info
        include '../view/client-update.php';
        break;

    // For handling form submissions from the client-update.php page to update the client details
    case 'updateAccountDetails':
        // include_once('../common/header.php');
        // include_once('../common/nav.php');

        // var_dump($_POST);

        // Save the user input
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);

        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);


        // Validate the email
        //$clientEmail = checkEmail($clientEmail);

        // Now check for any missing form data
        if(empty($clientFirstname)|| empty($clientLastname) || empty($clientEmail)) {
            $message = '<p class="errorMessage">Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        // If data is all there, then insert it into the database
        $regOutcome = updateClientInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check the result of the insert statement
        if($regOutcome === 1) {
            $_SESSION['clientData']['clientFirstname'] = $clientFirstname;
            $_SESSION['clientData']['clientLastname'] = $clientLastname;
            $_SESSION['clientData']['clientEmail'] = $clientEmail;
            $message = "<p>Your account information has been changed, $clientFirstname.</p>";
            include '../view/admin.php';
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but we failed to modify your account info. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

        break;

    // For handling form submissions from the client-update.php page to update the password
    case 'updateAccountPassword':
        // include_once('../common/header.php');
        // include_once('../common/nav.php');
        // For testing incoming data
        // var_dump($_POST); 

        // Save the user input
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);

        // Validate password to make sure it is up to spec
        $checkPassword = checkPassword($clientPassword);

        if($checkPassword == 0) {
            $message2 = '<p class="errorMessage">Sorry ' . $_SESSION['clientData']['clientFirstname'] . ", your password is invalid.  Please make sure it follows the pattern above</p>";
            include '../view/client-update.php';
            exit;
        } else {
            // Encrypt the password
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

            // If data is all there, then insert it into the database
            $regOutcome = updateClientPassword($hashedPassword, $clientId);

            // Check the result of the insert statement
            if($regOutcome === 1) {
                $message = '<p class="errorMessage">Your password has been changed successfully</p>';
                include '../view/admin.php';
                exit;
            } else {
                $message = '<p class="errorMessage">Sorry ' . $_SESSION['clientData']['clientFirstname'] . ", but we failed to modify your password. Please try again.</p>";
                include '../view/client-update.php';
                exit;
            }
        }

        
    default:

        header ("Location: ../index.php");
    
 }

?>