<?php
// Contains the sql queries for CRUD reviews

// Insert new review
function insertNewReview($clientId, $invId, $reviewText) {
    $db = acmeConnect();

    $sql = 'INSERT INTO reviews(clientId, invId, reviewDate, reviewText) VALUES (:clientId, :invId, now(), :reviewText)';

    $stmt = $db -> prepare($sql);

    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    
    $stmt -> execute();

    // Check the number of rows that were changed
    $rowsChanged = $stmt->rowCount();

    $stmt -> closeCursor();

    return $rowsChanged;
}

// Get all reviews for a specific product
function getReviewsForProduct($invId) {
    $db = acmeConnect();

    // For just selecting reviews, no user information
    // $sql = 'SELECT * FROM reviews WHERE invId = :invId';

    $sql = 'SELECT reviews.clientId, reviews.reviewDate, reviews.reviewText, clients.clientFirstname, clients.clientLastname
    FROM reviews
    INNER JOIN clients ON reviews.clientId = clients.clientId
    WHERE invId = :invId
    ORDER BY reviews.reviewDate DESC';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt -> execute();
    $prodInfo = $stmt ->fetchAll(PDO::FETCH_ASSOC);

    $stmt -> closeCursor();

    return $prodInfo;
}

// Get all reviews by a specific user
function getReviewsByClient($clientId) {

    $db = acmeConnect();
    
    // $sql = 'SELECT * FROM reviews WHERE clientId = :clientId';

    
    // This might work to pull inventory item name also
    $sql = 'SELECT reviews.reviewText, reviews.clientId, reviews.reviewId, inventory.invName
    FROM reviews
    INNER JOIN inventory
    ON reviews.invId = inventory.invId
    WHERE clientId = :clientId';
    

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt -> execute();
    $allReviews = $stmt ->fetchAll(PDO::FETCH_ASSOC);

    $stmt -> closeCursor();

    return $allReviews;

}

// Gets a specific review text
function getReviewText($reviewId) {

    $db = acmeConnect();

    $sql = 'SELECT reviewText FROM reviews WHERE reviewId = :reviewId';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt -> execute();
    $allReviews = $stmt ->fetch(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $allReviews['reviewText'];
}

// Get all the information from a specific review
function getSpecificReview($reviewId) {

    $db = acmeConnect();

    $sql = 'SELECT reviews.reviewText, reviews.clientId, reviews.reviewId, inventory.invName
    FROM reviews
    INNER JOIN inventory
    ON reviews.invId = inventory.invId
    WHERE reviewId = :reviewId';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt -> execute();
    $allReviews = $stmt ->fetch(PDO::FETCH_ASSOC);
    $stmt -> closeCursor();

    return $allReviews;
}

// Has the person reviewed this product already?
function hasReviewedProduct($clientId, $invId) {

    $db = acmeConnect();

    $sql = 'SELECT * FROM reviews WHERE invId = :invId AND clientId = :clientId';

    $stmt = $db -> prepare($sql);
    $stmt -> bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt -> bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt -> execute();
    $hasReviewed = $stmt ->fetchAll(PDO::FETCH_ASSOC);

    $rows = $stmt->rowCount();
    $stmt -> closeCursor();
    var_dump($hasReviewed);
    return $hasReviewed;
}

// Update a specific review
function updateReview($reviewId, $reviewText) {

    $db = acmeConnect();

    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewid = :reviewId';
    //$sql2 = "UPDATE reviews SET reviewText = $reviewText WHERE reviewId = $reviewId";

    $stmt = $db->prepare($sql);
    
    //$stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();
    
    return $rowsChanged;
}

// Delete a review
function deleteReview($reviewId) {

    $db = acmeConnect();

    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';

    $sql2 = "SELECT * FROM reviews WHERE reviewId = :reviewId";

    $stmt = $db->prepare($sql);
   
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
   
    $stmt->closeCursor();
    
    return $rowsChanged;
}


?>