<?php

  @include_once('common/header.php');
  //@include_once('common/nav.php');

?>
  <main>
    <section>
      <div class="">
        <h1>About Me</h1>
      </div>
    </section>

    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>CS 313 - Backend Development</h3>
            </div>
            <div class="col">
                <p>My name is Scott, and this is my website for CS 313.
            </div>
            <div class="col">
                <img src="../images/me.jpg" alt="Picture of Scott">
            </div>
        </div> 

      </div>
      <div class="row">
            <div class="col">
              <h3>Hobbies</h3>
            </div>    
        </div>
    </section>

    <div class="row">
  <div class="col">col</div>
  <div class="col">col</div>
  <div class="col">col</div>
</div>
  </main>

  <div class="container-fluid">
  <h2>Three Equal Columns</h2>
  <p>Use the .col class on a specified number of elements and Bootstrap will recognize how many elements there are (and create equal-width columns). In the example below, we use three col elements, which gets a width of 33.33% each.</p>
  <div class="row">
    <div class="col bg-success">.col</div>
    <div class="col bg-warning">.col</div>
    <div class="col bg-success">.col</div>
  </div>
</div>