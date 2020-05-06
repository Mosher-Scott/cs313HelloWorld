

 <title><?php echo $categoryName; ?> Products | Acme, Inc.</title>
    <main>
        <h1><?php echo $categoryName; ?> Products</h1>

        <?php if(isset($message)) {
            echo $message;
        } ?>

        <?php if(isset($prodDisplay)) {
            echo $prodDisplay;
        } ?>
    </main>

    <?php
        require_once('../common/footer.php');
    ?>