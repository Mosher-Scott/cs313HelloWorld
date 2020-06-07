<?php

  @include_once('../common/header.php');

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

                <tr>
                <th scope="row">7</th>
                <td>W05 Team Activity</td>
                <td><a href="<?php echo urlPath('pages/W05Team-Assignment/mainpage.php') ?>">Link</a></td>
                <td></td>
                </tr>

                <tr>
                <th scope="row">8</th>
                <td>W05 Activity</td>
                <td><a href="<?php echo urlPath('pages/w05Assignment/products.php') ?>">Link</a></td>
                <td></td>
                </tr>

                <tr>
                <th scope="row">9</th>
                <td>W06 Team Activity</td>
                <td><a href="<?php echo urlPath('pages/w06Team-Assignment/scriptures2.php') ?>">Link</a></td>
                <td></td>
                </tr>

                <tr>
                <th scope="row">10</th>
                <td>W06 Activity</td>
                <td><a href="<?php echo urlPath('pages/w06Assignment/products.php') ?>">Link</a></td>
                <td></td>
                </tr>

                <tr>
                <th scope="row">11</th>
                <td>W07 Team Activity</td>
                <td><a href="<?php echo urlPath('pages/w07Team-Assignment/signUp.php') ?>">Link</a></td>
                <td></td>
                </tr>

                <tr>
                <th scope="row">12</th>
                <td>Project 1</td>
                <td><a href="<?php echo urlPath('pages/Project_1/login.php') ?>">Link</a></td>
                <td></td>
                </tr>
            </tbody>
        </table>
    </section>
</main>