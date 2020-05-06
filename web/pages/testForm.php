<?php
    @include_once('../common/header.php');
    @include_once('../common/nav.php');

    // Initialize the variables for the form
    $name = 'none';
    $email = 'none';
    $website = 'none';
    $comments = 'none';
    $website = 'none';

    // Radio Buttons
    $band = 'Default';

    // Checkboxes
    $colorPink = 'False';
    $colorBlue = 'False';
    $rememberMe = 'False';

    // Select List, single item
    $song = '';

    // Selected items, multiple
    $ridingStyles = [];

    // Error message variables
    $nameError = '';
    $emailError = '';
    $websiteError = '';
    $commentsError = '';
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        print_r($_POST);
        // Name field
        if(empty($_POST["name"])) {
            $nameError = "Name is required";
        } else {
            $name = validateInput($_POST["name"]);

            // Validate the name field
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                $nameError = "Only letters and white space allowed";
              }
        }

        // Email field
        if(empty($_POST["email"])) {
            $emailError = "Email is required";
        } else {
            $email = validateInput($_POST['email']);

            // Validate the email field
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "Invalid email format";
              }
        }

        // Website field
        if(empty($_POST['website'])) {
            $websiteError = "Website is required";
        } else {
            $website = $_POST['website'];
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                $websiteError = "Invalid URL";
              }
        }
        
        // Comments Section
        $comments = validateInput($_POST['comments']);

        // Checkboxes
        if(isset($_POST['colorBlue'])) {
            $colorBlue = 'True';
        }

        if(isset($_POST['colorPink'])) {
            $colorPink = 'True';
        }

        if(isset($_POST['rememberMe'])) {
            $rememberMe = 'True';
        }

        // Radio boxes
        $band = $_POST['favoriteBand'];

        // Select List Items
        $song = $_POST['songs'];

        // Multiple items
        if(isset($_POST["ridingStyles"])) {
            $ridingStyles = $_POST["ridingStyles"];
        }
    }

    // Validates & sanitizes the inputted data sent to it
    function validateInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


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
        <h2>A form</h2>
        <div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal blue-border col-lg-5">
            <div class="form-group">
                <label for="nameInputBox" class="col-sm-1 control-label">Name:</label>
                <div class="col-sm-6">    
                    <input type="text" name="name" id="nameInputBox" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
                    <span class="text-danger"><?php echo $nameError;?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="emailInputBox" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-7">    
                    <input type="text" name="email" id="emailInputBox" class="form-control" placeholder="Enter email" value="<?php echo $email; ?>">
                    <span class="text-danger"><?php echo $emailError;?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="websiteInputBox" class="col-sm-2 control-label">Website:</label>
                <div class="col-sm-7">    
                    <input type="text" name="website" id="websiteInputBox" class="form-control" placeholder="Enter website" value="<?php echo $website; ?>">
                    <span class="text-danger"><?php echo $websiteError;?></span>
                </div>
            </div>
            
            <div class="form-group">
                
                <div class="col-lg-7">
                <p><b>Please choose a band:</b></p>
                    <label class="radio-inline"><input type="radio" name="favoriteBand" value = "Alter Bridge" <?php if(isset($band) && $band == "Alter Bridge") echo "checked"; ?>> Alter Bridge</label>
                    <label class="radio-inline"><input type="radio" name="favoriteBand" value = "Nightwish" <?php if(isset($band) && $band == "Nightwish") echo "checked"; ?>> Nightwish</label>
                    <label class="radio-inline"><input type="radio" name="favoriteBand" value="The Smashing Pumpkins" <?php if(isset($band) && $band == "The Smashing Pumpkins") echo "checked"; ?>> The Smashing Pumpkins</label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-7 checkbox-inline">
                    <p><b>Please pick a color</b></p>
                    <label class="checkbox-inline"><input type="checkbox" name="colorPink" value="1" <?php if(isset($colorPink) && $colorPink == "True") echo "checked"; ?>> Pink</label>
                    <label class="checkbox-inline"><input type="checkbox" name="colorBlue" value="1" <?php if(isset($colorBlue) && $colorBlue == "True") echo "checked"; ?>> Blue</label>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-7 checkbox-inline">
                    <label for="selectList">Select Something</label>
                    <select class="form-control" id="selectList" name="songs">
                        <option <?php if(isset($song) && $song == "7 Days To the Wolves") echo "selected"; ?>>7 Days To the Wolves</option>
                        <option <?php if(isset($song) && $song == "Ghost Love Score") echo "selected"; ?>>Ghost Love Score</option>
                        <option <?php if(isset($song) && $song == "Storytime") echo "selected"; ?>>Storytime</option>
                        <option <?php if(isset($song) && $song == "Amaranth") echo "selected"; ?>>Amaranth</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-7 checkbox-inline">
                    <label for="selectList2">Select Multiple</label>
                    <select multiple class="form-control" id="selectList2" name="ridingStyles[]">
                        <option>XC</option>
                        <option>Downhill</option>
                        <option>Climbing</option>
                        <option>AAll Mountain</option>
                        <option>Road</option>
                    </select>
                </div>
            </div>

            
            <div class="form-group">
                <label for="commentInputBox" class="col-sm-2 control-label">Comments:</label>
                <div class="col-sm-7">    
                    <textarea name="comments" id="commentInputBox" class="form-control" placeholder="Enter email"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-7 checkbox">
                    <label>  <input type="checkbox" name="rememberMe" value="1"> Remember Me?</label>
                </div>
            </div>
            
            <div class="col-lg-2">
                <input type="submit" class="btn btn-primary">
            </div>
            </form>           
        </div>
    </section>

    <section id="formDataDisplay">
        <h3>Posted Data</h3>
        <div>
            <p><b>Name: </b><span><?php echo $name ?></span></p>
            <p><b>Email: </b><span><a href="mailto:<?php echo $email ?>">Click Here To Email Me</A></span></p>
            <p><b>Blue: </b><span><?php echo $colorBlue ?></span></p>
            <p><b>Pink: </b><span><?php echo $colorPink ?></span></p>
            <p><b>Band: </b><span><?php echo $band ?></span></p>
            <p><b>Song: </b><span><?php echo $song ?></span></p>
            <p><b>Riding Styles: </b>
            <ul>
                <?php foreach($ridingStyles as $style) {
                    echo("<li>");
                    echo ($style);
                    echo("</li>");  
                };?>
            </ul>

            <p><b>Comments: </b><span><?php echo $comments ?></span></p>
            <p><b>Remember Me? </b><span><?php echo $rememberMe ?></span></p>


        </div>
    </section>
</main>

<?php 
  @include_once('../common/footer.php');
?>

<p><b>Name: </b><span><?php echo $name ?></span></p>
<p><b>Email: </b><span><a href='mailto:"<?php echo $name ?>''</span></p>

<p><b>Major: </b><span><?php echo $major ?></span></p>