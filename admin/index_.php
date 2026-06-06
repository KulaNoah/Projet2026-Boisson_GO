<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../index_.php?page=login.php");
    exit();
}

require 'src/php/utils/all_includes.php';
?>

<!doctype html>
<html lang="fr">
<head>
    <title>Administration - Boisson Go</title>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body>
<div id="wrapper">

    <?php
        include __DIR__ . '/src/php/utils/header.php';
    ?>

    <main id="main_admin">
        <section id="contenu">
            <?php
            if (!isset($_SESSION['admin'])) {
                $path = "content/login.php";
            } else {
                if (isset($_GET["page"])) {
                    $_SESSION['page'] = $_GET["page"];
                } else {
                    $_SESSION['page'] = "accueil.php";
                }

                $path = "content/" . $_SESSION["page"];
            }

            if (file_exists($path)) {
                include $path;
            } else {
                include "content/page_404.php";
            }
            ?>
        </section>
    </main>

    <?php
        include __DIR__ . '/src/php/utils/footer.php';
    ?>

</div>
</body>
</html>