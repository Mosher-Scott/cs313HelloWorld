<?php
    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('productDetails.php');

    // Initialize the variables for the form
    $name = '';
    $email = '';
    $street = '';
    $city = '';
    $state = '';
    $zipcode = '';
    $phone = '';
    $shipSame ='';
    $comments = '';

    // Error message variables
    $nameError = '';
    $emailError = '';
    $streetError = '';
    $cityError = '';
    $stateError = '';
    $zipcodeError = '';
    $phone = '';

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

      // Street field
      if(empty($_POST["street"])) {
        $streetError = "Street is required";
      } else {
        $street = validateInput($_POST['street']);

        // Validate the Street field
        if (!filter_var($street, FILTER_SANITIZE_STRING)) {
            $streetError = "Invalid name format";
          }
        }

      // City field
      if(empty($_POST["city"])) {
        $cityError = "City Name is required";
      } else {
        $city = validateInput($_POST['city']);

        // Validate the City field
        if (!filter_var($city, FILTER_SANITIZE_STRING)) {
            $cityError = "Invalid City";
          }
        }

      // Zipcode field
      if(empty($_POST["zipcode"])) {
        $zipcodeError = "Zipcode is required";
      } else {
        $zipcode = validateInput($_POST['zipcode']);

        // Validate the Zipcode field
        if (!filter_var($zipcode, FILTER_SANITIZE_STRING)) {
            $zipcode = "Invalid Zipcode";
          }
        }

      // Phone field
      if(empty($_POST["phone"])) {
        $phoneError = "phone is required";
      } else {
        $phone = validateInput($_POST['phone']);

        // Validate the Phone number field
        if (!filter_var($phone, FILTER_SANITIZE_STRING)) {
            $phone = "Invalid Phone Number";
          }
        }

      // TODO: validate & save zip, phone, comments

      // Is shipping same as billing?
      if(isset($_POST['colorBlue'])) {
        $colorBlue = 'True';
      }

      // Comments Section
      $comments = validateInput($_POST['comments']);
      
      // Now if there are no page errors, redirect the user to the confirmation page
      if($nameError = '' && $emailError = '' && $streetError = '' && $cityError = '' && $stateError = '' && $zipcodeError = ''  && $phone = '') {
          // header('confirmation.php');
          // exit();

          echo $name; 
          echo $email;
          echo $street;
          echo $city;
          echo $state;
          echo $zipcode ;
          echo $phone;
          echo $shipSame;
          echo $comments;
      }

    } // End of processing post data


    // Method to validate & sanitize the inputted data sent to it
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
      <h1>Checkout</h1>
      <div class="bluebar">
      </div>
    </div>
  </section>

  <section id="simpleForm">
    <h2>Shipping & Billing Information</h2>
    <div>
      <form action="" method="post" class="form-horizontal blue-border col-lg-5">
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
          <label for="streetInputBox" class="col-sm-1 control-label">Street:</label>
          <div class="col-sm-6">    
            <input type="text" name="street" id="streetInputBox" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
            <span class="text-danger"><?php echo $streetError;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="cityInputBox" class="col-sm-1 control-label">City:</label>
          <div class="col-sm-6">    
            <input type="text" name="city" id="cityInputBox" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
            <span class="text-danger"><?php echo $cityError;?></span>
          </div>
        </div>
        
        <div class="form-group">
          <label for="stateInputBox" class="col-sm-1 control-label">State:</label>
          <div class="col-sm-6">    
            <input type="text" name="state" id="stateInputBox" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
            <span class="text-danger"><?php echo $stateError;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="zipInputBox" class="col-sm-1 control-label">Zipcode:</label>
          <div class="col-sm-6">    
            <input type="text" name="zipcode" id="zipInputBox" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
            <span class="text-danger"><?php echo $zipcodeError;?></span>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-7 checkbox-inline">
            <p><b>Shipping the same as Billing?</b></p>
            <label class="checkbox-inline"><input type="checkbox" name="shipSame" value="1" <?php if(isset($colorPink) && $colorPink == "True") echo "checked"; ?>> Yes</label>
          </div>
        </div>

        <div class="form-group">
          <label for="commentInputBox" class="col-sm-2 control-label">Comments:</label>
          <div class="col-sm-7">    
              <textarea name="comments" id="commentInputBox" class="form-control" placeholder="Enter email"></textarea>
          </div>
        </div>

        <div class="col-lg-2">
                <input type="submit" class="btn btn-primary">
            </div>

      </form>           
    </div>

  </section>

  <section>
    <div>
      <a href="products.php" class="btn btn-primary">Complete Purchase</a>
      <a href="checkout.php" class="btn btn-primary">&#8592; Back to Cart</a>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>          