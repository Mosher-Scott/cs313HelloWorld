<?php

  @include_once('../common/header.php');
  @include_once('../common/nav.php');

?>

<main>
    <section>
      <div>
        <h1>Assignments</h1>
        <hr>
      </div>
    </section>
    <section>
      <div class="container-fluid">
        <div class="row">
            <div class="col blue-border">
                <h3>Week 01</h3>
                <p><b>Hello World: </b><a href="../pages/hello.html">Link</a>
            </div>
            <div class="col">
                <h3>Week 02</h3>
            </div>
        </div> 
      </div>
    </section>
    <section>
        <table class="table">
            <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Assignment</th>
            <th scope="col">Link</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Hello World</td>
                <td><a href="../pages/hello.html">Link</a></td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Assignment Page</td>
                <td><a href="#">Link</a></td>
                <td></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>