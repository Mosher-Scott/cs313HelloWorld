<?php
// Simple search form for W5 team assignment
    function search() {
        echo "<form method='post' action='scrip-results.php'>";
        echo "<input type='text' name='bookToFind'>";
        echo "<button type='submit'>Search</button>";
        echo "</form>";
    }

    // Query the DB for all books with that name
    function searchQuery($name) {
        $db=dbConnection();    
        $stmt = $db->prepare('SELECT * FROM scriptures WHERE book = :name');
        //$name= '$name';
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
?>