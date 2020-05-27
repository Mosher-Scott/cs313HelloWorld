<?php
    session_start();
    define("PRIVATE_PATH", dirname(__FILE__));
//define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));

    // Local path for now
    //define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/web');

    // Web path
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);

    // * Can dynamically find everything in URL up to "/acme"
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/web') + 4; // Decides that is where the document root is  Use 4 for local
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);

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
    
    if (ROOT_PATH == "G:\Web Coding\CS313\cs313-php") {
        
        @require_once(ROOT_PATH . "/web/common/phpMethods.php");
        @require_once(ROOT_PATH . '/web/common/dbconnection.php');
        @require_once(ROOT_PATH . '/web/model/products-model.php');
        @require_once(ROOT_PATH . '/web/model/orders-model.php');
        @require_once(ROOT_PATH . '/web/model/misc-model.php');

    } else {

        @require_once(ROOT_PATH . "/common/phpMethods.php");
        @require_once(ROOT_PATH . '/common/dbconnection.php');
        @require_once(ROOT_PATH . '/model/products-model.php');
        @require_once(ROOT_PATH . '/model/orders-model.php');
        @require_once(ROOT_PATH . '/model/misc-model.php');
    }
?>