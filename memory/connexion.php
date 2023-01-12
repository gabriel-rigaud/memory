<?php
include('connect.php');
try {
    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);
    // set the PDO error mode to exception
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Vérification de la soumission du formulaire
if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Préparation de la requête SQL pour sélectionner l'utilisateur en fonction de son login
    $request = $PDO->prepare('SELECT * FROM utilisateurs WHERE login = :login');
    $request->bindParam(':login', $login);

    // Exécution de la requête
    $request->execute();

    // Récupération du résultat de la requête
    $resultat = $request->fetch();

    // Vérification du mot de passe
    if (password_verify($password, $resultat['password'])) {
        // Si le mot de passe est correct, création de la session utilisateur et redirection vers la page d'accueil
        $_SESSION['connexion'] = $resultat['login'];
        header('location: profil.php');
        exit();
    }
    else {
        // Si le mot de passe est incorrect, affichage d'un message d'erreur
        $error_message = "Information Incorrect";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="icon" href="images/logo.png">
</head>
<header>
    <?php include 'header.php'?>
</header>
<body>
<div class="menu">
    <div class="titre">
        <h1>Connexion</h1>
        <p>Connecte toi !</p>
    </div>
    <form action="connexion.php" method="post">
        <div class="cadre">
        <div>
            <label for="login">Votre Login :</label>
            <input type="text" id="login" name="login" placeholder="Entrer votre login" required>
        </div>

        <div>
            <label for="motdepasse">Votre Password :</label>
            <input type="password" id="mdp" name="password" placeholder="Entrer votre password" required>
            <?php
            if (isset($error_message)) {
                echo "<p style='color: white'>$error_message</p>";
            }
            ?>
        </div>
        <div><br>
            <button class="valide" type="submit" name="submit" >Valider</button>
        </div>
        </div>
    </form>
</div>
</body>
<footer>
    <?php include 'footer.php'?>
</footer>
</html>