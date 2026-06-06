<?php

class CategorieDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categorie";

        try {
            $stmt = $this->_cnx->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {
                return new Categorie(
                    id_categorie: (int)$d['id_categorie'],
                    nom: (string)$d['nom']
                );
            }, $data);

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }
    public function getCategorieById(int $id_categorie)
{
    $sql = "SELECT * FROM categorie WHERE id_categorie = :id_categorie";

    try {

        $stmt = $this->_cnx->prepare($sql);

        $stmt->bindValue(
            ':id_categorie',
            $id_categorie,
            PDO::PARAM_INT
        );

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$data){
            return null;
        }

        return new Categorie(
            id_categorie: (int)$data['id_categorie'],
            nom: (string)$data['nom']
        );

    } catch(PDOException $e){

        print $e->getMessage();

        return null;
    }
}
}