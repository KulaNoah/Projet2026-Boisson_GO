<?php

$message = "";

if (isset($_POST['inscription'])) {

    $utilisateurDAO = new UtilisateurDAO($cnx);

    $utilisateurExistant = $utilisateurDAO->getUtilisateurByEmail($_POST['email']);

    if ($utilisateurExistant !== null) {
        $message = "Cet email est déjà utilisé.";
    } else {

       $retour = $utilisateurDAO->addUtilisateur(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),
        "client"
       );

        if ($retour !== null) {
            header("Location: index_.php?page=login.php");
            exit();
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    }
}

?>

<h2>Inscription</h2>

<?php if ($message !== ""): ?>
    <div class="alert alert-danger">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post">

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="nom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Prénom</label>
        <input type="text" name="prenom" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" class="form-control" required>
    </div>

    <button type="submit" name="inscription" class="btn btn-success">
        S'inscrire
    </button>

</form>