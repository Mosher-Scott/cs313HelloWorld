<?php
    @include_once('../common/header.php');
    @include_once('../common/nav.php');
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

    <section id="simpleForm">
        <div>
            <form action="testpage.php" method="post" class="form-horizontal blue-border col-lg-5">
            <div class="form-group">
                <label for="nameInputBox" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-6">    
                    <input type="text" name="name" id="nameInputBox" class="form-control" aria-describedby="namehelp" placeholder="Enter name">
                </div>
            </div>
            <div class="form-group">
                <label for="emailInputBox" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-7">    
                    <input type="text" name="email" id="emailInputBox" class="form-control" aria-describedby="emailhelp" placeholder="Enter email">
                </div>
            </div>

            <div class="form-group">
                <label for="commentInputBox" class="col-sm-2 control-label">Comments:</label>
                <div class="col-sm-7">    
                    <textarea name="comments" id="commentInputBox" class="form-control" aria-describedby="emailhelp" placeholder="Enter email"></textarea>
                </div>
            </div>
            
            <div class="col-lg-2">
                <input type="submit" class="btn btn-primary">
            </div>
            </form>

        </div>
    </section>

    <section id="formDataDisplay">
        <div>
            <h3>All POST Data</h3>
            <table>
            <?php print_r($_POST); ?>
            </table>
            <p><b>Name: </b><span><?php echo $_POST["name"] ?></span></p>
            <p><b>Email: </b><span><?php echo $_POST["email"] ?></span></p>
            <p><b>Comments: </b><span><?php echo $_POST["comments"] ?></span></p>
        </div>
    </section>


</main>

<?php 
  @include_once('common/footer.php');
?>