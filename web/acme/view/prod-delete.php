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
            echo "Delete $prodInfo[invName] ";} 
        elseif(isset($invName)) { 
            echo $invName;
        }
            ?>Acme</title>
    <main>
        <br>
        <div id="formDiv">

            <h2><?php 
            if(isset($prodInfo['invName'])) {
                echo "Delete $prodInfo[invName] ";} 
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
            //var_dump($_POST);
            ?>

            <h3>This will delete the folllowing product.  Please note, THIS CANNONT BE UNDONE</h3>

            <form action="<?php echo urlPath('products/index.php'); ?>" method="post">
                
                <label for="newItemName">Name:</label>
                <input type="text" id="newItemName" name="invName" readonly 
                <?php  echo "value='$prodInfo[invName]'";
                  ?>
                required>
                <br>
                <label for="newItemDesc">Description:</label>
                <input type="text" placeholder=" Description" id="newItemDesc" name="invDescription" size="35" readonly
                <?php echo "value='$prodInfo[invDescription]'";?>
                required>

                <input type="hidden" name="action" value="deleteProd">
                <input type="hidden" name="invId" value="<?php echo $prodInfo['invId']; ?>">
                <br>
                <input type="submit" class="submitButton" value="Delete Product">
            </form>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>