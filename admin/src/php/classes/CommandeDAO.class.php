<?php

class CommandeDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function addCommande(int $id_utilisateur)
    {
        $query = "SELECT ajouter_commande(:id_utilisateur) AS retour";

        try {
            $stmt = $this->_cnx->prepare($query);
            $stmt->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchColumn(0);

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }
    public function getCommandesByUtilisateur(int $id_utilisateur)
{
    $sql = "SELECT * FROM commande WHERE id_utilisateur = :id_utilisateur ORDER BY date_commande DESC";

    try {
        $stmt = $this->_cnx->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($d) {
            return new Commande(
                id_commande: (int)$d['id_commande'],
                date_commande: (string)$d['date_commande'],
                id_utilisateur: (int)$d['id_utilisateur']
            );
        }, $data);

    } catch (PDOException $e) {
        print $e->getMessage();
        return null;
    }
}
public function getAllCommandes()
{
    $sql = "SELECT * FROM commande ORDER BY date_commande DESC";

    try {

        $stmt = $this->_cnx->prepare($sql);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($d) {

            return new Commande(
                id_commande: (int)$d['id_commande'],
                date_commande: (string)$d['date_commande'],
                id_utilisateur: (int)$d['id_utilisateur']
            );

        }, $data);

    } catch(PDOException $e){

        print $e->getMessage();
        return null;
    }
}
}