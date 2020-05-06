<?php

// Check if the email is valid
function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

// Check if the password is valid
function checkPassword($clientPassword) {
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
    return preg_match($pattern, $clientPassword);
}

// Create the navigation list for the site
function createNavMenu($categories) {

    // Build the nav list
    $navList = '<ul>';
    $navList .= "<li><a href='/acme/' title='View the Acme home page'>Home</a></li>";
 foreach($categories as $category){
    $navList .= "<li>
    <a href='/acme/products/?action=category&categoryName=". urlencode($category['categoryName']) ."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
 }
    $navList .= '</ul>';

    return $navList;
}

function buildCategoryList($categories){ 
    $catList = '<select name="categoryId" id="categoryList">'; 
    $catList .= "<option>Choose a Category</option>"; 
    foreach ($categories as $category) { 
     $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>"; 
    } 
    $catList .= '</select>'; 
    return $catList; 
   }

// Create the category dropdown for different site sections.  Also used
function createCategoryDropdown($categories) {

    // Now build the category dropdown
    $categoryList = '<select id="CategoryId" class="categoryDropdownList" name="invCategory">';

    $categoryList .= '<option selected="selected" disabled="disabled">Pick a Category</option>';

    foreach($categories as $category) {
        $categoryList .= '<option value="' . $category['categoryId'] . '">' . $category['categoryName'] . "</option>";
    }

    $categoryList .= "</select>";

    return $categoryList;
}

// Build the page display for the products
function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
     $pd .= '<li>';
     $pd .= "<a href='/acme/products/?action=viewProduct&productId=$product[invId]'><img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></a>";
     $pd .= '<hr>';
     $pd .= "<h2><a href='/acme/products/?action=viewProduct&productId=$product[invId]'>$product[invName]</a></h2>";
     $pd .= "<span><a href='/acme/products/?action=viewProduct&productId=$product[invId]'>$$product[invPrice]</span>";
     $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
   }

function buildProductDetails($productInfo) {
    $display = "<div id='product-display'>";
    $display .= "<h1>$productInfo[invName]</h1>";
    $display .= "<h3>Manufactured by $productInfo[invVendor]</h3>";
    $display .= "<br>";
    $display .= "<h4 id='findReview'>Product Reviews can be found at the bottom of the page</h4>";
    $display .= "<div id='product'>";
    $display .= "<div id='productImageDiv' class='productDisplayInfo'><img class='productImage' src='$productInfo[invImage]' alt='image of $productInfo[invImage] on acme.com'></div>";
    $display .= "<div id='productDetails' class='productDisplayInfo'>";
    $display .= "<h4>Price</h4>";
    $display .= "<p>$$productInfo[invPrice]</p>";
    $display .= "<br>";
    $display .= "<h4>Available Stock</h4>";
    $display .= "<p>$productInfo[invStock]</p>";
    $display .= "<br>";
    $display .= "<h4>Description</h4>";
    $display .= "<p>$productInfo[invDescription]</p>";
    $display .= "<br>";
    $display .= "<h4>Product Details</h4>";
    $display .= "<ul>";
    $display .= "<li><b>Size:</b> $productInfo[invSize] in</li>";
    $display .= "<li><b>Weight:</b> $productInfo[invWeight] lbs</li>";
    $display .= "<li><b>Style:</b> $productInfo[invStyle]</li>";
    $display .= "</ul>";
    $display .= "<br>";
    $display .= "<button type='submit' class='addToCartButton'>Add to Cart</button>";
    $display .= "</div>"; // End of product details div
    $display .= "</div>"; // End of Product div
    $display .= "</div>"; // End of productDisplay div
    
    return $display;
}

// Creating the display for product reviews
function createReviewDisplay($productId) {
    // TODO: Add in everything to structure customer reviews

    //$productId = $productInfo['invId'];

    $productReviewData = getReviewsForProduct($productId);
    $reviewNumber = 0;

    $reviewsDisplay = "<div id='productReviews' class='reviewDisplay'>";
    //$reviewsDisplay .= "<p>$productId</p>";
        foreach($productReviewData as $reviews) {
            $reviewsDisplay .= "<div id='review$reviewNumber' class='individualReview'>";
            //$reviewsDisplay .= "<p>Customer ID: $reviews[clientId]</p><br>";
            $userName = substr($reviews['clientFirstname'], 0, 1) . $reviews['clientLastname'];
            $reviewsDisplay .= "<p><b>Name:</b> $userName</p>";
            $reviewsDisplay .= "<p><b>Review Date:</b> $reviews[reviewDate]</p>";
            $reviewsDisplay .= "<p><b>Review: </b> $reviews[reviewText]</p>";
            $reviewsDisplay .= "</div>";
            $reviewNumber += 1; 
        }

    $reviewsDisplay .= "</div>";

    return $reviewsDisplay;
}

// Creating the display for product reviews
function createReviewDisplay2($productId) {

    $productReviewData = getReviewsForProduct($productId);
    $reviewNumber = 0;

    $reviewsDisplay = "<div id='productReviews' class='reviewDisplay'>";

    foreach($productReviewData as $reviews) {
        $reviewsDisplay .= "<div id='review$reviewNumber' class='individualReview1s'>";
        $reviewsDisplay .= "<p>$reviews[reviewText]</p>";
        $reviewsDisplay .= "<p><b>Review Date:</b> $reviews[reviewDate]</p>";
        $reviewsDisplay .= "<p><b>Review: </b> $reviews[reviewText]</p>";
        $reviewsDisplay .= "</div>";
    }
    $reviewsDisplay .= "</div>";

    return $reviewsDisplay;

}

// Function for creating the review form for a client to add a new review
function createReviewForm($clientId, $invId, $clientName) {
    
    $form = "<div id='addReviewForm' class='centered'>";
    $form .= "<form action=" . urlPath('reviews/index.php') . " method='post'>";
    $form .= "<label for='review'><h3>$clientName, Add Your Review:</h3></label>";
    //$form .="<br>";
    $form .= "<textarea name='reviewText' cols='50' rows='10'></textarea>";
    $form .= "<input type='hidden' name='clientId' value='$clientId'>";
    $form .= "<input type='hidden' name='invId' value='$invId'>";
    $form .= "<input type='hidden' name='pageType' value='reviewSubmitted'>";
    $form .="<br>";
    $form .="<br>";
    $form .= "<input type='submit' class='submitButton' value='Submit Review'>";
    $form .= "</form>";
    $form .= "</div>";
    $form .= "<hr>";
    return $form;
}

// Create the display for client to see all reviews they've written
function displayAllCustomerReviews($clientId) {
    
    $reviews = getReviewsByClient($clientId);

    // Create the div
    $display = "<div id='clientReviewDiv' class='accountInfoDivDefault'>";

    $display .= "<table class='basicTable1'>";
    // Table headers
    $display .= "<tr>";
    $display .= "<th>Product Reviewed</th>";
    $display .= "<th>Your Review</th>";
    $display .= "<th colspan='2'>Options</th>";
    $display .= "</tr>";

    // Create row for each product
    foreach($reviews as $singleReview){
        $display .= "<tr>";
        $display .= "<td class='smallWidth'>$singleReview[invName]</td>";
        $display .= "<td class='bigWidth'>$singleReview[reviewText]</td>";
        $display .= "<td class='smallWidth'><a href='/acme/reviews?pageType=userWantsToEditReview&reviewId=$singleReview[reviewId]'>Update</a></td>";
        $display .= "<td class='smallWidth'><a href='/acme/reviews?pageType=confirmDeleteReview&reviewId=$singleReview[reviewId]'>Delete</a></td>";
    }

    // Close the table & div
    $display .= "</table>";
    $display .= "</div>";

    return $display;
}

// For displaying a single review
function displaySingleReview($reviewId) {
    $review = getSpecificReview($reviewId);

    // Create the div
    $display = "<div id='clientReviewDiv'>";

    $display .= "<table class='basicTable1'>";
    // Table headers
    $display .= "<tr>";
    $display .= "<th>Product Reviewed</th>";
    $display .= "<th>Your Review</th>";
    $display .= "</tr>";
    $display .= "<tr>";
    $display .= "<td class='smallWidth'>$review[invName]</td>";
    $display .= "<td class='bigWidth'>$review[reviewText]</td>"; 

    // Close the table & div
    $display .= "</table>";
    $display .= "</div>";

    return $display;
}

// Function for creating the form so a client can update a previously created review
function updateReviewForm($clientName, $reviewId, $clientId, $reviewText) {
    
    $form = "<div id='addReviewForm' class='centered'>";
    $form .= "<form action=" . urlPath('reviews/index.php') . " method='post'>";
    //$form .= "<label for='review'><h3>$clientName, Update Your Review</h3></label>";
    $form .= "<textarea name='reviewText' cols='50' rows='10'>$reviewText</textarea>";
    $form .= "<input type='hidden' name='clientId' value='$clientId'>";
    $form .= "<input type='hidden' name='pageType' value='updateReview'>";
    $form .= "<input type='hidden' name='reviewId' value='$reviewId'>";
    $form .="<br>";
    $form .="<br>";
    $form .= "<input type='submit' class='submitButton' value='Update Review'>";
    $form .= "</form>";
    $form .= "</div>";
    return $form;
}

/******* Image Functions ********/

// Add a -tn to the file name for thumbnail images
function makeThumbnailName($image) {
    $i = strrpos($image, '.');

    // Split off the image name
    $image_name = substr($image, 0, $i);

    // Get the extension
    $ext = substr($image, $i);

    // Now combine them again adding in the -tn
    $image = $image_name . '-tn' . $ext;

    return $image;
}

// Build the display for the images
function buildImageDisplay($imageArray) {
    $id = '<ul id="image-display">';

    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<p>$image[invName]</p>";
        $id .= "<img src='$image[imgPath]' title ='$image[invName] image on Acme.com' alt='$image[invName] on Acme.com'>";
        $id .= "<p><a href='/acme/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete Image :$image[imgName]</a></p></br>";  
        $id .= "</li>";
    }

    $id .= "</ul>";

    return $id;
}

// Build a dropdown menu of products
function buildProductsSelect($products) {
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Product</option>";

    foreach ($products as $product) {
        $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
    }

    $prodList .= '</select>';

    return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name) {
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
     // Gets the actual file name
     $filename = $_FILES[$name]['name'];
     if (empty($filename)) {
      return;
     }
    // Get the file from the temp folder on the server
    $source = $_FILES[$name]['tmp_name'];
    // Sets the new path - images folder in this directory
    $target = $image_dir_path . '/' . $filename;
    // Moves the file to the target folder
    move_uploaded_file($source, $target);
    // Send file for further processing
    processImage($image_dir_path, $filename);
    // Sets the path for the image for Database storage
    $filepath = $image_dir . '/' . $filename;
    // Returns the path where the file is stored
    return $filepath;
    }
   }

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];
   
    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
        $image_from_file = 'imagecreatefromjpeg';
        $image_to_file = 'imagejpeg';
        break;
    case IMAGETYPE_GIF:
        $image_from_file = 'imagecreatefromgif';
        $image_to_file = 'imagegif';
        break;
    case IMAGETYPE_PNG:
        $image_from_file = 'imagecreatefrompng';
        $image_to_file = 'imagepng';
        break;
    default:
        return;
   } // ends the resizeImage function
   
    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);
   
    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;
   
    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {
   
     // Calculate height and width for the new image
     $ratio = max($width_ratio, $height_ratio);
     $new_height = round($old_height / $ratio);
     $new_width = round($old_width / $ratio);
   
     // Create the new image
     $new_image = imagecreatetruecolor($new_width, $new_height);
   
     // Set transparency according to image type
     if ($image_type == IMAGETYPE_GIF) {
      $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
      imagecolortransparent($new_image, $alpha);
     }
   
     if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
     }
   
     // Copy old image to new image - this resizes the image
     $new_x = 0;
     $new_y = 0;
     $old_x = 0;
     $old_y = 0;
     imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
   
     // Write the new image to a new file
     $image_to_file($new_image, $new_image_path);
     // Free any memory associated with the new image
     imagedestroy($new_image);
     } else {
     // Write the old image to a new file
     $image_to_file($old_image, $new_image_path);
     }
     // Free any memory associated with the old image
     imagedestroy($old_image);
   } // ends the if - else began on line 36