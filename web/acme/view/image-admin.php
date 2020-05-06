<?php 

    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }

    require_once('../common/initialize.php');
    require_once('../library/connections.php');
    require_once('../model/acme-model.php');
    require_once('../model/products-model.php');
    include_once('../library/functions.php');
    include_once('../model/uploads-model.php');

    include_once('../common/header.php');
    include_once('../common/nav.php');
    
?>

    <main>
    <br>
        <div id="formDiv">
            <h1>Image Management</h1>
            <br>
            <h2>Add New Product Image</h2>
            <br>
            <?php 
                // If any error messages, display them here
                if(isset($message)) {
                    echo $message;
                }
            ?>

            <form action="/acme/uploads/" method="post" enctype="multipart/form-data">
            <label for="invItem">Product</label><br>
            <?php echo $prodSelect; ?><br><br>
            <label>Upload Image:</label><br>
            <input type="file" name="file1"><br>
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
            </form>

            </div>
            <br>
            <div id="formDiv">
                <h2>Existing Images</h2>
                <p class="errorMessage">If deleting an image, delete the thumbnail also</p>
                <?php if(isset($imageDisplay)) {
                    echo $imageDisplay;
                } ?>
            </div>
        
    </main>

    <?php
        require_once('../common/footer.php');
    ?>