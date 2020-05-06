<?php

$countries = [];
$name = htmlspecialchars($_POST["userName"]);
$email = htmlspecialchars($_POST["userEmail"]);
$major = htmlspecialchars($_POST["major"]);

// Multiple items
if(isset($_POST["countries"])) {
    $countries = $_POST["countries"];
}

$comments = htmlspecialchars($_POST["comments"]);


$maps = array(
    "Africa" => "http://www.yourchildlearns.com/online-atlas/africa-map.htm",
    "N America" => "http://www.yourchildlearns.com/online-atlas/north-america-map.htm"
);

$information = array(
    "Since you have visited Africa, you know that it is the 2nd largest continent in both land and in population.  There are only a few parts of the continent that you'd consider cold." => "5",
    
    "North America is pretty cool.  Lots of people live there" => "0"
);


?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Team Activity 03</title>
    <meta name=viewport content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>
<body id="mainBody">
    <p><b>Name: </b><span><?php echo $name ?></span></p>
    <p><b>Email: </b><span><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></span></p>
    <p><b>Major: </b><span><?php echo $major ?></span></p>
    <p><b>Comments: </b><span><?php echo $comments ?></span></p>

    <h4>This will loop through the saved countries</h4>
    <?php
        //print_r($_POST);
        $countryNumber = 1;
        foreach($countries as $visited) {
            echo "<p>Country {$countryNumber}: ";
            echo array_search($visited, $information);
            echo "</p>";
            $countryNumber++;
        }

    // Use a specific one
    ?>
</body>
</html>