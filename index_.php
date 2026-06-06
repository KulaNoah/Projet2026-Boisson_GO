<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once __DIR__ . '/admin/src/php/utils/all_includes.php';
?>

<!doctype html>
<html lang="fr">

<head>

    <title>Boisson Go</title>

    <meta charset="utf-8">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        defer
    ></script>

    <link
        rel="stylesheet"
        href="admin/assets/css/style.css"
    >

    <script
        src="admin/assets/js/script.js"
        defer
    ></script>

</head>

<body>

<div id="wrapper">

    <?php
    include __DIR__ . '/admin/src/php/utils/header.php';
    ?>

    <main id="main">

        <section id="contenu">

            <?php

            $page = $_GET['page'] ?? 'accueil.php';

            $path = __DIR__ . '/content/' . $page;

            if (file_exists($path)) {

                include $path;

            } else {

                include __DIR__ . '/content/page_404.php';

            }

            ?>

        </section>

    </main>

    <?php
    include __DIR__ . '/admin/src/php/utils/footer.php';
    ?>

</div>

</body>
</html>