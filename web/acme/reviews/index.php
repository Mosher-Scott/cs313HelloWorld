<?php

// Reviews controller


// Start the session, if it hasn't already
session_start();

require_once('../common/initialize.php');
require_once('../library/connections.php');
require_once('../model/acme-model.php');
require_once('../model/accounts-model.php');
include_once('../library/functions.php');
include_once('../model/reviews-model.php');

$action = isset($_POST['pageType']) ? $_POST['pageType'] : NULL;

if ($action == NULL) {
    $action = filter_input(INPUT_GET,'pageType');
}

switch ($action) {
    case 'reviewSubmitted':

        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);

        // Check if it is empty.  This needs work
        if (empty($reviewText)) {
            $message2 = '<p class="errorMessage">Please fill out the review field.</p>';
            $path = "../products/?action=viewProduct&productId=$invId&errorMessage=$message2";

            header ("Location: $path");
            exit;
        }
        
        $reviewInserted = insertNewReview($clientId, $invId, $reviewText);
       
        if ($reviewInserted === 1) {
            $message2 = '<p class="errorMessage">Review successfully added.</p>';
            $path = "../products/?action=viewProduct&productId=$invId&errorMessage=$message2";

            include "../products/?action=viewProduct&productId=$invId&errorMessage=$message2";
        } else {
            $message2 = '<p class="errorMessage">Sorry, we were unable to add your review.</p>';
            $path = "../products/?action=viewProduct&productId=$invId&errorMessage=$message2";

            include "../products/?action=viewProduct&productId=$invId&errorMessage=$message2";
        }
        // TODO: Add the correct redirect for this.  For now, send them to the home page
        header ("Location: ../products/?action=viewProduct&productId=$invId");

    break;

    case 'userWantsToEditReview':
        // Get first/last names to create the usernames
        $userName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];

        $clientId = $_SESSION['clientData']['clientId'];

        // Get the review number
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        // Get everything from the review so it can be updated
        $reviewText = getReviewText($reviewId);
        
        include '../view/review-update.php';

    break;

    case 'updateReview':
        //var_dump($_POST);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        // Get first/last names to create the usernames
        $userName = substr($_SESSION['clientData']['clientFirstname'], 0, 1) . $_SESSION['clientData']['clientLastname'];

        $clientId = $_SESSION['clientData']['clientId'];
        
        // Check if it is empty.  This needs work
        if (empty($reviewText)) {
            $message = '<p class="errorMessage">ERROR: Review field cannot be blank.</p>';
            //$path = "../reviews?pageType=userWantsToEditReview&reviewId=$singleReview[reviewId]&errorMessage=$message2";

            include '../view/review-update.php';
            exit;
        }

        // If not empty, run the query to update the database
        $result = updateReview($reviewId, $reviewText);

        echo $result;
        if ($result === 1) {
            $reviewEditMessage = '<p id="emptyReviewMessage">Your review was successfully updated.</p>';
            $_SESSION['reviewEditMessage'] = $reviewEditMessage;

            include '../view/admin.php';
     
        } else {
            $reviewEditMessage = '<p id="emptyReviewMessage">Something went wrong and we could not update your review.</p>';
            $_SESSION['reviewEditMessage'] = $reviewEditMessage;
            include '../view/admin.php';
            exit;
        }
        
    break;

    // This page shows up when the user clicks the "Delete" button
    case 'confirmDeleteReview':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        include '../view/review-delete.php';
    break;

    // If they confirm deleting the review, then this will be called
    case 'deleteReview':

        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $result = deleteReview($reviewId);


        if ($result === 1) {
            $reviewEditMessage = '<p id="emptyReviewMessage">Your review was successfully deleted.</p>';
            $_SESSION['reviewEditMessage'] = $reviewEditMessage;

            include '../view/admin.php';
     
        } else {
            $reviewEditMessage = '<p id="emptyReviewMessage">Something went wrong and we could not update your review.</p>';
            $_SESSION['reviewEditMessage'] = $reviewEditMessage;
            include '../view/admin.php';
            exit;
        }

    break;

    default:
        var_dump($_POST);
        echo "<h1>DEFAULTED</h1>";

        if ($_SESSION['loggedin'] == TRUE && isset($_SESSION['clientData'])) {
            // TODO: Deliver admin view if logged in
        } else {
            // Send them to home page
            header ("Location: ../index.php");
        }
    
 }

?>