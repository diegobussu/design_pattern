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
            $add = $db->prepare('INSERT INTO products (model, release_year, color, capacity) VALUES (:model, :release_year, :color, :capacity)');
            $data = [
                ':model' => $_POST['model'],
                ':release_year' => $_POST['release_year'],
                ':color' => $_POST['color'],
                ':capacity' => $_POST['capacity']
            ];
            $add->execute($data);

            flash_in('success', 'Produit ajouté !');
            header('Location: index.php');
            exit();
        }
    }
}
?>

