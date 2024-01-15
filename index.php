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
            $iphoneModels = array();

            $iphoneFactory = new iPhoneStock("11");
            $iphone11 = $iphoneFactory->InfosProduct();
            $iphoneModels[] = $iphone11->getName();

            echo "Modèles d'iPhone : " . implode(", ", $iphoneModels);

            echo "<br>";
            
            $ipadFactory = new iPadStock("4");
            $ipad4 = $ipadFactory->InfosProduct();
            $ipadModels[] = $ipad4->getName();

            echo "Modèles d'iPad : " . implode(", ", $ipadModels);
        ?>
    </body>
</html>