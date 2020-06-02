<?php

// Validate Data
function validateInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// When trying this live, it won't be needed since it is already in the other file
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

// Adds a new user to the database.  Keeps the user_role as customer
function registerNewUser($userName, $password) {

    try {
        $db = DbConnection();

        // TODO: Modify this to have the correct table name
        $sql = 'INSERT INTO public.userInfo (userName, password) VALUES (:userName, :password)';

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        
        $stmt -> execute();

        // See if any rows changed
        $rowsChanged = $stmt->rowCount();

        $stmt->closeCursor();

        return $rowsChanged;

    } catch (Exception $ex) {
        return "error";
    }
}

// Get the password for the selected username
function getPasswordWithUserName($userName) {
    try {

        $db = DbConnection();

        $sql = 'SELECT password FROM public.user WHERE userName = :userName';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':userName', $userName, PDO::PARAM_STR);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Creates a simple sign up form.  Leave $userName as an optional parameter.  Then if a failure happens, you can display the userName
function signUpForm($actionValue, $userName = '') {
    echo "<form action= ' ' method='post' class=form-horizontal>";

    echo "<div class='form-inline'>";
        echo "<label for='userNameInput' class='control-label col-sm-1'>User Name:</label>";
        echo "<input type='text' name='userName' id='userNameInput' class='form-control' placeholder='Enter UserName' value='{$userName}'>";
    echo "</div>";

    echo "<div class='form-inline'>";
        echo "<label for='passwordInput' class='control-label col-sm-1'>Password:</label>";
        echo "<input type='password' name='password' id='passwordInput' class='form-control' placeholder='Enter password' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'>";
        
        echo "<div>";
        echo "<small id='passwordInputHelp' class='form-text text-muted'>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>";
        echo "</div>";
    echo "</div>";

    // By using a variable for the value, we could use the same form for multiple purposes
    echo "<input type='hidden' name='action' class='form-control' value='{$actionValue}'>";
    echo "<input type='submit' class='btn btn-primary' value='Register'>";


    echo "</form>";
}

function signUpFormDoublePassword($actionValue, $userName = '') {
    echo "<form action= ' ' method='post' class=form-horizontal>";

    echo "<div class='form-inline'>";
        echo "<label for='userNameInput' class='control-label col-sm-1'>User Name:</label>";
        echo "<input type='text' name='userName' id='userNameInput' class='form-control' placeholder='Enter UserName' value='{$userName}'>";
    echo "</div>";

    echo "<div class='form-inline'>";
        echo "<label for='passwordInput' class='control-label col-sm-1'>Password:</label>";
        echo "<input type='password' name='password' id='passwordInput' class='form-control' placeholder='Enter password' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}'><span id='errorThing' class='hidden'>*</span>";
        
        echo "<div>";
        echo "<small id='passwordInputHelp' class='form-text text-muted'>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>";
        echo "</div>";
    echo "</div>";

    // 2nd password input form
    echo "<div class='form-inline'>";
        echo "<label for='passwordConfirmationInput' class='control-label col-sm-1'>Password:</label>";
        echo "<input type='password' name='password' id='passwordConfirmationInput' class='form-control' placeholder='Enter password' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' onkeyup='checkPassword()'>";
    
        echo "<div>";
            echo "<small id='passwordInputHelp' class='form-text text-muted'>Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</small>";
        echo "</div>";
    echo "</div>";
    

    // By using a variable for the value, we could use the same form for multiple purposes
    echo "<input type='hidden' name='action' class='form-control' value='{$actionValue}' onchange='checkPassword()>";
    echo "<span id='passwordCheck'></span>";
    echo "<input type='submit' class='btn btn-primary' value='Register'>";


    echo "</form>";
}

// For synchronous requests to check if the two fields match

?>