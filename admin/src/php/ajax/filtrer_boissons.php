<?php

require_once __DIR__ . "/../utils/all_includes.php";

$boissonDAO = new BoissonDAO($cnx);

if (isset($_GET['id_categorie']) && $_GET['id_categorie'] !== "all") {
    $boissons = $boissonDAO->getBoissonsByCategorie((int)$_GET['id_categorie']);
} else {
    $boissons = $boissonDAO->getAllBoissons();
}

foreach ($boissons as $boisson) {

    echo '
        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0 card-boisson">
    ';

    if (!empty($boisson->image)) {

        echo '
            <img
                src="admin/assets/images/' . $boisson->image . '"
                class="card-img-top"
                alt="' . $boisson->nom . '"
            >
        ';
    }

    echo '
                <div class="card-body d-flex flex-column">

                    <h3 class="card-title">
                        ' . $boisson->nom . '
                    </h3>

                    <p class="card-text text-muted">
                        ' . $boisson->description . '
                    </p>

                    <p class="fw-bold mb-1">
                        Prix : ' . number_format($boisson->prix, 2) . ' €
                    </p>

                    <p class="mb-2">
                        Stock : ' . $boisson->stock . '
                    </p>
    ';

    if ($boisson->stock > 0) {
        echo '
                    <span class="badge bg-success mb-3 align-self-start">
                        En stock
                    </span>
        ';
    } else {
        echo '
                    <span class="badge bg-danger mb-3 align-self-start">
                        Rupture
                    </span>
        ';
    }

    echo '
                    <a
                        href="index_.php?page=ajouter_panier.php&id=' . $boisson->id_boisson . '"
                        class="btn btn-success mt-auto"
                    >
                        Ajouter au panier
                    </a>

                </div>
            </div>
        </div>
    ';
}