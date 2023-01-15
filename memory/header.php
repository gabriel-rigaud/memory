<head>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/memory.css">
</head>
<?php
// test si l'utilisateur est connecté
if (isset($_GET['deconnexion'])){
    if($_GET['deconnexion']==true){
        session_unset();
        session_destroy();
        header('Location: index.php');
    }
}
else if(isset($_SESSION['connexion'])){
    $login = $_SESSION['connexion'];
    echo "<nav>
<a href='./'>Accueil</a>
<a href='memory.php'>Mémory</a>
<a href='profil.php'>Profil</a>
<a href='index.php?deconnexion=true'>Déconnexion</a>
<div class='animation start-home'></div>
</nav>
<h3 style='color: white'>Bienvenue $login</h3>
";
    if ($login) {}
}
else{
    echo "<nav>
<a href='./'>Accueil</a>
<a href='contact.php'>Contact</a>
<a href='connexion.php'>Connexion</a>
<a href='inscription.php'>Inscription</a>
<div class='animation start-home'></div>
</nav>";
}
?>