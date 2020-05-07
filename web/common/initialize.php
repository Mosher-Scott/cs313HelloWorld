<?php
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/web');
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));

     // * Can dynamically find everything in URL up to "/acme"
     $public_end = strpos($_SERVER['SCRIPT_NAME'], '/web') + 5; // Decides that is where the document root is
     $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
     define("WWW_ROOT", $doc_root);

    // Create the links automatically
    function urlPath($script_path) {
        // Add the leading / if not present

        if($script_path[0] != '/') {
            $script_path = '/' . $script_path;
        }

       return WWW_ROOT . $script_path;
    }
?>