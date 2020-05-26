<?php

function getShipMethods() {

    try {

        $db = DbConnection();

        $sql = 'SELECT id, method, rate FROM ship_method';
        $stmt = $db -> prepare($sql);
        $stmt -> execute();
    
        $methods = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $methods;
    } catch (Exception $ex) {
        return "error";
    }
   
}


?>