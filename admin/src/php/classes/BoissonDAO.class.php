<?php

class BoissonDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getAllBoissons()
    {
        $sql = "SELECT * FROM boisson";

        try {

            $stmt = $this->_cnx->prepare($sql);

            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {

                return new Boisson(
                    id_boisson: (int)$d['id_boisson'],
                    nom: (string)$d['nom'],
                    description: (string)$d['description'],
                    prix: (float)$d['prix'],
                    stock: (int)$d['stock'],
                    image: (string)$d['image'],
                    id_categorie: (int)$d['id_categorie']
                );

            }, $data);

        } catch (PDOException $e) {

            print $e->getMessage();

            return null;
        }
    }
    public function addBoisson(
    string $nom,
    string $description,
    float $prix,
    int $stock,
    string $image,
    int $id_categorie
) {
    $query = "SELECT ajouter_boisson(
        :nom,
        :description,
        :prix,
        :stock,
        :image,
        :id_categorie
    ) AS retour";

    try {
        $stmt = $this->_cnx->prepare($query);

        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':prix', $prix);
        $stmt->bindValue(':stock', $stock);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(0);

    } catch (PDOException $e) {
        print $e->getMessage();
        return null;
    }
}
public function updateBoisson(
    int $id_boisson,
    string $nom,
    string $description,
    float $prix,
    int $stock,
    string $image,
    int $id_categorie
) {
    $query = "SELECT modifier_boisson(
        :id_boisson,
        :nom,
        :description,
        :prix,
        :stock,
        :image,
        :id_categorie
    ) AS retour";

    try {

        $stmt = $this->_cnx->prepare($query);

        $stmt->bindValue(':id_boisson', $id_boisson, PDO::PARAM_INT);
        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':description', $description);
        $stmt->bindValue(':prix', $prix);
        $stmt->bindValue(':stock', $stock);
        $stmt->bindValue(':image', $image);
        $stmt->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(0);

    } catch(PDOException $e){

        print $e->getMessage();
        return null;
    }
}
public function deleteBoisson(int $id_boisson)
{
    $query = "SELECT supprimer_boisson(:id_boisson) AS retour";

    try {
        $stmt = $this->_cnx->prepare($query);

        $stmt->bindValue(':id_boisson', $id_boisson, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(0);

    } catch (PDOException $e) {
        print $e->getMessage();
        return null;
    }
}
public function getBoissonById(int $id_boisson)
{
    $sql = "SELECT * FROM boisson WHERE id_boisson = :id_boisson";

    try {

        $stmt = $this->_cnx->prepare($sql);

        $stmt->bindValue(
            ':id_boisson',
            $id_boisson,
            PDO::PARAM_INT
        );

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Boisson(
            id_boisson: (int)$data['id_boisson'],
            nom: (string)$data['nom'],
            description: (string)$data['description'],
            prix: (float)$data['prix'],
            stock: (int)$data['stock'],
            image: (string)$data['image'],
            id_categorie: (int)$data['id_categorie']
        );

    } catch (PDOException $e) {

        print $e->getMessage();
        return null;
    }
}
public function getBoissonsByCategorie(int $id_categorie)
{
    $sql = "SELECT * FROM boisson WHERE id_categorie = :id_categorie";

    try {
        $stmt = $this->_cnx->prepare($sql);
        $stmt->bindValue(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function ($d) {
            return new Boisson(
                id_boisson: (int)$d['id_boisson'],
                nom: (string)$d['nom'],
                description: (string)$d['description'],
                prix: (float)$d['prix'],
                stock: (int)$d['stock'],
                image: (string)$d['image'],
                id_categorie: (int)$d['id_categorie']
            );
        }, $data);

    } catch (PDOException $e) {
        print $e->getMessage();
        return null;
    }
}
public function diminuerStock(
    int $id_boisson,
    int $quantite
) {
    $query = "SELECT diminuer_stock_boisson(
        :id_boisson,
        :quantite
    ) AS retour";

    try {
        $stmt = $this->_cnx->prepare($query);

        $stmt->bindValue(':id_boisson', $id_boisson, PDO::PARAM_INT);
        $stmt->bindValue(':quantite', $quantite, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchColumn(0);

    } catch (PDOException $e) {
        print $e->getMessage();
        return null;
    }
}

}