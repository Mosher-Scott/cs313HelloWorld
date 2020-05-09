<?php
    session_start();

    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');
    @include_once('../../common/phpMethods.php');
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
    $nameError = null;
    $emailError = null;
    $streetError = null;
    $cityError = null;
    $stateError = null;
    $phoneError = null;
    $zipcodeError = null;
    $phone = null;

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

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['name'] = $name;
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

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['email'] = $email;
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

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['street'] = $street;
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

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['city'] = $city;
        }

      // City field
      if(empty($_POST["state"])) {
        $stateError = "State is required";
      } else {
        $state = validateInput($_POST['state']);

        // Validate the City field
        if (!filter_var($state, FILTER_SANITIZE_STRING)) {
            $stateError = "Invalid State";
          }

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['state'] = $state;
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

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['zipcode'] = $zipcode;
        }

      // Phone field
      if(empty($_POST["phone"])) {
        $phoneError = "Phone is required";
      } else {
        $phone = validateInput($_POST['phone']);

        // Validate the Phone number field
        if (!filter_var($phone, FILTER_SANITIZE_STRING)) {
            $phone = "Invalid Phone Number";
          }

          // If all good, save it to the sesson
          $_SESSION['orderDetails']['phone'] = $phone;
        }

      // Is shipping same as billing?
      if(isset($_POST['shipSame'])) {
        $shipSame = 'True';

        // If all good, save it to the sesson
        $_SESSION['orderDetails']['shipSame'] = $shipSame;
      }

      // Comments Section
      $comments = validateInput($_POST['comments']);

      // If all good, save it to the sesson
      $_SESSION['orderDetails']['comments'] = $comments;
      
      // Now if there are no page errors, redirect the user to the confirmation page
      if($nameError == null && $emailError == null && $streetError == null && $cityError == null && $stateError == null && $zipcodeError == null && $phoneError == null) {
          $confirmationPage = urlPath('pages/w03assignment/confirmation.php');

          $_SESSION['orderDetails']['orderNo'] = rand(500,1500);
          $_SESSION['orderDetails']['orderdate'] = date("m/d/Y");

         header("location: $confirmationPage");
          
          exit();
      }

    } // End of processing post data

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
      <form action="checkout.php" method="post" class="form-horizontal blue-border col-lg-5">
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
          <label for="phoneInputBox" class="col-sm-1 control-label">Phone:</label>
          <div class="col-sm-6">    
            <input type="text" name="phone" id="phoneInputBox" class="form-control" placeholder="Enter Phone" value="<?php echo $phone; ?>">
            <span class="text-danger"><?php echo $phoneError;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="streetInputBox" class="col-sm-1 control-label">Street:</label>
          <div class="col-sm-6">    
            <input type="text" name="street" id="streetInputBox" class="form-control" placeholder="Enter Street" value="<?php echo $street; ?>">
            <span class="text-danger"><?php echo $streetError;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="cityInputBox" class="col-sm-1 control-label">City:</label>
          <div class="col-sm-6">    
            <input type="text" name="city" id="cityInputBox" class="form-control" placeholder="Enter City" value="<?php echo $city; ?>">
            <span class="text-danger"><?php echo $cityError;?></span>
          </div>
        </div>
        
        <div class="form-group">
          <label for="stateInputBox" class="col-sm-1 control-label">State:</label>
          <div class="col-sm-6">    
            <input type="text" name="state" id="stateInputBox" class="form-control" placeholder="Enter State" value="<?php echo $state; ?>">
            <span class="text-danger"><?php echo $stateError;?></span>
          </div>
        </div>

        <div class="form-group">
          <label for="zipInputBox" class="col-sm-1 control-label">Zipcode:</label>
          <div class="col-sm-6">    
            <input type="text" name="zipcode" id="zipInputBox" class="form-control" placeholder="Enter Zipcode" value="<?php echo $zipcode; ?>">
            <span class="text-danger"><?php echo $zipcodeError;?></span>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-7 checkbox-inline">
            <p><b>Shipping the same as Billing?</b></p>
            <label class="checkbox-inline"><input type="checkbox" name="shipSame" value="1" <?php if(isset($shipSame)) echo "checked"; ?>> Yes</label>
          </div>
        </div>

        <div class="form-group">
          <label for="commentInputBox" class="col-sm-2 control-label">Comments:</label>
          <div class="col-sm-7">    
              <textarea name="comments" id="commentInputBox" class="form-control" placeholder="Comments?"></textarea>
          </div>
        </div>

        <div class="col-lg-2">
                <input type="submit" class="btn btn-primary" value="Checkout">
            </div>

      </form>           
    </div>
    <div>
      <a href="cart.php" class="btn btn-primary">&#8592; Back to Cart</a>
    </div>
  </section>

</main>

<?php 
  @include_once('../../common/footer.php');
?>          