<?php
require_once('factory.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include('partials/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="public/css/styles.css"/>
        <title>Accueil</title>
    </head>
    <body>
        <?php include('partials/header.php'); ?><br>

        <?php 
            $iphoneFactory = new iPhoneStock();
            $iphone = $iphoneFactory->InfosProduct();
            echo $iphone->getName(); // Affiche "iPhone"

            $ipadFactory = new iPadStock();
            $ipad = $ipadFactory->InfosProduct();
            echo $ipad->getName();    
        ?>
    </body>
</html>