<?php

if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: index_.php?page=login.php");
    exit();
}

if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header("Location: index_.php?page=panier.php");
    exit();
}

$commandeDAO = new CommandeDAO($cnx);
$detailCommandeDAO = new DetailCommandeDAO($cnx);
$boissonDAO = new BoissonDAO($cnx);

$id_commande = $commandeDAO->addCommande((int)$_SESSION['id_utilisateur']);

foreach ($_SESSION['panier'] as $id_boisson => $quantite) {

    $boisson = $boissonDAO->getBoissonById((int)$id_boisson);

    $detailCommandeDAO->addDetailCommande(
        (int)$id_commande,
        (int)$id_boisson,
        (int)$quantite,
        (float)$boisson->prix
    );

    $boissonDAO->diminuerStock(
        (int)$id_boisson,
        (int)$quantite
    );
}

unset($_SESSION['panier']);

?>

<h2>Commande validée</h2>

<div class="alert alert-success">
    Votre commande a bien été enregistrée.
</div>

<a href="index_.php" class="btn btn-primary">
    Retour à l'accueil
</a>