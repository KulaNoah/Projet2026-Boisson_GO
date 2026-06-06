<?php

$basePath = dirname(__DIR__);

$pathDb = $basePath . '/db/db_pg_connect.php';
$pathAutoloader = $basePath . '/classes/Autoloader.class.php';

if (file_exists($pathDb) && file_exists($pathAutoloader)) {

    include_once $pathDb;
    include_once $pathAutoloader;

    Autoloader::register();

    $cnx = Connection::getInstance($dsn, $user, $pass);

} else {
    die("Impossible de charger les fichiers");
}