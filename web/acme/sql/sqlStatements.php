<?php
    
$query = "INSERT into clients(firstName, lastName, email, password, passPhrase) VALUES('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 'I am the real Ironman')";

$query2 = "UPDATE clients SET clientLevel = 3 WHERE firstName = 'Tony' AND lastName = 'Stark'";

$query3 = "UPDATE inventory SET invName = REPLACE(invName, 'Nylon Rope', 'Climbing Rope'), 
invdescription = REPLACE(invdescription, 'Nylon Rope', 'Climbing Rope')";

$query4 = "SELECT categories.categoryName, invname from inventory inner join categories on categories.categoryid = inventory.categoryid where categories.categoryName = 'misc'";

$query5 = "DELETE from inventory WHERE invId = 7 LIMIT 1"

?>