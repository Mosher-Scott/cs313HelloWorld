<?php

// Creates a dropdown with IDs
function createIdForm($ids){
    echo "<form action=''>";
    echo "<select name='Ids' onchange='showCustomer(this.value)>";
    echo "<option value=''>Choose ID</option>";
    foreach($ids as $id) {
        echo "<option value='{$id['id']}'>{$id['display_name']}</option>";
    }
    echo "</select>";

    echo "</form>";

}


// Connects to DB and gets the ID of all users
function getAllUserIdsAndDisplayName() {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, display_name FROM public.user';
        $stmt = $db -> prepare($sql);
        $stmt -> execute();
    
        $users = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $users;
    } catch (Exception $ex) {
        return "error";
    }
}



?>