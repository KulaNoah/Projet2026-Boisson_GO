<?php

$nbArticles = 0;

if (isset($_SESSION['panier'])) {
    $nbArticles = array_sum($_SESSION['panier']);
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index_.php">
            🥤 Boisson Go
        </a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link" href="index_.php">
                🏠 Accueil
            </a>

            <a class="nav-link" href="index_.php?page=panier.php">
                🛒 Panier

                <?php if ($nbArticles > 0): ?>
                    <span class="badge bg-danger">
                        <?= $nbArticles ?>
                    </span>
                <?php endif; ?>
            </a>

            <?php if(isset($_SESSION['id_utilisateur'])): ?>

                <a class="nav-link" href="index_.php?page=mes_commandes.php">
                    📦 Mes commandes
                </a>

                <a
                    class="nav-link text-warning"
                    href="index_.php?page=logout.php"
                >
                    🚪 Déconnexion
                </a>

            <?php else: ?>

                <a
                    class="nav-link"
                    href="index_.php?page=login.php"
                >
                    🔑 Connexion
                </a>

                <a
                    class="nav-link"
                    href="index_.php?page=inscription.php"
                >
                    👤 Inscription
                </a>

            <?php endif; ?>

        </div>

    </div>
</nav>