<?php
include('connect.php');
try {
    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASS);
    // set the PDO error mode to exception
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['submit'])) {
        // Récupération des données du formulaire
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['sujet'];
        $message = $_POST['message'];
        // Préparation de la requête SQL pour insérer les données
        $request = $PDO->prepare("INSERT INTO contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
        // Liaison des paramètres à la requête
        $request->bindParam(':name', $name);
        $request->bindParam(':email', $email);
        $request->bindParam(':subject', $subject);
        $request->bindParam(':message', $message);
        // Exécution de la requête
        $request->execute();
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="icon" href="images/logo.png">
</head>
<header>
    <?php include 'header.php'?>
</header>
<body class="contact">
<div class="background">
    <div class="container">
        <div class="style">
            <div class="style-header">
                <div class="style-header-left">
                    <div class="style-button close"></div>
                    <div class="style-button maximize"></div>
                    <div class="style-button minimize"></div>
                </div>
            </div>
            <div class="style-body">
                <div class="style-body-item left">
                    <div class="title">
                        <span>CONTACT</span>
                        <span>FR</span>
                    </div>
                    <div class="form-contact">CONTACT INFO : +33 6 55 32 45 65</div>
                </div>
                <div class="style-body-item">
                    <div class="champ">
                        <input class="form-text" placeholder="NAME">
                    </div>
                    <div class="champ">
                        <input class="form-text" placeholder="EMAIL">
                    </div>
                    <div class="champ">
                        <label class="form-contact" style="font-size: 13px">Quel est le sujet de votre message ?</label>
                        <select name="sujet" class="form-contact-color" required>
                            <option class="color" value="probleme-compte">Problème sur le site</option>
                            <option class="color" value="question-produit">Beug récurrent</option>
                            <option class="color" value="suivi-commande">Je ne retrouve pas ma commande</option>
                            <option class="color" value="postule">Postuler</option>
                            <option class="color" value="autre">Autre...</option>
                        </select>
                    </div>
                    <div class="champ message">
                        <input class="form-text" placeholder="MESSAGE">
                    </div>
                    <div>
                        <button class="button" type="reset">CANCEL</button>
                        <button class="button" type="submit">ENVOYE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<footer>
    <?php include 'footer.php'?>
</footer>
</html>