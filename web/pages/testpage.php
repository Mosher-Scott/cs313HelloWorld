<?php
    @include_once('../common/header.php');
    @include_once('../common/nav.php');

    $fileToRead = "../files/test.txt";
?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>Test Page</h1>
        <p class="text-center">For testing stuff that I don't really care about</p>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
        <?php
            echo readfile($fileToRead);
        ?>
    <br>
    <br>
    <p>A different way of opening the file.  This is a better method</p>
    <?php
        // Alternate way of opening & reading it.  A better method
        $fileContents = fopen($fileToRead, "r") or die("Sorry, can't read file");

        echo fread($fileContents,filesize($fileToRead));

        fclose($fileContents);
    ?>

    <br>
    <br>
    <p>Now just reading the first line</p>
    <?php
        // Alternate way of opening & reading it.  A better method
        $fileContents = fopen($fileToRead, "r") or die("Sorry, can't read file");

        echo fgets($fileContents,filesize($fileToRead));

        fclose($fileContents);
    ?>
       
    </section>


</main>

<?php 
  @include_once('common/footer.php');
?>