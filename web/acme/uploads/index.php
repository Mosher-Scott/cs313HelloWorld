<?php
// Image uploads controller

if (!isset($_SESSION)) {
    session_start();
}

require_once('../library/connections.php');
require_once('../model/acme-model.php');
require_once('../model/products-model.php');
include_once('../library/functions.php');
include_once('../model/uploads-model.php');

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
 $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

// Now create some variables to hold upload values, so we can change them later

// Image upload location
$image_dir = '/acme/uploads/images';

// Full path of server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;

$_SESSION['images'] = "imageEdit";

switch ($action) {

    case 'upload':

        // Store the incoming product id
        $invId = filter_input(INPUT_POST, 'invId', FILTER_VALIDATE_INT);
        
        // Store the name of the uploaded image
        $imgName = $_FILES['file1']['name'];
            
        $imageCheck = checkExistingImage($imgName);

            
        if($imageCheck){
        $message = '<p class="errorMessage">An image by that name already exists.</p>';
        } elseif (empty($invId) || empty($imgName)) {
        $message = '<p class="errorMessage">You must select a product and image file for the product.</p>';
        } else {
            // Upload the image, store the returned path to the file
            $imgPath = uploadFile('file1');
                
            // Insert the image information to the database, get the result
            $result = storeImages($imgPath, $invId, $imgName);
            echo $result;    
            // Set a message based on the insert result
            if ($result) {
            $message = '<p class="errorMessage">The upload succeeded.</p>';
            } else {
            $message = '<p class="errorMessage">Sorry, the upload failed.</p>';
            }
        }

        // Store message to session
        $_SESSION['message'] = $message;
            
        // Redirect to this controller for default action
        header('location: .');

        //
        //break;

    case 'delete':
        //include_once('../common/header.php');
        // sinclude_once('../common/nav.php');
        
        // Get the image name and id
        $filename = filter_input(INPUT_GET, 'filename', FILTER_SANITIZE_STRING);
        $imgId = filter_input(INPUT_GET, 'imgId', FILTER_VALIDATE_INT);

        // Build the full path to the image to be deleted
        $target = $image_dir_path . '/' . $filename;

        // Check that the file exists in that location
        if (file_exists($target)) {
            // Deletes the file in the folder
            $result = unlink($target); 
            }
                
            // Remove from database only if physical file deleted
            if ($result) {
            $remove = deleteImage($imgId);
            }
                
            // Set a message based on the delete result
            if ($remove) {
            $message = "<p class='errorMessage'>$filename was successfully deleted.</p>";
            } else {
            $message = "<p class='errorMessage'>$filename was NOT deleted.</p>";
            }
                
            // Store message to session
            $_SESSION['message'] = $message;
        
            var_dump($_SESSION);

        // Redirect to this controller
        header('location: .');
        break;

    default:
        include_once('../common/header.php');
        include_once('../common/nav.php');
        
        // Call function to return image info from database
        $imageArray = getImages();
            
        // Build the image information into HTML for display
        if (count($imageArray)) {
        $imageDisplay = buildImageDisplay($imageArray);
        } else {
        $imageDisplay = '<p class="notice">Sorry, no images could be found.</p>';
        }
            
        // Get inventory information from database
        $products = getProductBasics();
        // Build a select list of product information for the view
        $prodSelect = buildProductsSelect($products);
            
        include '../view/image-admin.php';
        exit;
   
}