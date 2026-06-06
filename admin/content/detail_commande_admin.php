<?php

require './src/php/utils/check_connection.php';

if (!isset($_GET['id'])) {
    header("Location: index_.php?page=gestion_commandes.php");
    exit();
}

$id_commande = (int)$_GET['id'];

$detailCommandeDAO = new DetailCommandeDAO($cnx);
$boissonDAO = new BoissonDAO($cnx);

$details = $detailCommandeDAO->getDetailsByCommande($id_commande);

$total = 0;

?>

<h2>Détail commande #<?= $id_commande ?></h2>

<?php if (empty($details)): ?>

    <div class="alert alert-info">
        Aucun détail trouvé.
    </div>

<?php else: ?>

    <table class="table table-bordered table-striped">

        <thead>
            <tr>
                <th>Boisson</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>

        <tbody>

            <?php foreach ($details as $detail): ?>

                <?php

                $boisson = $boissonDAO->getBoissonById(
                    $detail->id_boisson
                );

                $sousTotal =
                    $detail->quantite *
                    $detail->prix_unitaire;

                $total += $sousTotal;

                ?>

                <tr>

                    <td><?= $boisson->nom ?></td>

                    <td><?= $detail->quantite ?></td>

                    <td>
                        <?= number_format(
                            $detail->prix_unitaire,
                            2
                        ) ?> €
                    </td>

                    <td>
                        <?= number_format(
                            $sousTotal,
                            2
                        ) ?> €
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    <h3>
        Total :
        <?= number_format($total, 2) ?> €
    </h3>

<?php endif; ?>

<a
    href="index_.php?page=gestion_commandes.php"
    class="btn btn-secondary"
>
    Retour
</a>