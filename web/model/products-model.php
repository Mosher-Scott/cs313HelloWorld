<?php

// Find all products
function getAllProducts() {

    try {

        $db = DbConnection();

        $sql = 'SELECT * FROM public.product';
        $stmt = $db -> prepare($sql);
        $stmt -> execute();
    
        $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        $stmt -> closeCursor();
    
        return $products;
    } catch (Exception $ex) {
        return "error";
    }
   
}

// Searches for a product based on the ID
function getSingleProduct($id) {
    $db = DbConnection();

    $sql = 'SELECT * FROM public.product WHERE id = :id';

    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':id', $id, PDO::PARAM_INT);
    $stmt-> execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $items;
}

// Searches for a product based on a partial name
function searchByPartialProductName($text) {
    $db = DbConnection();

    $sql = 'SELECT * FROM public.product WHERE name ILIKE :text';

    // Add the % % for a wildcard search
    $text = "%{$text}%";

    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':text', $text, PDO::PARAM_STR);
    $stmt-> execute();

    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $items;
}


?>