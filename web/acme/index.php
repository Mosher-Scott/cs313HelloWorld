<?php

if (!isset($_SESSION)) {
    session_start();
}

require_once('library/connections.php');
require_once('model/acme-model.php');
include_once('library/functions.php');
require_once('common/initialize.php');



$action = filter_input(INPUT_POST,'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET,'action');
 }

 switch($action) {
     case 'something':

        break;

    default:

        include 'view/home.php';
 }
?>