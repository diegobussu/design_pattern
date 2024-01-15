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
            $factory = new AppleStock();
            $product = $factory->InfosProduct();
            echo $product->getName(); 
        ?>
    </body>
</html>