<?php
// Fill in the blanks, or add in your own DB connection method within this function
function dbConnection2() {
    $host = "";
    $db_name = "";
    $user = "";
    $password = "";
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

function dbConnection() {
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
        $db=dbConnection();    
        $stmt = $db->prepare('SELECT * FROM scriptures');
        // $name= "%{$name}%";
        $stmt->execute();
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $book;
    }

    // Query the DB for all books with that name
    function searchQuery($name) {
        $db=dbConnection();    
        $stmt = $db->prepare('SELECT * FROM scriptures WHERE book = :name');
        // $name= "%{$name}%";
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $book;
    }

    // Query for getting all information for a specified book
    function displayQuery($id) {
        $db=dbConnection();    
        $stmt = $db->prepare('SELECT * FROM scriptures WHERE id = :id');
        //$name= '$name';
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $book;
        }

    function getTopics() {
        // Create a connection object from the connection function
        $db = dbConnection();
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

    function getScriptures() {
        try
        {
            $db = dbConnection();
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
                echo '<p>';
                echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
                echo $row['verse'] . '</strong>' . ' - ' . $row['content'];
                echo '<br />';
                echo 'Topics: ';
        
                // get the topics now for this scripture
                $stmtTopics = $db->prepare('SELECT topic FROM topics t'
                    . ' INNER JOIN scripture_topic st ON st.topic_id = t.id'
                    . ' WHERE st.scripture_id = :scripture_id');
        
                $stmtTopics->bindValue(':scripture_id', $row['id']);
                $stmtTopics->execute();
        
                // Go through each topic in the result
                while ($topicRow = $stmtTopics->fetch(PDO::FETCH_ASSOC))
                {
                    echo $topicRow['topic'] . ' ';
                }
        
                echo '</p>';
            }
        
        
        }
        catch (PDOException $ex)
        {
            echo "Error with DB. Details: $ex";
            die();
        }
    }
?>