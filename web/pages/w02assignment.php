<?php
    @include_once('../common/header.php');
    @include_once('../common/nav.php');
?>
  <main class="rounded-corners">
    <section>
      <div id="firstDiv">
        <h1>W02 Assignment</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
              <h4>This assignment has a few parts:</h4>
              <ol>
                <li>Add a button for the user to click to display an alert message</li>
                <li>Add classes/id tags to divs</li>
                <li>Use CSS to bold some text when the user hovers over the text</li>
                <li>Allow user to specify custom colors for the first div in the document</li>
              </ol>

              <h4>Optional requirements</h4>
              <ol>
                <li>Allow the user to change the background color, but use jQuery instead of Javascript</li>
                <li>Toggle visbility of the 3rd div, and fade visiblity in/out</li>
                <li>Use Bootstrap</li>
              </ol>
            </div>
        </div> 
      </div>

    <div class="bluebar">
    </div>
      
    <div class="container-fluid" id="secondDiv">
      <div class="row">
        <div class="col">
            <h3>Part I</h3>
        </div>    
      </div>

      <div class="row">
        <div class="col-md-6" id="buttonDiv">
          <p>Click the button to display an alert message:</p>
          <button id="alertButton" onclick="displayAlertMessage()">Click Me!</button>
        </div>
        <div class="col-md-6" id="boldText">
          <p>This is some text on a page.  Using CSS can do some pretty cool stuff!</p>
        </div>
      </div>

    </div>

    <div class="bluebar">
    </div>
      
    <div class="container-fluid" id="secondDiv">
      <div class="row">
        <div class="col">
            <h3>Third Div</h3>
        </div>    
      </div>

      <div class="row">
        <div class="col-md-6">
          <p>Click the button to display an alert message:</p>
          <button id="alertButton" onclick="displayAlertMessage()">Click Me!</button>
        </div>
      </div>

    </div>

    <div class="bluebar">
    </div>
    
  </section>

</main>

<?php 
  @include_once('common/footer.php');
?>