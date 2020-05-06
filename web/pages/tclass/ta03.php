<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Team Activity 03</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
</head>
<body id="mainBody">
    <form action="formCode.php" method="post">
        <!--User Name and Email-->
        <label for="userName">Name: <input type="text" name="userName"></label><br>
        <label for="userEmail">Email: <input type="text" name="userEmail"></label><br>
        <!--Radio list of major-->
        <input type="radio" id="CS" name="major" value="Computer Science">
        <label for="CS">Computer Science</label><br>
        <input type="radio" id="WebDev" name="major" value="Web Design and Development">
        <label for="WebDev">Web Design and Development</label><br>
        <input type="radio" id="CIT" name="major" value="Computer Information Technology">
        <label for="CIT">Computer Information Technology</label><br>
        <input type="radio" id="CE" name="major" value="Computer Engineering">
        <label for="CE">Computer Engineering</label><br><br>
        <!--Which countries did the user visit?-->
        <input type="checkbox" name="places[]" id="northAmerica" value="0"><label for="northAmerica">North America</label><br />
        <input type="checkbox" name="places[]" id="southAmerica" value="1"><label for="southAmerica">South America</label><br />
        <input type="checkbox" name="places[]" id="europe" value="2"><label for="europe">Europe</label><br />
        <input type="checkbox" name="places[]" id="asia" value="3"><label for="Asia">Asia</label><br />
        <input type="checkbox" name="places[]" id="australia" value="4"><label for="australia">Australia</label><br />
        <input type="checkbox" name="places[]" id="africa" value="5"><label for="africa">Africa</label><br />
        <input type="checkbox" name="places[]" id="antarctica" value="6"><label for="Antarctica">Antarctica</label><br />
        <!--User thoughts-->
        <label for="comments"><textarea name="comments" cols="20" rows="4">Enter Your Comments...</textarea></label><br>
        <input class="button" type="submit" name="submit" value="Submit">
    </form>
</body>
</html>