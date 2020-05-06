<?php
// Contains the sql CRUD queries for products

// Add a new category to the database
function addCategory($catName) {
    $db = acmeConnect();

    $sql = 'INSERT INTO categories(categoryName) VALUES (:catName)';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':catName', $catName, PDO::PARAM_STR);

    $stmt -> execute();

    // Check the number of rows that were changed
    $rowsChanged = $stmt->rowCount();

    $stmt -> closeCursor();

    return $rowsChanged;

}

// Add a new inventory product to the database
function addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $categoryId, $invVendor, $invStyle) {

    $db = acmeConnect();

    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, categoryId, invVendor, invStyle) VALUES (:invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation, :categoryId, :invVendor, :invStyle)';

    $stmt = $db->prepare($sql);

    if (!$stmt->bindValue(':invName', $invName, PDO::PARAM_STR)) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);

    $stmt -> execute();

    // Check the number of rows that were changed
    $rowsChanged = $stmt->rowCount();

    $stmt -> closeCursor();

    return $rowsChanged;
}


// Returns all items from the inventory table based on a specified Inventory Item ID
function getProductInfo($invId) {
    $db = acmeConnect();

    $sql = 'SELECT * FROM inventory WHERE invId = :invId';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt -> execute();
    $prodInfo = $stmt ->fetch(PDO::FETCH_ASSOC);

    $stmt -> closeCursor();

    return $prodInfo;
}

// Update a specific product in the database
function updateProduct($invName, $invDescription, $invImg, $invThumb, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $catType, $invVendor, $invStyle, $invId) {
 // Create a connection
 $db = acmeConnect();
 // The SQL statement to be used with the database
 $sql = 'UPDATE inventory SET invName = :invName, 
  invDescription = :invDescription, invImage = :invImg, 
  invThumbnail = :invThumb, invPrice = :invPrice, 
  invStock = :invStock, invSize = :invSize, 
  invWeight = :invWeight, invLocation = :invLocation, 
  categoryId = :catType, invVendor = :invVendor, 
  invStyle = :invStyle WHERE invId = :invId';

 $stmt = $db->prepare($sql);

 $stmt->bindValue(':catType', $catType, PDO::PARAM_INT);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImg', $invImg, PDO::PARAM_STR);
 $stmt->bindValue(':invThumb', $invThumb, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $rowsChanged = $stmt->rowCount();

 $stmt->closeCursor();
 
 return $rowsChanged;
}

// For deleting items from the database based on the item ID (invId)
function deleteProduct($invId) {
    // Create a connection
    $db = acmeConnect();

    // Use this for testing. Will return 1 if successfull
    // $sql = 'SELECT * FROM inventory WHERE invId = :invId';

    $sql = 'DELETE FROM inventory WHERE invId = :invId';

    $sql2 = "SELECT * FROM inventory WHERE invId = $invId";

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
   
    $stmt->closeCursor();
    
    return $rowsChanged;
   }

   // For finding products based on category
   function getProductsByCategory($categoryName) {
       $db = acmeConnect();

       $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';

       $stmt = $db -> prepare($sql);
       $stmt -> bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
       $stmt -> execute();

       $products = $stmt -> fetchAll(PDO::FETCH_ASSOC);
       $stmt -> closeCursor();

       return $products;
   }

   // Get products by categoryId 
function getProductsByCategoryForDropdown($categoryId){ 
    $db = acmeConnect(); 
    $sql = ' SELECT * FROM inventory WHERE categoryId = :categoryId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $products; 
   }

   // Get basic product information
   function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}

?>