<?php

// Find all users
function getAllUsers() {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name, user_role FROM public.user';
        $stmt = $db -> prepare($sql);
        $stmt -> execute();
    
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Get details for a single user by ID
function getSingleUserDetails($id) {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name, user_role FROM public.user WHERE id = :id';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':id', $id, PDO::PARAM_INT);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Get details for a single user
function getSingleUserDetailsByEmail($email) {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name, user_role FROM public.user WHERE email = :email';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Gets just the password to check for user login
function getPasswordWithEmail($email) {
    try {

        $db = DbConnection();

        $sql = 'SELECT password FROM public.user WHERE email = :email';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Checks to see if an email already exists in the database
function checkExistingEmail($email) {
    try {

        $db = DbConnection();

        $sql = 'SELECT email FROM public.user WHERE email = :email';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Checks to see if a display name already exists in the database
function checkExistingDisplayName($name) {
    try {

        $db = DbConnection();

        $sql = 'SELECT display_name FROM public.user WHERE display_name = :name';
        $stmt = $db -> prepare($sql);
        $stmt-> bindValue(':name', $name, PDO::PARAM_STR);
        $stmt -> execute();
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}

// Update user details
function updateUserDetails($id, $firstName, $lastName, $email, $phone, $street, $city, $stateInfo, $zipcode, $displayName, $user_role) {
    try {
        $db = DbConnection();

        $sql = 'UPDATE public.user SET first_name = :firstName, last_name = :lastName, billing_address = :street, billing_city = :city, billing_state = :stateInfo, billing_zip = :zipcode, billing_phone = :phone, email = :email, display_name = :displayName, user_role = :user_role WHERE id = :id';

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':street', $street, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':stateInfo', $stateInfo, PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $zipcode, PDO::PARAM_INT);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':displayName', $displayName, PDO::PARAM_STR);
        $stmt->bindValue(':user_role', $user_role, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt -> execute();

        // See if any rows changed
        $rowsChanged = $stmt->rowCount();

        $stmt->closeCursor();

        return $rowsChanged;

    } catch (Exception $ex) {
        return "error";
    }
}

// Adds a new customer to the database.  Keeps the user_role as customer
function registerNewUser($firstName, $lastName, $email, $phone, $street, $city, $stateInfo, $zipcode, $displayName, $password, $userRole='customer') {

    try {
        $db = DbConnection();

        $sql = 'INSERT INTO public.user (first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name, password, user_role) VALUES (:firstName, :lastName, :street, :city, :stateInfo, :zipcode, :phone, :email, :displayName, :password, :userRole)';

        $stmt = $db->prepare($sql);

        $stmt->bindValue(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindValue(':street', $street, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':stateInfo', $stateInfo, PDO::PARAM_STR);
        $stmt->bindValue(':zipcode', $zipcode, PDO::PARAM_INT);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':displayName', $displayName, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);
        $stmt->bindValue(':userRole', $userRole, PDO::PARAM_STR);

        $stmt -> execute();

        // See if any rows changed
        $rowsChanged = $stmt->rowCount();

        $stmt->closeCursor();

        return $rowsChanged;

    } catch (Exception $ex) {
        return "error";
    }

}

// Delete a user
function deleteUser($id) {
    $db = DbConnection();

    $sql = 'DELETE FROM public.user WHERE id = :id';

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
   
    $stmt->closeCursor();
    
    return $rowsChanged;
}

?>