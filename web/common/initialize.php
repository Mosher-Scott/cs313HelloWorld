<?php
    
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));

    //define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/web');

    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);

    // * Can dynamically find everything in URL up to "/acme"
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/web') + 4; // Decides that is where the document root is  Use 4 for local
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

    //echo $doc_root;

    function urlPath($script_path) {
        if (WWW_ROOT == "/web") {
            if($script_path[0] != '/') {
                $script_path = '/' . $script_path;
                }
            
            return WWW_ROOT . $script_path;
        } else {
            if($script_path[0] != '/') {
                $script_path = '/' . $script_path;
            }
                // echo $script_path;
           return $script_path;
        }
    }

    echo (ROOT_PATH . "/common/phpMethods.php");
    //@require_once(ROOT_PATH . '/common/dbconnection.php');
    //@require_once(ROOT_PATH . '/model/products-model.php');
    //@require_once(ROOT_PATH . '/model/orders-model.php');

    @require_once(ROOT_PATH . "/common/phpMethods.php");
    //@require_once(ROOT_PATH . '/common/dbconnection.php');
    //@require_once(ROOT_PATH . '/model/products-model.php');
    //@require_once(ROOT_PATH . '/model/orders-model.php');

    // Create the links automatically when on the local server
    // function urlPath($script_path) {
    //     // Add the leading / if not present

    //     if($script_path[0] != '/') {
    //         $script_path = '/' . $script_path;
    //     }
        
    //    return WWW_ROOT . $script_path;
    // }

    // For live site
    // function urlPath($script_path) {
    //     // Add the leading / if not present

    //     if($script_path[0] != '/') {
    //         $script_path = '/' . $script_path;
    //     }
    //         // echo $script_path;
    //    return $script_path;
    // }
?>