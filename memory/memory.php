<?php session_start();
if(!isset($_SESSION['connexion']))
{
    header('location: connexion.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<link rel="icon" href="images/logo.png">
</head>
<header>
    <?php include 'header.php'?>
</header>
<br>
<body class="memory">
<div class="colonne" id="liste">

    <div class="titre_centre">
        <p>Cliquez sur les cases pour trouver les correspondances.</p>
    </div>

    <div>
        <p>Vous avez trois minutes,<br>soit <span style="color:#CC3300;">180 secondes :</span><br><br></p>
        <span style="font-size:18px;font-weight:normal;">Votre score :</span>
        <div id="scrore" style="font-size:30px;"><strong>10</strong>/10</div>
        <div id="temps" style="font-size:20px;"></div><br>
        <input type="button" class="btn" value="Nouvelle partie" onClick="window.location.reload()"/>
    </div>

    <div id="grille">
        <div class="case" id="case0"></div>
        <div class="case" id="case1"></div>
        <div class="case" id="case2"></div>
        <div class="case" id="case3"></div>
					
        <div class="case" id="case4"></div>
        <div class="case" id="case5"></div>
        <div class="case" id="case6"></div>
        <div class="case" id="case7"></div>
					
        <div class="case" id="case8"></div>
        <div class="case" id="case9"></div>
        <div class="case" id="case10"></div>
        <div class="case" id="case11"></div>
					
        <div class="case" id="case12"></div>
        <div class="case" id="case13"></div>
        <div class="case" id="case14"></div>
        <div class="case" id="case15"></div>
    </div>
</div>
<script src="app.js"></script>
</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer>
    <?php include 'footer.php'?>
</footer>
</html>