<?php
declare(strict_types=1);

class DetailCommande
{
    public function __construct(
        public readonly int $id_detail,
        public readonly int $id_commande,
        public readonly int $id_boisson,
        public readonly int $quantite,
        public readonly float $prix_unitaire
    ){
    }
}