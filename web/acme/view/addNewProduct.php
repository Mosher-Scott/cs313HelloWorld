<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location:/acme/');
    exit;
}

$categories = getCategories();
$categoryList = createCategoryDropdown($categories);

$catList = '<select name="catType" id="catType">';
$catList .= "<option>Choose a Category</option>";
 foreach ($categories as $category) {
  $catList .= "<option value='$category[categoryId]'";
   if(isset($catType)){
     if($category['categoryId'] === $catType){
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

            <h2>Add New Inventory Item</h2>
            <p>All fields are required</p>
            <br>
            <?php
                if(isset($message)) {
                    echo $message;
                }
            ?>     

            <form action="<?php echo urlPath('products/index.php'); ?>" method="post">

                <label for="newItemName">Name:</label>
                <input type="text" placeholder=" Item Name" id="newItemName" name="invName" <?php if(isset($invName)){echo "value='$invName'";} ?>required>
                <br>
                <label for="newItemDesc">Description:</label>
                <input type="text" placeholder=" Description" id="newItemDesc" name="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";} ?>required>
                <br>
                <label for="newItemImg">Image Path:</label>
                <input type="text" placeholder=" Image Path" id="newItemImg" name="invImg" <?php 
                if(isset($invPrice)){echo "value='$invPrice'";
                } else {
                    echo ("value=" . urlPath('images/no-image.png') . ">");
                } ?>>
                <br>
                <label for="newItemImgThumb">Thumbnail Path:</label>
                <input type="text" placeholder=" Thumbnail Path" id="newItemImgThumb" name="invThumbnail" <?php if(isset($invPrice)){echo "value='$invPrice'";} 
                else {
                    echo ("value=" . urlPath('images/no-image.png') . ">");
                }
                ?>>
                <br>
                <label for="newItemPrice">Price:</label>
                <input type="number" step="0.01" placeholder=" Price" id="newItemPrice" name="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?>required>
                <br>
                <label for="newItemStock">Initial Stock:</label>
                <input type="number" step="1" placeholder=" Starting Count" id="newItemStock" name="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?>required>
                <br>
                <label for="newItemSize">Size:</label>
                <input type="number" step="1" placeholder=" Size (in)" id="newItemSize" name="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} ?>required>
                <br>
                <label for="newItemWeight">Weight:</label>
                <input type="number" step="0.01" placeholder=" How Heavy" id="newItemWeight" name="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} ?>required>
                <br>
                <label for="newItemLocation">Location:</label>
                <input type="text" placeholder=" Where is it" id="newItemLocation" name="invLocation" <?php if(isset($invLocation)){echo "value='$invLocation'";} ?>required>
                <br>
                
                <label for="catType">Category</label> 
                <?php echo $catList; // Category dropdown list ?>
                <br>

                <label for="newItemVendor">Vendor:</label>
                <input type="text" placeholder=" Vendor Name" id="newItemVendor" name="invVendor" <?php if(isset($invVendor)){echo "value='$invVendor'";} ?>required>
                <br>
                <label for="newItemStyle">Style:</label>
                <input type="text" placeholder=" Style Type" id="newItemStyle" name="invStyle" <?php if(isset($invStyle)){echo "value='$invStyle'";} ?>required>
                <br>

                <input type="hidden" name="action" value="addNewProduct">
                <input type="submit" class="submitButton" value="Add Product">
            </form>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>