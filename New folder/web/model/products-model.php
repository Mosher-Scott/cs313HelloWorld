<?php

// Find all products
function getAllProducts() {
    $db = DbConnection();

    $sql = 'SELECT * FROM public.product';

    $stmt = $db -> prepare($sql);
    $stmt -> execute();

    $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $products;
}

function getSingleProduct($id) {
    $db = DbConnection();

    //$sql = 'SELECT name, price FROM public.product WHERE id = :id';
    $sql = 'SELECT * FROM public.product WHERE id = :id';

    $stmt = $db->prepare($sql);
    $stmt-> bindValue(':id', $id, PDO::PARAM_INT);
    $stmt-> execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $items;
}


?>