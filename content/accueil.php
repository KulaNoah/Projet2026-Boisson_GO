<?php

$boissonDAO = new BoissonDAO($cnx);
$boissons = $boissonDAO->getAllBoissons();

$categorieDAO = new CategorieDAO($cnx);
$categories = $categorieDAO->getAllCategories();

?>

<section class="container my-4">

    <?php if (isset($_SESSION['success'])): ?>

        <div class="position-fixed top-0 end-0 p-3 toast-panier">
            <div id="toastSuccess" class="toast show text-bg-success border-0">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['success']; ?>
                    </div>

                    <button
                        type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        </div>

        <?php unset($_SESSION['success']); ?>

    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>

        <div class="position-fixed top-0 end-0 p-3 toast-panier">
            <div id="toastError" class="toast show text-bg-danger border-0">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= $_SESSION['error']; ?>
                    </div>

                    <button
                        type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast">
                    </button>
                </div>
            </div>
        </div>

        <?php unset($_SESSION['error']); ?>

    <?php endif; ?>

    <div class="text-center mb-4">
        <h2 class="fw-bold">Nos boissons</h2>
        <p class="text-muted">
            Découvrez notre sélection de boissons fraîches.
        </p>
    </div>

    <div class="d-flex justify-content-center flex-wrap gap-2 mb-4">

        <button class="btn btn-primary filtre" data-id="all">
            Toutes
        </button>

        <?php foreach ($categories as $categorie): ?>

            <button
                class="btn btn-outline-primary filtre"
                data-id="<?= $categorie->id_categorie ?>"
            >
                <?= $categorie->nom ?>
            </button>

        <?php endforeach; ?>

    </div>

    <div class="row g-4" id="listeBoissons">

        <?php foreach ($boissons as $boisson): ?>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0 card-boisson">

                    <?php if (!empty($boisson->image)): ?>

                        <img
                            src="admin/assets/images/<?= $boisson->image ?>"
                            class="card-img-top"
                            alt="<?= $boisson->nom ?>"
                        >

                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <h3 class="card-title">
                            <?= $boisson->nom ?>
                        </h3>

                        <p class="card-text text-muted">
                            <?= $boisson->description ?>
                        </p>

                        <p class="fw-bold mb-1">
                            Prix : <?= number_format($boisson->prix, 2) ?> €
                        </p>

                        <p class="mb-2">
                            Stock : <?= $boisson->stock ?>
                        </p>

                        <?php if ($boisson->stock > 0): ?>

                            <span class="badge bg-success mb-3 align-self-start">
                                En stock
                            </span>

                            <a
                                href="index_.php?page=ajouter_panier.php&id=<?= $boisson->id_boisson ?>"
                                class="btn btn-success mt-auto"
                            >
                                Ajouter au panier
                            </a>

                        <?php else: ?>

                            <span class="badge bg-danger mb-3 align-self-start">
                                Rupture
                            </span>

                            <button class="btn btn-secondary mt-auto" disabled>
                                Indisponible
                            </button>

                        <?php endif; ?>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</section>