<?php
    @include_once('../../common/header.php');
    @include_once('../../common/nav.php');

    $majors = array(
      "CS" => "Computer Science",
      "WebDev" => "Web Design and Development",
      "CIT" => "Computer Information Technology",
      "CE" => "Computer Engineering"
    );
?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>Simple Form</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
    <h3><b>Please fill out all fields</b></h3>
    <form action="<?php echo urlPath('/pages/w03Team-Assignment/formCode.php'); ?>" method="post">
        <!--User Name and Email-->
        <div>
          <div class="form-group">
            <label for="userName">Name:</label>
            <input type="text" class="form-control" name="userName" id="userName">
            <label for="userEmail">Email:</label>
            <input type="text" class="form-control" name="userEmail" id="userEmail">
          </div>
        </div>

        <hr>
        <!--Radio list of major-->
        <div>
          <div>
            <p><b>What is your major?</b></p>
          </div>

          <?php
            foreach($majors as $key => $value) {
              echo "<div class='form-check'>";
              echo "<input type='radio' id='{$key}' class='form-check-input' name='major' value='{$value}'>";
              echo "<label for='{$key}' class='form-check-label'>{$value}</label>";
              echo "</div>";
            }
          ?>

        </div>

        <hr>
         <!--Which countries did the user visit?-->
        <div>
          <div>
            <p><b>Please check the continents you have visted</b></p>
          </div>
       
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="northAmerica" value="0">
            <label for="northAmerica" class="form-check-label">North America</label>
          </div>
        
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="southAmerica" value="1">
            <label for="southAmerica" class="form-check-label">South America</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="europe" value="2">
            <label for="europe" class="form-check-label">Europe</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="asia" value="3">
            <label for="asia" class="form-check-label">Asia</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="australia" value="4">
            <label for="australia" class="form-check-label">Australia</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="africa" value="5">
            <label for="africa" class="form-check-label">Africa</label>
          </div>

          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="places[]" id="antarctica" value="6">
            <label for="antarctica" class="form-check-label">Antarctica</label>
          </div>
          
        </div>

        <hr>
        <div>
          <div>
            <p><b>Comments?</b></p>
          </div>
          <!--User thoughts-->
          <label for="comments">Comments</label>
          <textarea name="comments" class="form-control" cols="20" rows="4" id="comments">Enter Your Comments...</textarea>
          <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </div>

    </form>
    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>

        
          <!-- <div class="form-check">
            <input type="radio" id="CS" class="form-check-input" name="major" value="Computer Science">
            <label for="CS" class="form-check-label">Computer Science</label>
          </div>
          <div class="form-check">
            <input type="radio" id="WebDev" class="form-check-input" name="major" value="Web Design and Development">
            <label for="WebDev" class="form-check-label">Web Design and Development</label>
          </div>
          <div class="form-check">
            <input type="radio" id="CIT" class="form-check-input" name="major" value="Computer Information Technology">
            <label for="CIT" class="form-check-label">Computer Information Technology</label>
          </div>
          <div class="form-check">
            <input type="radio" id="CE" class="form-check-input" name="major" value="Computer Engineering">
            <label for="CE" class="form-check-label">Computer Engineering</label>
          </div> -->