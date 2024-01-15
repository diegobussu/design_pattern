<?php
require('config/config.php');
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
            $iphones = [];
            $release_year_iphones = "2022";
            for ($i = 1; $i < 14; $i++) {
                $iphoneFactory = new iPhoneStock($i, $release_year_iphones);
                $iphone11 = $iphoneFactory->InfosProduct();
                $iphones[] = $iphone11->getName() . " (" . $iphone11->getReleaseYear() . ")";
            }

            // Affichage des models
            echo "Modèles d'iPhone : " . implode(", ", $iphones);

            echo "<br><br>"; //Sauts de lignes

            $ipads = [];
            $release_year_ipad = "2022";
            for ($j = 1; $j < 14; $j++) {
                $ipadFactory = new iPadStock($j, $release_year_ipad);
                $ipad4 = $ipadFactory->InfosProduct();
                $ipads[] = $ipad4->getName() . " (" . $ipad4->getReleaseYear() . ")";
            }

            // Affichage des models
            echo "Modèles d'iPad : " . implode(", ", $ipads);
        ?>
    </body>
</html>