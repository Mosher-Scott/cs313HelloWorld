<?php

// Add images to the database
// Add image information to the database table
function storeImages($imgPath, $invId, $imgName) {
    $db = acmeConnect();
    $sql = 'INSERT INTO images (invId, imgPath, imgName) VALUES (:invId, :imgPath, :imgName)';
    $stmt = $db->prepare($sql);
    // Store the full size image information
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->execute();
        
    // Make and store the thumbnail image information
    // Change name in path
    $imgPath = makeThumbnailName($imgPath);
    // Change name in file name
    $imgName = makeThumbnailName($imgName);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->execute();
    
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
   }

// Get all the images in the database
function getImages() {
    $db = acmeConnect();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invName FROM images JOIN inventory on images.invId = inventory.invId';

    $stmt = $db -> prepare($sql);
    $stmt -> execute();

    $imageArray = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $imageArray;
}

// For deleting image references in the database
function deleteImage($id) {
    $db = acmeConnect();

    $sql = 'DELETE FROM images WHERE imgId = :imgId';

    $stmt = $db -> prepare($sql);

    $stmt -> bindValue(':imgId', $id, PDO::PARAM_INT);
    $stmt -> execute();

    $result = $stmt->rowCount();
    $stmt -> closeCursor();

    return $result;
}

// For checking to see if an image already exists in the database
function checkExistingImage($imgName) {
    $db = acmeConnect();

    $sql = "SELECT imgName FROM images WHERE imgName = :name";

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':name', $imgName, PDO::PARAM_STR);

    $stmt -> execute();

    $imageMatch = $stmt -> fetch();

    $stmt -> closeCursor();

    return $imageMatch;
}

?>
