<?php
// Fill in the blanks, or add in your own DB connection method within this function.  Now you only need to call the same function on any page.  If the database credentials change, instead of changing it on all 3 pages, you only need to change it right here.  Any function that uses this will then be able to connect with the updated information.
function dbConnection2() {
    $host = "ec2-18-233-32-61.compute-1.amazonaws.com";
    $db_name = "d3h9884il9ijro";
    $user = "ukrrsviyqnkmor";
    $password = "d1294a18dbc2a6656d417615b810c6285bd0c3fc477873b4a9d84737425d0082";
    $port = 5432;

    $dsn = "pgsql:host=$host;dbname=$db_name;user=$user;port=$port;password=$password";

    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $db = new PDO($dsn);
        return $db;
    } catch (PDOException $e){
        echo "Connection to the database failed";

        echo $e;
    }
}

// Simple search form for W5 team assignment
    function search() {
        echo "<form method='post' action='scrip-results.php'>";
        echo "<input type='text' name='bookToFind'>";
        echo "<button type='submit'>Search</button>";
        echo "</form>";
    }

    // Get all books
    function getAllBooks() {
        $db=dbConnection2();    
        $stmt = $db->prepare('SELECT * FROM scriptures');
        // $name= "%{$name}%";
        $stmt->execute();
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $book;
    }

    // Query the DB for all books with that name
    function searchQuery($name) {
        $db=dbConnection2();    
        $stmt = $db->prepare('SELECT * FROM scriptures WHERE book = :name');
        // $name= "%{$name}%";
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $book;
    }

    // Query for getting all information for a specified book
    function displayQuery($id) {
        $db=dbConnection2();    
        $stmt = $db->prepare('SELECT * FROM scriptures WHERE id = :id');
        //$name= '$name';
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $book;
        }

    function getTopics() {
        // Create a connection object from the connection function
        $db = dbConnection2();
        // The SQL statement to be used with the database 
        $sql = 'SELECT topic, id FROM topics ORDER BY topic ASC'; 
        // The next line creates the prepared statement using the db connection      
        $stmt = $db->prepare($sql);
        // The next line runs the prepared statement 
        $stmt->execute(); 
        // The next line gets the data from the database and 
        // stores it as an array in the $topic's variable 
        $topics = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        // The next line closes the interaction with the database 
        $stmt->closeCursor(); 
        // The next line sends the array of data back to where the function 
        // was called (this should be the controller) 
        return $topics;
    }

    // Processes post data when we are adding a new scripture to the database
    function processPostDataForNewScripture() {
        //print_r($_POST);
    $book = $_POST['book'];
    $chapter = $_POST['chapter'];
    $verse = $_POST['verse'];
    $content = $_POST['content'];
    $topicIds = $_POST['chkTopics'];

    // Check if the checkbox is checked for 'Add New Topic'.  If true, we're going to add it to the DB, get the ID for it, then add it to the array holding the other topic IDs
    if(isset($_POST['addNewTopic'])) {
        // Get the topic name
        $topicName = $_POST['newTopic'];
        $topicId = addNewTopic($topicName);

        //echo "Topic ID: " . $topicId;

        // Now add that topic to the array of topics as we are assuming the user wants to add that topic to this scripture
        array_push($topicIds, $topicId);

       // print_r($topicIds);
    }


    // Call this method to add scriptures & topics to the database
    addScripture($book, $chapter, $verse, $content, $topicIds);
    }

    function getScriptures() {
        try
        {
            $db = dbConnection2();
            // For this example, we are going to make a call to the DB to get the scriptures
            // and then for each one, make a separate call to get its topics.
            // This could be done with a single query (and then more processing of the resultset
            // afterward) as follows:
        
            //	$statement = $db->prepare('SELECT book, chapter, verse, content, t.name FROM scripture s'
            //	. ' INNER JOIN scripture_topic st ON s.id = st.scriptureId'
            //	. ' INNER JOIN topic t ON st.topicId = t.id');
        
        
            // prepare the statement
            $statement = $db->prepare('SELECT id, book, chapter, verse, content FROM scriptures');
            $statement->execute();
        
            // Go through each result
            while ($row = $statement->fetch(PDO::FETCH_ASSOC))
            {
                echo "<p><strong>{$row['book']} {$row['chapter']}:{$row['verse']}</strong> - {$row['content']}</p>";
                echo '<p>Topics:</p>';
                echo "<ul>";
        
                // get the topics now for this scripture
                $stmtTopics = $db->prepare('SELECT topic FROM topics t'
                    . ' INNER JOIN scripture_topic st ON st.topic_id = t.id'
                    . ' WHERE st.scripture_id = :scripture_id');
        
                $stmtTopics->bindValue(':scripture_id', $row['id']);
                $stmtTopics->execute();
        
                // Go through each topic in the result
                while ($topicRow = $stmtTopics->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<li>{$topicRow['topic']}</li>";
                }
                echo "</ul>";
                
            }
        
        
        }
        catch (PDOException $ex)
        {
            echo "Error with DB. Details: $ex";
            die();
        }
    }

    // Method for adding new items
    function addScripture($book, $chapter, $verse, $content, $topicIds) {
        try
        {
            // Add the Scripture
            $db = dbConnection2();
            // We do this by preparing the query with placeholder values
            $query = 'INSERT INTO public.scriptures(book, chapter, verse, content) VALUES(:book, :chapter, :verse, :content)';
            $statement = $db->prepare($query);
    
            // Now we bind the values to the placeholders. This does some nice things
            // including sanitizing the input with regard to sql commands.
            $statement->bindValue(':book', $book,PDO::PARAM_STR);
            $statement->bindValue(':chapter', $chapter, PDO::PARAM_INT);
            $statement->bindValue(':verse', $verse, PDO::PARAM_INT);
            $statement->bindValue(':content', $content, PDO::PARAM_STR);
    
            $statement->execute();
    
            // get the new id
            $scriptureId = $db->lastInsertId();
    
            //$scriptureId = $statement->rowCount();
    
            //echo "<br>ScriptureID: " . $scriptureId;
    
            // Now go through each topic id in the list from the user's checkboxes
            foreach ($topicIds as $topicId)
            {
                //echo "<br>ScriptureId: $scriptureId, topicId: $topicId<br>";
    
                // Again, first prepare the statement
                $statement = $db->prepare('INSERT INTO scripture_topic(scripture_id, topic_id) VALUES(:scripture_id, :topic_id)');
    
                // Then, bind the values
                $statement->bindValue(':scripture_id', $scriptureId);
                $statement->bindValue(':topic_id', $topicId);
    
                $statement->execute();
            }
    
            $statement->closeCursor();
        }
        catch (Exception $ex)
        {
            // Please be aware that you don't want to output the Exception message in
            // a production environment
            echo "Error with DB. Details: $ex";
            die();
        }
    }

    // Function for adding a new topic to the database
    function addNewTopic($name) {
        
        try {
            // Add the Scripture
            $db = dbConnection2();
            // We do this by preparing the query with placeholder values
            $query = 'INSERT INTO public.topics(topic) VALUES(:name)';
            $statement = $db->prepare($query);

            // Now we bind the values to the placeholders. This does some nice things
            // including sanitizing the input with regard to sql commands.
            $statement->bindValue(':name', $name,PDO::PARAM_STR);

            $statement->execute();

            // get the new id
            $topicId = $db->lastInsertId();

            $statement->closeCursor();

            return $topicId;
        }
        catch (Exception $ex)
        {
            // Please be aware that you don't want to output the Exception message in
            // a production environment
            echo "Error with DB. Details: $ex";
            die();
        }
    }
?>