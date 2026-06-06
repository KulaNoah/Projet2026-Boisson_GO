<?php

if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: index_.php?page=login.php");
    exit();
}

$commandeDAO = new CommandeDAO($cnx);

$commandes = $commandeDAO->getCommandesByUtilisateur(
    (int)$_SESSION['id_utilisateur']
);

?>

<h2>Mes commandes</h2>

<?php if (empty($commandes)): ?>

    <div class="alert alert-info">
        Vous n'avez encore passé aucune commande.
    </div>

<?php else: ?>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($commandes as $commande): ?>

                <tr>

                    <td>
                        #<?= $commande->id_commande ?>
                    </td>

                    <td>
                        <?= $commande->date_commande ?>
                    </td>

                    <td>

                        <a
                            href="index_.php?page=detail_commande.php&id=<?= $commande->id_commande ?>"
                            class="btn btn-primary btn-sm"
                        >
                            Voir détail
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

<?php endif; ?>