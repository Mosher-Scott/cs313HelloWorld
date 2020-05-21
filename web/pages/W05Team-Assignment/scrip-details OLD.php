<?php
    
    try
    {
      $dbUrl = getenv('DATABASE_URL');
    
      $dbOpts = parse_url($dbUrl);
    
      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');
    
      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
    
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    }
    catch (PDOException $ex)
        {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }

   

    function validateInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function displayQuery($id, $db) {
   // $db=dbConnection();    
    $stmt = $db->prepare('SELECT * FROM scriptures WHERE id = :id');
    //$name= '$name';
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $book;
    }

    // If the page loads as a POST request, look for this variable, and if it is set
if(isset($_GET['id'])) {
    // This is just for testing to make sure we have the correct text
    //echo "<h1>" . $_POST['bookToFind'] . "</h1>";
    // Validate & sanitize the input
    $searchText = validateInput($_GET['id']);
    // Now run the query to find the text in the database, and then save the results as a variable
    $books = displayQuery($searchText, $db);
  // Change the method name
  print_r($books);
  

  }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <title>CTE341 | Web Backend Development II | Scripture Details</title>

    <link rel="stylesheet" href="/Homepage/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&Oswald&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <?php include 'Homepage/php/header.php'; ?>
    </header>
    <main>
        <div class="main-container">
            <h2 class="page-title">Scripture Details</h2>
         
            <?php  
   foreach ($books as $row)
   {
     echo '<strong>' . $row['book'] .' ' . $row['chapter'] .':' . $row['verse'] . '</strong>';
     echo ' - "' . $row['content'] .'"';
     echo '<br/><br/>';
   }

?>
        </div>
           

    </main>

    <footer>
    
    </footer>
</body>

</html>