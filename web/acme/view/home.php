<?php 
        include_once('common/header.php');
        include_once('common/nav.php');
?>
<main>
<h1>Welcome to Acme!</h1>
    <div id="sectionOne">
        <figure id="heroImage">
            <img src="images/site/rocketfeature.jpg" alt="Coyote on a rocket">
        </figure>
        <div class="heroRight">
            <div id=topText>
                <h2>Acme Rocket</h2>
                <h4>Quick lighting fuse</h4>
                <h4>NHTSA approved seat belts</h4>
                <h4>Mobile launch stand included</h4>
            </div>
            <div id="wantItButton">
                <button onclick="">I Want It Now!</button>
            </div>
        </div>
    </div>

    <div id="sectionTwo">
        <div id="reviewsDiv">
            <div id="reviewTitle">
                <h2>Acme Rocket Reviews</h2>
            </div>
            <div id="reviews">
                <ul>
                    <li>"I don't know how I ever caught roadrunners before this." (4/5)</li>
                    <li>"That thing was fast!" (4/5)</li>
                    <li>"Talk about fast delivery." (4/5)</li>
                    <li>"I didn't even have to pull the meat apart." (4/5)</li>
                    <li>"I'm on my thirtieth one.  I love these things!" (4/5)</li>
                </ul>
            </div>
        </div>

        <div id="featuredRecipes">
            <div id="recipeTitle">
                <h2>Featured Recipes</h2>
            </div>
            <div id="recipesList">
                <div id="recipe1" class="recipe">
                    <img class="recipeImg" src="images/recipes/bbqsand.jpg" alt="BBQ Roadrunner">
                    <a href="">Pulled Roadrunner BBQ</a>
                </div>
                <div id="recipe2" class="recipe">
                    <img class="recipeImg" src="images/recipes/potpie.jpg" alt="Pot Pie Recipe">
                    <a href="">Roadrunner Pot Pie</a>
                </div>
                <div id="recipe3" class="recipe">
                    <img class="recipeImg" src="images/recipes/soup.jpg" alt="Soup Recipe">
                    <a href="">Roadrunner Soup</a>
                </div>
                <div id="recipe4" class="recipe">
                    <img class="recipeImg" src="images/recipes/taco.jpg" alt="Taco Recipe">
                    <a href="">Roadrunner Tacos</a>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
    require_once('common/footer.php');
?>

