<?php

require './src/php/utils/check_connection.php';

$commandeDAO = new CommandeDAO($cnx);
$utilisateurDAO = new UtilisateurDAO($cnx);

$commandes = $commandeDAO->getAllCommandes();

?>

<h2>Gestion des commandes</h2>

<table class="table table-bordered table-striped">

    <thead>
        <tr>
            <th>Commande</th>
            <th>Date</th>
            <th>Client</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach($commandes as $commande): ?>

            <?php
            $utilisateur = $utilisateurDAO->getUtilisateurById(
                $commande->id_utilisateur
            );
            ?>

            <tr>

                <td>
                    #<?= $commande->id_commande ?>
                </td>

                <td>
                    <?= $commande->date_commande ?>
                </td>

                <td>
                    <?= $utilisateur->prenom ?>
                    <?= $utilisateur->nom ?>
                    <br>
                    <small><?= $utilisateur->email ?></small>
                </td>

                <td>
                    <a
                        href="index_.php?page=detail_commande_admin.php&id=<?= $commande->id_commande ?>"
                        class="btn btn-primary btn-sm"
                    >
                        Voir détail
                    </a>
                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>