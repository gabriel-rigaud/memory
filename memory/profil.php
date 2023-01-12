<?php
include('connect.php');
try
{
$options =
[
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
if(!isset($_SESSION['connexion']))
{
    header('location: connexion.php');
    exit();
}

// Récupération de l'identifiant de l'utilisateur connecté
$idverify = $_SESSION['connexion'];

// Vérification de l'envoi du formulaire
    if (isset($_POST['submit'])) {
        // Vérification de la soumission du formulaire
        if (!empty($_POST)) {
            // Récupération des données du formulaire
            $login = $_POST['login'];
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];

            // Vérification que les mots de passe sont identiques
            if ($password == $password2) {
                // Hachage du mot de passe
                $password3 = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
                  //connexion a la PDO
                // Connexion à la base de données
                $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
                // Préparation de la requête SQL pour sélectionner l'utilisateur en fonction de son login
                $request = $PDO->prepare("SELECT * FROM utilisateurs WHERE login = :login");
                $request->bindParam(':login', $login);
            // Exécution de la requête
            $request->execute();
            // Récupération du nombre de résultats
            $row = $request->rowCount();
            // Vérification que l'utilisateur n'existe pas déjà
            if ($row == 0) {
                $request2 = $PDO->prepare("UPDATE `utilisateurs` SET login = :login, prenom = :prenom, nom = :nom, password = :password3 WHERE login = :idverify");
                // Liaison des paramètres à la requête
                $request2->bindParam(':login', $login);
                $request2->bindParam(':prenom', $prenom);
                $request2->bindParam(':nom', $nom);
                $request2->bindParam(':password3', $password3);
                $request2->bindParam(':idverify', $idverify);
                // Exécution de la requête
                $request2->execute();
            }
        }
      }
    }
}
catch(PDOException $pe)
{
   echo 'ERREUR : '.$pe->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="icon" href="images/logo.png">
</head>
<header>
    <?php include 'header.php'?>
</header>
<body>
<div class="menu">
    <div class="titre">
        <h1>Profil</h1>
        <p>Modifié vos informations !</p>
    </div>
    <form action="profil.php" method="post">
        <div class="cadre">
        <div>
            <label for="login">Votre Login :</label>
            <input type="text" id="login" name="login" placeholder="Entrer votre login" value="<?php echo $login?>" required>
        </div>
        <div>
            <label for="first">Votre Prénom :</label>
            <input type="text" id="first" name="prenom" placeholder="Entrer votre prénom" required>
        </div>
        <div>
            <label for="name">Votre Nom :</label>
            <input type="text" id="name" name="nom" placeholder="Entrer votre nom" required>
        </div>
        <div>
            <label for="mdp">Password&nbsp;: </label>
            <input type="password" id="mdp" name="password" placeholder="Entrer votre password" required>
        </div>

        <div>
            <label for="confmdp">Confirmé&nbsp;:</label>
            <input type="password" id="confmdp" name="password2" placeholder="Re rentrer password" required>
        </div>

        <div><br>
            <button class="valide" type="submit" name="submit">Valider</button>
        </div>
        </div>
    </form>
</body>
<footer>
    <?php include 'footer.php'?>
</footer>
</html>
