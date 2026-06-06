<?php

class DetailCommandeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function addDetailCommande(
        int $id_commande,
        int $id_boisson,
        int $quantite,
        float $prix_unitaire
    ) {
        $query = "SELECT ajouter_detail_commande(
            :id_commande,
            :id_boisson,
            :quantite,
            :prix_unitaire
        ) AS retour";

        try {
            $stmt = $this->_cnx->prepare($query);

            $stmt->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
            $stmt->bindValue(':id_boisson', $id_boisson, PDO::PARAM_INT);
            $stmt->bindValue(':quantite', $quantite, PDO::PARAM_INT);
            $stmt->bindValue(':prix_unitaire', $prix_unitaire);

            $stmt->execute();

            return $stmt->fetchColumn(0);

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }
    public function getDetailsByCommande(int $id_commande)
{
    $sql = "SELECT * FROM detail_commande WHERE id_commande = :id_commande";

    try {
        $stmt = $this->_cnx->prepare($sql);
        $stmt->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($d) {
            return new DetailCommande(
                id_detail: (int)$d['id_detail'],
                id_commande: (int)$d['id_commande'],
                id_boisson: (int)$d['id_boisson'],
                quantite: (int)$d['quantite'],
                prix_unitaire: (float)$d['prix_unitaire']
            );
        }, $data);

    } catch (PDOException $e) {
        print $e->getMessage();
        return null;
    }
}
}