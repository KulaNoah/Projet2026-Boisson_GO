<?php

$boissonDAO = new BoissonDAO($cnx);

$total = 0;

?>

<h2>Mon panier</h2>

<?php if (
    !isset($_SESSION['panier'])
    || empty($_SESSION['panier'])
): ?>

    <div class="alert alert-info">
        Votre panier est vide.
    </div>

<?php else: ?>

    <table class="table">

        <thead>
            <tr>
                <th>Boisson</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($_SESSION['panier'] as $id_boisson => $quantite): ?>

            <?php

            $boisson = $boissonDAO->getBoissonById(
                (int)$id_boisson
            );

            $sousTotal =
                $boisson->prix * $quantite;

            $total += $sousTotal;

            ?>

            <tr>

                <td><?= $boisson->nom ?></td>

                <td><?= number_format($boisson->prix, 2) ?> €</td>

                <td><?= $quantite ?></td>

                <td><?= number_format($sousTotal, 2) ?> €</td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

    <h3>Total : <?= number_format($total, 2) ?> €</h3>

    <div class="mt-3">

        <a
            href="index_.php?page=valider_commande.php"
            class="btn btn-success"
        >
            Valider la commande
        </a>
         <a 
            href="index_.php?page=vider_panier.php"
            class="btn btn-danger"
        >
            Vider le panier
        </a>
    </div>
    

<?php endif; ?>