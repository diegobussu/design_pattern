<?php
require('config/config.php');

$read = $db->prepare('SELECT * FROM products');
$read->execute();

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

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Année de sortie</th>
                    <th>Capacité</th>
                </tr>
            </thead>
            <tbody>
                <?php while($data = $read->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['model'] ?></td>
                    <td><?= $data['color'] ?></td>
                    <td><?= $data['release_year'] ?></td>
                    <td><?= $data['capacity'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button id="createProduct">Ajouter un produit</button>
    </body>
</html>