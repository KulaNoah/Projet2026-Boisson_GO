<?php

class UtilisateurDAO
{
    private PDO $_cnx;

    public function __construct(PDO $_cnx)
    {
        $this->_cnx = $_cnx;
    }

    public function getAllUtilisateurs()
    {
        $sql = "SELECT * FROM utilisateur";

        try {
            $stmt = $this->_cnx->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array_map(function ($d) {
                return new Utilisateur(
                    id_utilisateur: (int)$d['id_utilisateur'],
                    nom: (string)$d['nom'],
                    prenom: (string)$d['prenom'],
                    email: (string)$d['email'],
                    mot_de_passe: (string)$d['mot_de_passe'],
                    role: (string)$d['role']
                );
            }, $data);

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }

    public function getUtilisateurByEmail(string $email)
    {
        $sql = "SELECT * FROM utilisateur WHERE email = :email";

        try {
            $stmt = $this->_cnx->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            }

            return new Utilisateur(
                id_utilisateur: (int)$data['id_utilisateur'],
                nom: (string)$data['nom'],
                prenom: (string)$data['prenom'],
                email: (string)$data['email'],
                mot_de_passe: (string)$data['mot_de_passe'],
                role: (string)$data['role']
            );

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        }
    }
    public function addUtilisateur(
    string $nom,
    string $prenom,
    string $email,
    string $mot_de_passe,
    string $role
) {
    $query = "SELECT ajouter_utilisateur(
        :nom,
        :prenom,
        :email,
        :mot_de_passe,
        :role
    ) AS retour";

    try {

        $stmt = $this->_cnx->prepare($query);

        $stmt->bindValue(':nom', $nom);
        $stmt->bindValue(':prenom', $prenom);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':mot_de_passe', $mot_de_passe);
        $stmt->bindValue(':role', $role);

        $stmt->execute();

        return $stmt->fetchColumn(0);

    } catch(PDOException $e){

        print $e->getMessage();
        return null;
    }
}
public function getUtilisateurById(int $id_utilisateur)
{
    $sql = "SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur";

    try {

        $stmt = $this->_cnx->prepare($sql);

        $stmt->bindValue(
            ':id_utilisateur',
            $id_utilisateur,
            PDO::PARAM_INT
        );

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new Utilisateur(
            id_utilisateur: (int)$data['id_utilisateur'],
            nom: (string)$data['nom'],
            prenom: (string)$data['prenom'],
            email: (string)$data['email'],
            mot_de_passe: (string)$data['mot_de_passe'],
            role: (string)$data['role']
        );

    } catch(PDOException $e){

        print $e->getMessage();
        return null;
    }
}
}