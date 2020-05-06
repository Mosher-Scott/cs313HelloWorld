<?php
// Start the session, if it hasn't already
session_start();

require_once('../library/connections.php');
require_once('../model/acme-model.php');
require_once('../model/products-model.php');
require_once('../common/initialize.php');
include_once('../library/functions.php');
include_once('../model/reviews-model.php');


$action = isset($_POST['action']) ? $_POST['action'] : NULL;

if ($action == NULL) {
    $action = filter_input(INPUT_GET,'action');
 }

 switch($action) {

    case 'newCategory':
        include_once('../common/header.php');
        include_once('../common/nav.php');
        include '../view/addNewCategory.php';
        exit;

    case 'addNewCategory':
        // include_once('../common/header.php');
        // include_once('../common/nav.php');
        
        // TODO: Save post data to variables
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        // TODO: Check for missing data.  If there is, then display error message
        if(empty($categoryName)) {
            $message = '<p class="errorMessage">Please enter in a category name.</p>';
            include '../view/addNewCategory.php';
            exit;
        }

        // Insert data into the database 
    
        $outcome = addCategory($categoryName);

        // See if the insert statement was successfull
        if($outcome === 1) {
            header('Location: index.php?action=""');
            exit;
        } else {
            $message = "<p>Sorry, but $categoryName, was not added successfully. Please try again.</p>";
            include '../view/addNewCategory.php';
            exit;
        }

    case 'newProduct':
        include_once('../common/header.php');
        include_once('../common/nav.php');
        include '../view/addNewProduct.php';
        exit;

    case 'addNewProduct':
        include_once('../common/header.php');
        include_once('../common/nav.php');

        // Save form data to variables
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImg = filter_input(INPUT_POST, 'invImg', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invCategory = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        
        // Check for empty values.  Display error message if there are
        if(empty($invName) || empty($invDescription) || empty($invImg) || empty($invThumbnail) || empty($invPrice) ||empty($invStock) || empty($invSize) || empty($invWeight) ||empty($invLocation) || empty($invCategory) || empty($invVendor) || empty($invStyle)) {
            $message = '<p class="errorMessage">Please fill out all fields.</p>';
            include '../view/addNewProduct.php';
            exit;
        }

        $outcome = addProduct($invName, $invDescription, $invImg, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invCategory, $invVendor, $invStyle);

        // Check the response
        if ($outcome === 1) {
            header('Location: index.php?action="newProduct"');
            exit;
        } else {
            $message = '<p class="errorMessage">Sorry, we could not add ' . $invName . ' to the database.  Please try again. </p>';
            include '../view/addNewProduct.php';
            exit;
        }

    /* Get inventory items based on categoryId to be used in other statements/functions */
    case 'getInventoryItems':
        // Get the category ID
        $categoryId = filter_input(INPUT_GET, 'categoryId', FILTER_SANITIZE_NUMBER_INT);

        // Now call the function to get inventory items with that category Id
        //$productsArray = getProductsByCategory($categoryId);
        $productsArray = getProductsByCategoryForDropdown($categoryId);
        // Turn the results into a JSON object, and sends it back to the view
        //var_dump($productsArray);
        echo json_encode($productsArray);
        break;

    case 'mod':
        include_once('../common/header.php');
        include_once('../common/nav.php');

        // Get the inventory item ID
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Run the query to get the info from the database
        $prodInfo = getProductInfo($invId);

        // Check if there is info or not
        if(count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found';
        }
        include '../view/prod-update.php';
        exit;
        break;

    case 'updateProd':
        include_once('../common/header.php');
        include_once('../common/nav.php');
        //var_dump($_POST);

        // Save form data to variables
        $catType = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImg = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $invCategory = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        // Check for empty values.  Display error message if there are
        if(empty($invName) || empty($invDescription) || empty($invImg) || empty($invThumbnail) || empty($invPrice) ||empty($invStock) || empty($invSize) || empty($invWeight) ||empty($invLocation) || empty($invCategory) || empty($invVendor) || empty($invStyle)) {
            $message = '<p class="errorMessage">Something is missing. Please fill out all fields.</p>';
            include '../view/prod-update.php';
            exit;
        }

        $updateResult = updateProduct($invName, $invDescription, $invImg, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invCategory, $invVendor, $invStyle, $invId);

        // Check the response
        if ($updateResult === 1) {
            $message = "Product $invName was successfully updated";
            $_SESSION['message'] = $message;
            header('Location: /acme/products');
            exit;
        } else {
            $message = '<p class="errorMessage">Sorry, we could not update ' . $invName . '.  Please try again. </p>';
            include '../view/prod-update.php';
            exit;
        }

    case 'del':

        include_once('../common/header.php');
        include_once('../common/nav.php');

        // Get the inventory item ID
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        // Run the query to get the info from the database
        $prodInfo = getProductInfo($invId);

         // Check if there is info or not
        if(count($prodInfo) < 1) {
        $message = 'Sorry, no product information could be found';
        }

        include '../view/prod-delete.php';
        break;

    case 'deleteProd':
        include_once('../common/header.php');
        include_once('../common/nav.php');

        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($invId);

        // Check the response
        if ($deleteResult === 1) {
            $message = "Product $invName was successfully deleted";
            $_SESSION['message'] = $message;
            header('Location: /acme/products');
            exit;
        } else {
            $message = '<p class="errorMessage">Sorry, we could not delete ' . $invName . '.  Please try again. </p>';
            $_SESSION['message'] = $message;
            header('Location: /acme/products');
            exit;
        }
        break;

    # For when a user picks a specific category from the nav menu
    case 'category':

        include_once('../common/header.php');
        include_once('../common/nav.php');

        $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($categoryName);

        if (!count($products)) {
            $message = "<p class='errorMessage'>Sorry, but we could not find any $categoryName products.<p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        
   
        include '../view/category.php';
    break;

    case 'viewProduct':

        $errorMessage = filter_input(INPUT_GET, 'errorMessage', FILTER_SANITIZE_STRING);

        $productId = filter_input(INPUT_GET, 'productId', FILTER_SANITIZE_NUMBER_INT);
        $productInfo = getProductInfo($productId);

        $productName = $productInfo['invName'];

        $productDisplay = buildProductDetails($productInfo);

        $reviewDisplay = createReviewDisplay($productInfo['invId']);

        include_once('../common/header.php');
        include_once('../common/nav.php');

        include '../view/product-detail.php';

        break;

    // In case nothing else matches
    default:
        include_once('../common/header.php');
        include_once('../common/nav.php');

        // Even though enhancement 7 calls it buildCategoryList, I already had it created in a previous enhancement
        $categoryList = createCategoryDropdown($categories);
        $categories = createCategoryDropdown($categories);

        include '../view/productManagement.php';
        exit;
 }
?>