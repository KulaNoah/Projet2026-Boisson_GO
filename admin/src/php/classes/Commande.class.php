<?php
declare(strict_types=1);

class Commande
{
    public function __construct(
        public readonly int $id_commande,
        public readonly string $date_commande,
        public readonly int $id_utilisateur
    ){
    }
}