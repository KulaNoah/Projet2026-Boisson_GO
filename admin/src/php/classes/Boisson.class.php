<?php
declare(strict_types=1);

class Boisson
{
    public function __construct(
        public readonly int $id_boisson,
        public readonly string $nom,
        public readonly string $description,
        public readonly float $prix,
        public readonly int $stock,
        public readonly string $image,
        public readonly int $id_categorie
    ){
        // gestion des exceptions si nécessaire
    }
}