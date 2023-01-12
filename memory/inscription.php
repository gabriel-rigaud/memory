<?php
include('connect.php');
try
{
//configuration des erreurs et enlever l'emulation des requetes préparées
$options =
[
  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_EMULATE_PREPARES => false
];
      //ici on verifie que le boutton submit est utilisé
      if(isset($_POST['submit']))
      {
          $login = $_POST['login'];
          $prenom = $_POST['prenom'];
          $nom = $_POST['nom'];
          $password = $_POST['password'];
          $password2 = $_POST['password2'];

          //ici on verifie que tous les champs sont remplis
          if($login && $prenom && $nom && $password)
          {
              //ici on verifie si les mots de passe sont similaires
              if($password==$password2)
              {
                  //hachage du password
                  $password3 = password_hash($password, PASSWORD_BCRYPT, array('cost' =>10 ));

              //on connecte la base de donnée et on lance la requete préparée pour verifier que le pseudo est disponible
              $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS, $options);
              $request = $PDO->prepare("SELECT*FROM utilisateurs WHERE login = ? ");         
              $request->bindValue(1, $login);
              $request->execute();
                  
              $row = $request->rowCount();
              // var_dump($row);
              // $request->close();
              // $request->closeCursor();
              // $PDO->close();

                     if($row==0)
                     {
                       $request2 = $PDO->prepare("INSERT INTO utilisateurs (`login`, `prenom`, `nom`, `password`) VALUE ('$login','$prenom','$nom','$password3')");
                       $request2->bindValue(1, $login);
                       $request2->bindValue(2, $password);
                       $request2->execute();
                      
                       $request2->closeCursor();
                       // $PDO->close();
                       header('location: connexion.php');
                       exit();

                     }
                     else $erreur= "<p class='erreur_ins'>Ce login est deja utilisé</p>";
                     // else $PDO->close();
              }
              else $erreur= "<p class='erreur_ins'>Les mots de passes ne sont pas similaires</p>";
          }
          else $erreur= "<p class='erreur_ins'> Veuillez renseignez tous les champs</p>";
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
    <title>Inscription</title>
    <link rel="icon" href="images/logo.png">
</head>
<header>
    <?php include 'header.php'?>
</header>
<body>
<div class="menu">
    <div class="titre">
        <h1>Inscription</h1>
        <p>Crée vous un nouveau compte c'est gratuit !</p>
    </div>
    <form action="inscription.php" method="post">
        <div class="cadre">
        <div>
            <label for="name">Votre Nom :</label>
            <input type="text" id="name" name="nom" placeholder="Entrer votre nom">
        </div>

        <div>
            <label for="first">Votre Prénom :</label>
            <input type="text" id="first" name="prenom" placeholder="Entrer votre prénom">
        </div>

        <div>
            <label for="log">Votre Login&nbsp;:</label>
            <input type="text" id="log" name="login" placeholder="Entrer un login">
        </div>

        <div>
            <label for="mdp">Password&nbsp;: </label>
            <input type="password" id="mdp" name="password" placeholder="Entrer un password">
        </div>

        <div>
            <label for="confmdp">Confirmé&nbsp;:</label>
            <input type="password" id="confmdp" name="password2" placeholder="Retapé votre password">
        </div>

        <div><br>
            <button class="valide" type="submit" value="Submit"  name="submit">Valider</button>
            <?php if(isset($erreur)){echo $erreur;}?>
        </div>
        </div>
    </form>
</div>
</body>
<footer>
    <?php include 'footer.php'?>
</footer>
</html>