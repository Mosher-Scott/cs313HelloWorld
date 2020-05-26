<?php

// Find all users
function getAllUsers() {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name FROM public.user';
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

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name FROM public.user WHERE id = :id';
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

        $sql = 'SELECT id, first_name, last_name, billing_address, billing_city, billing_state, billing_zip, billing_phone, email, display_name FROM public.user WHERE email = :email';
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

// Update user details
function updateUserDetails($id, $firstName, $lastName, $email, $phone, $street, $city, $stateInfo, $zipcode, $displayName) {
    try {
        $db = DbConnection();

        $sql = 'UPDATE public.user SET first_name = :firstName, last_name = :lastName, billing_address = :street, billing_city = :city, billing_state = :stateInfo, billing_zip = :zipcode, billing_phone = :phone, email = :email, display_name = :displayName WHERE id = :id';

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
?>