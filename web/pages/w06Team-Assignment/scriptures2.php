<?php 

// Make sure this file is in the folder with the rest of the files.  You'll want to add it to any page that will be using any of the methods we created. 
@require_once('teamAssignmentMethods.php');
@require_once('../../common/header.php');


// Get the topics for later use on the page
$topics=getTopics();   
    
?>

<body>
    <header>
        <?php //include '../Homepage/php/header.php'; ?>
    </header>

    <main class="rounded-corners">
    <section>
      <div>
        <h1>Scripture Resources</h1>
        <div class="bluebar">
        </div>
      </div>
    </section>

      
        <div class='container'>
            <h3>Search For Scripture Book</h3>
            <?php search(); ?>
        </div>
        <div class="bluebar">
        </div>
        <div>
            <h3>New Scripture Entry</h3>
        </div>
        <div class='container'>
            <form method='post' action='add-scriptures.php' class='form-horizontal'>
            <label class='above'>Book</label><input type='text' name='book'>
            <label class='above'>Chapter <input type='text' name='chapter'></label>
            <label class='above'>Verse <input type='text' name='verse'></label>
            <label class='above'>Notes <input type='textarea' rows='40' cols='50' name='content'>

            <!-- Topics -->
            <?php 
            
            $nextId = 0;
            foreach ($topics as $topic) {
                    echo "<label class='above' id='chkTopics{$topic['id']}'>{$topic['topic']}<input type='checkbox' value={$topic['id']} name='chkTopics[]'></label>";
                    $nextId++;
            }
            
            ?>
            <div>
            <label id='chkTopics{$nextId}'>New Topic <input type='checkbox' value='true' name='addNewTopic'></label>
            <label class='above'>New Topic Name</label><input type='text' name='newTopic'>
            </div>
            
            <button type='submit'>Add Scripture</button>
            </form>   
        </div>
        
    </main>

    <?php 
  @include_once('common/footer.php');
?>