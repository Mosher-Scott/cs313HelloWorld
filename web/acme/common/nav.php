<nav>
 <?php
 // Create an array of all the categories
 $categories = getCategories();
 
 // Run the function to create the nav menu
 $navMenu = createNavMenu($categories);

 // Now display the menu on the page
 echo ($navMenu) ?>
</nav>