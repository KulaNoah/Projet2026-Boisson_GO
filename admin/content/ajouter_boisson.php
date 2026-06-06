<?php

require './src/php/utils/check_connection.php';

$message = "";

$categorieDAO = new CategorieDAO($cnx);
$categories = $categorieDAO->getAllCategories();

if (isset($_POST['ajouter'])) {

    $nomImage = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

        $nomImage = time() . "_" . basename($_FILES['image']['name']);

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "assets/images/" . $nomImage
        );
    }

    $boissonDAO = new BoissonDAO($cnx);

    $retour = $boissonDAO->addBoisson(
        $_POST['nom'],
        $_POST['description'],
        (float)$_POST['prix'],
        (int)$_POST['stock'],
        $nomImage,
        (int)$_POST['id_categorie']
    );

    if ($retour !== null) {
        header("Location: index_.php?page=gestion_boissons.php");
        exit();
    } else {
        $message = "Erreur lors de l'ajout.";
    }
}

?>

<h2>Ajouter une boisson</h2>

<?php if ($message !== ""): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label>Prix</label>
        <input type="number" step="0.01" name="prix" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>

    <div class="mb-3">
        <label>Catégorie</label>
        <select name="id_categorie" class="form-control" required>
            <?php foreach ($categories as $categorie): ?>
                <option value="<?= $categorie->id_categorie ?>">
                    <?= $categorie->nom ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" name="ajouter" class="btn btn-success">
        Ajouter
    </button>

</form>