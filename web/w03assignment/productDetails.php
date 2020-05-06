<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION['cart'] = array();
}

// Set up everything
if (!isset($_SESSION["total"])) {
    $_SESSION["total"] = 0;
    for ($i = 0; $i <count($products); $i++) {
        $_SESSION["qty"][$i] = 0;
        $_SESSION["amounts"][$i] = 0;
    }
}

$products = array("XC Fitness", "Cornering Techniques", "Used Bicycles", "Learning Drops");
$amounts = array("19.99", "10.99", "2.99", "8.99");
?>