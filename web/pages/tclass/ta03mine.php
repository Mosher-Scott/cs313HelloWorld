<?php



?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Team Activity 03</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>
<body id="mainBody">
    <form action="formCode.php" method="post">
        <label for="userName">Name: <input type="text" name="userName"></label><br>
        <label for="userEmail">Email: <input type="text" name="userEmail"></label><br>
        <input type="radio" id="CS" name="major" value="Computer Science">
        <label for="CS">Computer Science</label><br>
        <input type="radio" id="WebDev" name="major" value="Web Design and Development">
        <label for="WebDev">Web Design and Development</label><br>
        <input type="radio" id="CIT" name="major" value="Computer Information Technology">
        <label for="CIT">Computer Information Technology</label><br>
        <input type="radio" id="CE" name="major" value="Computer Engineering">
        <label for="CE">Computer Engineering</label><br><br>

        <label for="countries">Select Countries You Visited</label>
                    <select multiple class="form-control" id="selectList2" name="countries[]">
                        <option value="0">Africa</option>
                        <option value ="1">N America</option>
                        <option value="3">S America</option>
                        <option value="4">All Mountain</option>
                        <option value="5">Road</option>
                    </select>

        <label for="comments"><textarea name="comments" cols="20" rows="4">Enter Your Comments...</textarea></label><br>
        <input class="button" type="submit" name="submit" value="Submit">
    </form>

</body>
</html>