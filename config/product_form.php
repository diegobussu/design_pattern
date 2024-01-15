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

        if (strlen($_POST['model']) > 30 || strlen($_POST['color']) > 30) {
            $error = true;
            flash_in('error', 'Le contenu est trop long, le nom et la couleur doit etre compris entre 1 et 30 caractères.');
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

