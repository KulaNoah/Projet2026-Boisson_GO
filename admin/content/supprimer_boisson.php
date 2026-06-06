<?php

require './src/php/utils/check_connection.php';

if (!isset($_GET['id'])) {
    header("Location: index_.php?page=gestion_boissons.php");
    exit();
}

$id_boisson = (int)$_GET['id'];

$boissonDAO = new BoissonDAO($cnx);

$boissonDAO->deleteBoisson($id_boisson);

header("Location: index_.php?page=gestion_boissons.php");
exit();