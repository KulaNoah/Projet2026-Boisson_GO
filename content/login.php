<?php

$message = "";

if (isset($_POST['connexion'])) {

    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $utilisateurDAO = new UtilisateurDAO($cnx);
    $utilisateur = $utilisateurDAO->getUtilisateurByEmail($email);

    if ($utilisateur !== null && password_verify($mot_de_passe, $utilisateur->mot_de_passe)) {

        $_SESSION['id_utilisateur'] = $utilisateur->id_utilisateur;
        $_SESSION['utilisateur'] = $utilisateur->email;
        $_SESSION['role'] = $utilisateur->role;

        if ($utilisateur->role === "admin") {
            $_SESSION['admin'] = $utilisateur->email;

            header("Location: admin/index_.php");
            exit();
        }

        header("Location: index_.php");
        exit();

    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}

?>

<h2>Connexion</h2>

<?php if ($message !== ""): ?>
    <div class="alert alert-danger">
        <?= $message ?>
    </div>
<?php endif; ?>

<form method="post">

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" class="form-control" required>
    </div>

    <button type="submit" name="connexion" class="btn btn-primary">
        Se connecter
    </button>

</form>