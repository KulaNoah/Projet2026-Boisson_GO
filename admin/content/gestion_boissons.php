<?php

require './src/php/utils/check_connection.php';

$boissonDAO = new BoissonDAO($cnx);
$boissons = $boissonDAO->getAllBoissons();

?>

<h2>Gestion des boissons</h2>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach($boissons as $boisson): ?>

        <tr>

            <td><?= $boisson->id_boisson ?></td>

            <td><?= $boisson->nom ?></td>

            <td><?= $boisson->prix ?> €</td>

            <td><?= $boisson->stock ?></td>

            <td>

                <a
                    href="index_.php?page=modifier_boisson.php&id=<?= $boisson->id_boisson ?>"
                    class="btn btn-warning btn-sm"
                >
                    Modifier
                </a>

                <a
                    href="index_.php?page=supprimer_boisson.php&id=<?= $boisson->id_boisson ?>"
                    class="btn btn-danger btn-sm"
                >
                    Supprimer
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<a
    href="index_.php?page=ajouter_boisson.php"
    class="btn btn-success"
>
    Ajouter une boisson
</a>