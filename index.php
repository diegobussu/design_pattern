<?php
require('config/config.php');

$read = $db->prepare('SELECT * FROM products');
$read->execute();

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include('partials/head.php'); ?>
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="public/css/styles.css"/>
        <script type="text/javascript" src="public/js/index.js"></script>
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
                    <th>Supprimer</th>
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
                    <td>
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
                            <input type="hidden" name="delete_id" value="<?= $data['id']; ?>">
                            <button type="submit" name="form" value="delete">x</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <button id="createProduct" class="btn-save">Ajouter un produit</button>

        <div class="modal draggable" id="createModal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Ajouter un produit</h2>
            <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
                <div class="form-group">
                    <label for="model">Modèle :</label>
                    <input type="text" id="model" name="model"></input><br><br>

                    <label for="color">Couleur :</label>
                    <input type="text" id="color" name="color"></input><br><br>

                    <label for="capacity">Capacité (en giga) :</label>
                    <input type="number" id="capacity" name="capacity"></input><br><br>

                    <label for="release_year">Année de sortie :</label>
                    <input type="date" id="release_year" name="release_year"></input>
                </div>

                <div class="form-group">
                    <button type="submit" name="form" value="product">Valider</button>
                </div>
            </form>
        </div>
    </div>

    </body>
</html>