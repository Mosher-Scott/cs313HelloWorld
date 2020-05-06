<?php
// Accounts model for site visitors

// This will handle site registrations
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    $db = acmeConnect();

    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

    $stmt = $db->prepare($sql);

    // Now use these to replace the values in the placeholders
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    
    // Insert the data
    $stmt->execute();

    // Check the number of rows that were changed
    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;
}

// Check database for existing email address
function checkExistingEmail($clientEmail) {
    $db = acmeConnect();

    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':email', $clientEmail, PDO::PARAM_STR);

    $stmt -> execute();

    $matchFound = $stmt -> fetch(PDO::FETCH_NUM);

    $stmt->closeCursor();

    if(empty($matchFound)){
        return 0;
    } else {
        return 1;
    }
}

// Get info on client based on email
function getClient($clientEmail) {
    $db = acmeConnect();

    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':email', $clientEmail, PDO::PARAM_STR);

    $stmt -> execute();

    // We only want to see one result, so use fetch. Using FETCH_ASSOC we get a name/value pair to work with
    $clientData = $stmt -> fetch(PDO::FETCH_ASSOC);

    $stmt -> closeCursor();

    return $clientData;
}

function updateClientInfo($clientFirstname, $clientLastname, $clientEmail, $clientId) {
    $db = acmeConnect();

    $sql = 'UPDATE clients SET clientFirstname = :clientFirstname,  clientLastname = :clientLastname,clientEmail = :clientEmail WHERE clientId = :clientId';

    $stmt = $db->prepare($sql);

    // Now use these to replace the values in the placeholders
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();

    // Check the number of rows that were changed
    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;
}

function updateClientPassword($clientPassword, $clientId) {
    $db = acmeConnect();

    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';

    $stmt = $db->prepare($sql);

    // Now use these to replace the values in the placeholders
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    
    // Insert the data
    $stmt->execute();

    // Check the number of rows that were changed
    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;
}
?>