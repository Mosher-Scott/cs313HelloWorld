<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location:/acme/');
    exit;
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
 <title>
    <?php 
        if(isset($prodInfo['invName'])) {
            echo "Modify $prodInfo[invName] ";} 
        elseif(isset($invName)) { 
            echo $invName;
        }
            ?>Acme</title>
    <main>
        <br>
        <div id="formDiv">

            <h2><?php 
            if(isset($prodInfo['invName'])) {
                echo "Modify $prodInfo[invName] ";} 
            elseif(isset($invName)) { 
                echo $invName;
            }
            ?>
            </h2>

            <p></p>
            <br>
            <?php
                if(isset($message)) {
                    echo $message;
                }
            ?>     

            <form action="<?php echo urlPath('products/index.php'); ?>" method="post">
                
                <label for="newItemName">Name:</label>
                <input type="text" id="newItemName" name="invName" 
                <?php if(isset($invName)){
                    echo "value='$invName'";
                 } elseif (isset($prodInfo['invName'])) {
                 echo "value='$prodInfo[invName]'";
                 } ?>
                required>
                <br>
                <label for="newItemDesc">Description:</label>
                <input type="text" placeholder=" Description" id="newItemDesc" name="invDescription" size="35"
                <?php if(isset($invDescription)){
                    echo "value='$invDescription'";
                 } elseif (isset($prodInfo['invDescription'])) {
                 echo "value='$prodInfo[invDescription]'";
                 } ?>
                required>
                <br>
                <label for="newItemImg">Image Path:</label>
                <input type="text" placeholder=" Image Path" id="newItemImg" name="invImage"
                <?php if(isset($invImage)){
                    echo "value='$invImage'";
                 } elseif (isset($prodInfo['invImage'])) {
                 echo "value='$prodInfo[invImage]'";
                 } ?> required>
                <br>
                <label for="newItemImgThumb">Thumbnail Path:</label>
                <input type="text" placeholder=" Thumbnail Path" id="newItemImgThumb" name="invThumbnail"
                <?php if(isset($invThumbnail)){
                    echo "value='$invThumbnail'";
                 } elseif (isset($prodInfo['invThumbnail'])) {
                 echo "value='$prodInfo[invThumbnail]'";
                 } ?> required>
                <br>
                <label for="newItemPrice">Price:</label>
                <input type="number" step="0.01" placeholder=" Price" id="newItemPrice" name="invPrice" 
                <?php if(isset($invPrice)){
                    echo "value='$invPrice'";
                 } elseif (isset($prodInfo['invPrice'])) {
                 echo "value='$prodInfo[invPrice]'";
                 } ?> required>
                <br>
                <label for="newItemStock">Initial Stock:</label>
                <input type="number" step="1" placeholder=" Starting Count" id="newItemStock" name="invStock"  
                <?php if(isset($invStock)){
                    echo "value='$invStock'";
                 } elseif (isset($prodInfo['invStock'])) {
                 echo "value='$prodInfo[invStock]'";
                 } ?> required>
                <br>
                <label for="newItemSize">Size:</label>
                <input type="number" step="1" placeholder=" Size (in)" id="newItemSize" name="invSize"
                <?php if(isset($invSize)){
                    echo "value='$invSize'";
                 } elseif (isset($prodInfo['invSize'])) {
                 echo "value='$prodInfo[invSize]'";
                 } ?> required>
                <br>
                <label for="newItemWeight">Weight:</label>
                <input type="number" step="0.01" placeholder=" How Heavy" id="newItemWeight" name="invWeight"
                <?php if(isset($invWeight)){
                    echo "value='$invWeight'";
                 } elseif (isset($prodInfo['invWeight'])) {
                 echo "value='$prodInfo[invWeight]'";
                 } ?> required>
                <br>
                <label for="newItemLocation">Location:</label>
                <input type="text" placeholder=" Where is it" id="newItemLocation" name="invLocation"
                <?php if(isset($invLocation)){
                    echo "value='$invLocation'";
                 } elseif (isset($prodInfo['invLocation'])) {
                 echo "value='$prodInfo[invLocation]'";
                 } ?> required>
                <br>
                
                <label for="CategoryDropdown">Category</label> 
                <?php //echo ($categoryList); // Category dropdown list 
                    echo $catList;
                ?>
                <br>

                <label for="newItemVendor">Vendor:</label>
                <input type="text" placeholder=" Vendor Name" id="newItemVendor" name="invVendor"
                <?php if(isset($invVendor)){
                    echo "value='$invVendor'";
                 } elseif (isset($prodInfo['invVendor'])) {
                 echo "value='$prodInfo[invVendor]'";
                 } ?> required>
                <br>
                <label for="newItemStyle">Style:</label>
                <input type="text" placeholder=" Style Type" id="newItemStyle" name="invStyle"
                <?php if(isset($invStyle)){
                    echo "value='$invStyle'";
                 } elseif (isset($prodInfo['invStyle'])) {
                 echo "value='$prodInfo[invStyle]'";
                 } ?> required>
                <br>

                <input type="hidden" name="action" value="updateProd">
                <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])) { echo $prodInfo['invId'];}
                elseif(isset($invId)) { echo $invId;} ?>">
                <input type="submit" class="submitButton" value="Update Product">
            </form>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>