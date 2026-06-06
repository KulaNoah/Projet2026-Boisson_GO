<?php

require './src/php/utils/check_connection.php';

$message = "";

$boissonDAO = new BoissonDAO($cnx);
$categorieDAO = new CategorieDAO($cnx);

$categories = $categorieDAO->getAllCategories();

if (!isset($_GET['id'])) {
    header("Location: index_.php?page=gestion_boissons.php");
    exit();
}

$id_boisson = (int)$_GET['id'];
$boisson = $boissonDAO->getBoissonById($id_boisson);

if ($boisson === null) {
    header("Location: index_.php?page=gestion_boissons.php");
    exit();
}

if (isset($_POST['modifier'])) {

    $retour = $boissonDAO->updateBoisson(
        $id_boisson,
        $_POST['nom'],
        $_POST['description'],
        (float)$_POST['prix'],
        (int)$_POST['stock'],
        $_POST['image'],
        (int)$_POST['id_categorie']
    );

    if ($retour !== null) {
        header("Location: index_.php?page=gestion_boissons.php");
        exit();
    } else {
        $message = "Erreur lors de la modification.";
    }
}

?>

<h2>Modifier une boisson</h2>

<?php if ($message !== ""): ?>
    <div class="alert alert-danger"><?= $message ?></div>
<?php endif; ?>

<form method="post">

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" value="<?= $boisson->nom ?>" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required><?= $boisson->description ?></textarea>
    </div>

    <div class="mb-3">
        <label>Prix</label>
        <input type="number" step="0.01" name="prix" class="form-control" value="<?= $boisson->prix ?>" required>
    </div>

    <div class="mb-3">
        <label>Stock</label>
        <input type="number" name="stock" class="form-control" value="<?= $boisson->stock ?>" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="text" name="image" class="form-control" value="<?= $boisson->image ?>">
    </div>

    <div class="mb-3">
        <label>Catégorie</label>
        <select name="id_categorie" class="form-control" required>

            <?php foreach ($categories as $categorie): ?>

                <option
                    value="<?= $categorie->id_categorie ?>"
                    <?= $categorie->id_categorie === $boisson->id_categorie ? 'selected' : '' ?>
                >
                    <?= $categorie->nom ?>
                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <button type="submit" name="modifier" class="btn btn-warning">
        Modifier
    </button>

</form>