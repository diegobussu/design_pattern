<?php
if (!empty($_POST)) {

    // AJOUTER UN PRODUIT
    if(isset($_POST['form']) && $_POST['form'] === 'product') {

        $_POST = array_map('trim', $_POST);
        $error = false;

        if (empty($_POST['model'])) {
            $error = true;
            flash_in('error', 'Le model est requis.');
        }

        if (empty($_POST['color'])) {
            $error = true;
            flash_in('error', 'La couleur est requise.');
        }

        if (empty($_POST['capacity'])) {
            $error = true;
            flash_in('error', 'La capacité est requise.');
        }
        
        if (empty($_POST['release_year'])) {
            $error = true;
            flash_in('error', 'La date de sortie est requise.');
        }

        if (!is_numeric($_POST['capacity']) || $_POST['capacity'] < 1 || $_POST['capacity'] > 1000) {
            $error = true;
            flash_in('error', 'La capacité doit être un nombre compris entre 1 et 1000.');
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
                $stock = new iPhoneStock();
            } elseif (strpos($modelName, 'ipad') !== false) {
                $stock = new iPadStock();
            } else {
                flash_in('error', 'Modèle non pris en charge.');
                header('Location: index.php');
                exit();
            }

            $stock->addProduct($_POST['model'], $_POST['color'], (int)$_POST['capacity'], $_POST['release_year']);

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
            $stock = new iPhoneStock();
        } elseif (strpos($modelName, 'ipad') !== false) {
            $stock = new iPadStock();
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

