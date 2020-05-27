<?php 

// Make sure this file is in the folder with the rest of the files.  You'll want to add it to any page that will be using any of the methods we created. 
@require_once('teamAssignmentMethods.php');


// Get the topics for later use on the page
$topics=getTopics();   
    
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>CTE341 | Web Backend Development II | Scripture Resources</title>

    <link rel="stylesheet" href="/Homepage/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&Oswald&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <?php //include '../Homepage/php/header.php'; ?>
    </header>
    <main>
        <div class="main-container">
            <h2 class="page-title">Scripture Resources</h2>

          
        </div>
            <?php search(); 
           ?>
        <form method='post' action='add-scriptures.php' class='form-horizontal'>
        <label class='above'>Book</label><input type='text' name='book'>
        <label class='above'>Chapter<input type='text' name='chapter'></label>
        <label class='above'>Verse<input type='text' name='verse'></label>
        <label class='above'>Text<input type='textarea' name='content'>

        <!-- Topics -->
        <?php 
        
        $nextId = 0;
        foreach ($topics as $topic) {
                echo "<label class='above' id='chkTopics{$topic['id']}'>{$topic['topic']}<input type='checkbox' value={$topic['id']} name='chkTopics[]'></label>";
                $nextId++;
        }
        
        ?>
        <div>
        <label id='chkTopics{$nextId}'>New Topic<input type='checkbox' value='true' name='addNewTopic'></label>
        <label class='above'>New Topic Name</label><input type='text' name='newTopic'>
        </div>
        
        <button type='submit'>Add Scripture</button>
        </form>   
           

    </main>

    <footer>
    
    </footer>
</body>

</html>