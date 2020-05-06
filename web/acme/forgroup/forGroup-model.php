<?php
// Get data from the inventory table
function getInventoryData() {
    
    // Create the connection the database, using this function
    $db = acmeConnect();

    // Create the sql statement for selecting everything in the inventory table
    $sql = 'SELECT * FROM inventory';

    $stmt = $db->prepare($sql);

    $stmt -> execute();

    $inventoryItems = $stmt -> fetchAll();

    $stmt -> closeCursor();

    return $inventoryItems;

}


?>