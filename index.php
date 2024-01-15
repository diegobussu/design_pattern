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
            for ($i = 1; $i < 14; $i++) {
                $iphoneFactory = new iPhoneStock($i);
                $iphone11 = $iphoneFactory->InfosProduct();
                $iphoneModels[] = $iphone11->getName();
            }

            echo "Modèles d'iPhone : " . implode(", ", $iphoneModels);

            echo "<br><br>";
            for ($j = 1; $j < 14; $j++) {
                $ipadFactory = new iPadStock($j);
                $ipad4 = $ipadFactory->InfosProduct();
                $ipadModels[] = $ipad4->getName();
            }

            echo "Modèles d'iPad : " . implode(", ", $ipadModels);
        ?>
    </body>
</html>