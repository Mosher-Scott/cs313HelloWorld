<?php
    require_once('initialize.php');
    $isLoggedIn = '';

    if ($_SESSION['loggedin'] == TRUE && isset($_SESSION['clientData'])) {
            $isLoggedIn = 'Yes';
    } else {
        $isLoggedIn = 'No';
    }

    
?>
<!DOCTYPE html>     

<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- <title>
    <?php 
        if(isset($prodInfo['invName'])) {
            echo "Modify $prodInfo[invName] ";} 
        elseif(isset($invName)) { 
            echo $invName;
    }?></title> -->
    
    <title>
    <?php if(isset($productName)) {
        echo "$productName | Acme, Inc";
    } elseif(isset($_SESSION['images'])) {
        echo "Image Management";
    }
    else {
        echo "Acme";
    } ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="all" href="<?php echo urlPath('css/stylesheet.css'); ?>">
    <link href="https://fonts.googleapis.com/css?family=Chilanka%7cPermanent+Marker&display=swap" rel="stylesheet">
</head>

<body>
<header>

    <div id="topHeader">
        <div id="logo" class="basicGrid">
            <img src="<?php echo urlPath('images/site/logo.gif'); ?>" title="Acme Company Logo" alt="Acme company logo">
        </div>
        <div id="myAccount">  
            <div id="loggedInName">
                <?php if($isLoggedIn == 'Yes') {
                // echo ("<h4><span>Welcome " . $clientData['clientFirstname'] . "</span></h4>"); 
                echo ("<h4><a href=" . urlPath('/accounts/index.php?action=userAlreadyLoggedIn') . ">Welcome " . $_SESSION['clientData']['clientFirstname'] . "</a></h4>");  
                }
                ?>
            </div>
            <div id="myAccountIcon">
            
            <a href="<?php echo urlPath('/accounts/index.php?action=login'); ?>"> <img src="<?php echo urlPath('images/site/account.gif'); ?>" title="My Account icon" alt="Icon"></a>
            </div>
            <div id="accountText">
            
            <?php
            if ($_SESSION['loggedin'] == TRUE) {
                echo ("<a href=" . urlPath('/accounts/index.php?action=logout') . ">logOut</a>");
            } else {
                echo("<a href=" . urlPath('/accounts/index.php?action=login') . ">Login To My Account</a>");
            }
            ?>
  
            </div>
        </div>
    </div>
</header>
