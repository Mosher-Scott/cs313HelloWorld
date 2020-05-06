

<?php

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location:/acme/');
    exit;
}


require_once('../model/acme-model.php');
require_once('../library/connections.php');

// Get categories
$categories = getCategories();

// Build the nav list
$navList = '<ul>';
$navList .= "<li><a href='/acme/index.php' title='View the Acme home page'>Home</a></li>";
 foreach($categories as $category){
    $navList .= "<li><a href='/acme/index.php?action=".$category['categoryName']."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
}
$navList .= "</ul>";


?>

    <main>
        <br>
        <div id="formDiv">

            <h2>Add New Category</h2>
            <br>
            <?php
                if(isset($message)) {
                    echo $message;
                }
            ?>     

            <form action="<?php echo urlPath('products/index.php'); ?>" method="post">

                <label for="newCategoryname">Enter Category Name:</label>
                <input type="text" id="newCategoryname" name="categoryName" required <?php if(isset($categoryname)){echo "value='$categoryname'";}  ?>>
                <br>
                <input type="hidden" name="action" value="addNewCategory">
                <input type="submit" class="submitButton" value="Add New Category">
            </form>
        </div>
        <br>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>