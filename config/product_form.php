<?php
if (!empty($_POST)) {

    // AJOUTER UN PRODUIT
    if(isset($_POST['form']) && $_POST['form'] === 'product') {

        $_POST = array_map('trim', $_POST);
        $error = false;

        if (empty($_POST['model']) || empty($_POST['color']) || empty($_POST['capacity']) || empty($_POST['release_year']) || empty($_POST['in_stock'])) {
            $error = true;
            flash_in('error', 'Tous les champs sont requis.');
        }

        if (!is_numeric($_POST['capacity']) || $_POST['capacity'] < 1 || $_POST['capacity'] > 1000) {
            $error = true;
            flash_in('error', 'La capacité doit être un nombre compris entre 1 et 1000.');
        }

        if (!is_numeric($_POST['in_stock']) || $_POST['in_stock'] < 1 || $_POST['in_stock'] > 999999) {
            $error = true;
            flash_in('error', 'Le nombre en stock doit être un nombre compris entre 1 et 999 999.');
        }

        if (strlen($_POST['model']) > 30 || strlen($_POST['color']) > 30) {
            $error = true;
            flash_in('error', 'Le contenu est trop long, le nom et la couleur doit etre compris entre 1 et 30 caractères.');
        }

        $timestamp = strtotime($_POST['release_year']);
        if ($timestamp === false || $timestamp === -1) {
            $error = true;
            flash_in('error', 'La date de sortie n\'est pas valide.');
        }

        if (!$error) {
            $modelName = strtolower($_POST['model']);
            $stock = null;

            if (strpos($modelName, 'iphone') !== false) {
                $stock = new iPhoneStock($db);
            } elseif (strpos($modelName, 'ipad') !== false) {
                $stock = new iPadStock($db);
            } else {
                flash_in('error', 'Modèle non pris en charge.');
                header('Location: index.php');
                exit();
            }

            // Récupération des valeurs du formulaire
            $model = $_POST['model'];
            $color = $_POST['color'];
            $capacity = $_POST['capacity'];
            $releaseYear = $_POST['release_year'];
            $in_stock = $_POST['in_stock'];

            // Ajout du produit dans la base de données
            $stock->addProduct($model, $color, $capacity, $releaseYear, $in_stock);

            flash_in('success', 'Produit ajouté !');
            header('Location: index.php');
            exit();
        }
    }

    // SUPPRIMER UN PRODUIT
    if (isset($_POST['form']) && $_POST['form'] === 'delete') {
        
        $deleteId = $_POST['delete_id'];

        $modelName = strtolower($_POST['model']);
        $stock = null;

        if (strpos($modelName, 'iphone') !== false) {
            $stock = new iPhoneStock($db);
        } elseif (strpos($modelName, 'ipad') !== false) {
            $stock = new iPadStock($db);
        } else {
            flash_in('error', 'Modèle non pris en charge.');
            header('Location: index.php');
            exit();
        }

        $stock->deleteProduct($deleteId);

        flash_in('success', 'Produit supprimé !');
        header('Location: index.php');
        exit();
    }
}
?>

