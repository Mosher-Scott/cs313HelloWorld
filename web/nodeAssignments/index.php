<?php
  @include_once('common/header.php');
?>
  <main class="rounded-corners">
    <section>
      <div>
        <h1>About Me</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <p>My name is Scott, and this is my website for CS 313.  I am a Senior at BYU Idaho with a major of Web Development, with an emphasis on backend development.<p>
                <p>During my time at BYU-I I have studied C++, HTMl, CSS, PHP, SQL, C#, Entity Framework, and the MVC design patterns.  I currently have earned certificates in Software Programming, Computer Information Technology, and Web Backend Development.  I also have earned an AS degree in Computer Information Technology.</p>
                <p>I currently live in Utah with my family and work for a high tech company.</p>
            </div>
            <div class="col-md-6">
                <!-- <img class="img-rounded-corner" src="me.jpg" alt="Picture of Scott"> -->
            </div>
        </div> 
      </div>

    <div class="bluebar">
    </div>
      
    <div class="container-fluid">
      <div class="row">
        <div class="col">
            <h3>Photography</h3>
        </div>    
      </div>
      <div class="row">
        <div class="col-md-4">
          <!-- <img class="img-rounded-corner" src="<?php echo urlPath('/images/wedding.jpg'); ?>" alt="Wedding photo by Scott Mosher Photography"> -->
        </div>
        <div class="col-md-6">
          <p>Before I moved to Utah, I professionally photographed weddings and families.  I've been able to photograph over 100 weddings, randing from a small 8 person event to over 300 guests.</p>
          <p>I now photograph weddings and family portraits on the side.  Its something I still love doing, but school, full time work, and a family has decreased the time I have to pursue it.</p>  
        </div>
        <div class="col-md-4">
          <div class="img-rounded">
            <!-- <img class="img-rounded-corner" src="<?php echo urlPath('/images/wedding2.jpg'); ?>" alt="Wedding photo by Scott Mosher Photography"> -->
          </div>
        </div>
      </div>
    </div>

    <div class="bluebar">
    </div>

    <div class="container-fluid no padding">
      <div class="row">
        <div class="col">
            <h3>Hobbies</h3>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <!-- <img class="img-rounded-corner" src="<?php echo urlPath('/images/bikePark.jpg'); ?>" alt="Mountain biking at a ski resort"> -->
        </div>
        <div class="col-md-6">
          <h4>Mountain Biking</h4>
          <p>I also enjoy mountain biking, and I get out as often as I can.  My two oldest boys are now hooked on it also, since we found some beginner downhill trails they love.</p>
          <p>I've ridden on trails throughout the SF Bay Area, the Sierra Mountains, Nevada, Utah, and a little bit in Colorado.<p>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-md-6">
          <h4>Video Games</h4>
          <p>Video games is something else I love.  I'm slowly starting a collection of old video games and systems, mainly the ones I grew up playing.</p>
          <p>I have an Atari 2600 that used to be at my grandmothers house. I've also got the N64 still from high school, and I've also collected a PS2, Xbox 360, Wii, and I've built up a Raspberry Pi with a ton of different games in it.</p>
        </div>
        <div class="col-md-6 centered">
          <!-- <img class="img-rounded-corner" src="<?php echo urlPath('/images/atari.jpg'); ?>" alt="Some old video game systems"> -->
        </div>
      </div>
    </div>
  </section>

</main>