

<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location:/acme/');
    exit;
}


if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

$categories = getCategories();

    $catList = '<select name="catType" id="catType">';
    $catList .= "<option>Choose a Category</option>";
    foreach ($categories as $category) {
     $catList .= "<option value='$category[categoryId]'";
     if(isset($catType)){
      if($category['categoryId'] === $catType){
       $catList .= ' selected ';
      }
     } elseif(isset($prodInfo['categoryId'])){
      if($category['categoryId'] === $prodInfo['categoryId']){
       $catList .= ' selected ';
      }
     }
    $catList .= ">$category[categoryName]</option>";
    }
    $catList .= '</select>';
?>

    <main>
        <br>
        <div id="formDiv">
            <h2>Product Management</h2>
            <hr>
            <div id="categoryMaintenance">
                <h3>Category Tasks</h3>
                <p><a href="<?php echo urlPath('products/index.php?action=newCategory'); ?>">Add Category</a></p>
            </div>
            <br>
            <div id="productMaintenance">
                <h3>Product Tasks</h3>
                <p><a href="<?php echo urlPath('products/index.php?action=newProduct'); ?>">Add Inventory Item</a></p>
            </div>
        </div>
        <br>
        <div id="inventoryItemsDisplay">
            <?php
               
                if(isset($categoryList)) {
                    
                    echo ('<h2>Products By Category</h2>');
                    if(isset($message)) {
                        echo $message;
                        echo"<br>";
                    }
                    echo ('<br><h4>Choose a category to see those products</h4>');
                    echo $categoryList;
                }

            ?>
            <!-- If Javascript is not enabled, display this message -->
            <noscript>
            <p><strong>Javascript Must Be Enabled to Use This Page</strong></p>
            </noscript>
                
            <table id="productsDisplay">
            <!-- Table populated by Javascript -->
            </table>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
        unset($_SESSION['message']);
    ?>