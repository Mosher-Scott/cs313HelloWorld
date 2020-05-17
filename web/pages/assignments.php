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
                <td><a href="<?php echo urlPath('/pages/hello.html'); ?>">Link</a></td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Assignment Page</td>
                <td>Current Page</a></td>
                <td></td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td>W02 Team Activity</td>
                <td><a href="<?php echo urlPath('/pages/w02assignment.php') ?>">Link</a></td>
                <td></td>
                </tr>
                <tr>
                <th scope="row">4</th>
                <td>W03 Team Activity</td>
                <td><a href="<?php echo urlPath('/pages/w03Team-Assignment/teamAssignment.php') ?>">Link</a></td>
                <td></td>
                </tr>

                <tr>
                <th scope="row">5</th>
                <td>W03 Activity</td>
                <td><a href="<?php echo urlPath('/pages/w03assignment/products.php') ?>">Link</a></td>
                <td></td>
                </tr>
                
                <tr>
                <th scope="row">7</th>
                <td>W04 Activity</td>
                <td><a href="<?php echo urlPath('pages/w04Assignment/products.php') ?>">Link</a></td>
                <td></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>