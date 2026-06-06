<?php

if (!isset($_GET['id'])) {
    header("Location: index_.php");
    exit();
}

$id_boisson = (int)$_GET['id'];

$boissonDAO = new BoissonDAO($cnx);
$boisson = $boissonDAO->getBoissonById($id_boisson);

if ($boisson === null) {
    $_SESSION['error'] = "Produit introuvable.";
    header("Location: index_.php");
    exit();
}

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

$quantiteActuelle = $_SESSION['panier'][$id_boisson] ?? 0;

if ($quantiteActuelle >= $boisson->stock) {
    $_SESSION['error'] = "Stock insuffisant pour " . $boisson->nom . ".";
    header("Location: index_.php");
    exit();
}

$_SESSION['panier'][$id_boisson] = $quantiteActuelle + 1;

$_SESSION['success'] = "Produit ajouté au panier 🛒";

header("Location: index_.php");
exit();