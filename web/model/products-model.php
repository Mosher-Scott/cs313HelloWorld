<?php

// Find all products
function GetAllProducts() {
    $db = DbConnection();

    $sql = 'SELECT * FROM public.product';

    $stmt = $db -> prepare($sql);
    $stmt -> execute();

    $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $products;
}

?>