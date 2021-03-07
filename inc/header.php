<!---   
Laboratoire 4 du cours de développement web.
Objectif: Faire un site web pour gérer la réservation de véhicules automobile.
--->
<?php
  if(!isset($_COOKIE['theme']))
    setCookie('theme', '', 86400, "/");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head >
  <meta charset="utf-8">
  <title>Location de voiture</title>
  <meta name="author" content="François Charles Hébert" />
  <meta name="description" content="DemoLocVoiture" />
  <meta name="keywords" content="laboratoire" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/css.css">

  <!-- L'ensemble des scripts JS a load -->
  <script src="./js/script.js" defer></script>

<?php
  if(isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark-theme')
    echo "<body class=\"dark-theme\">";
  else
    echo "<body class=\"\">";
?>
</head>
<body class="">
<main>
<?php 
  if(isset($_SESSION['username']))
  {
    echo "<a class=\"right\" href=\"./traitement.php?action=deconnected\">Se deconnecter</a>";
  }
  else
  {
    echo "<a class=\"right\" href=\"./login.php\">Se connecter</a>";
  }
?>
    <a class="right" href="./register.php">Inscription</a>
    
    <nav>
        <ul>
        <li><a href="./index.php">Acceuil</a></li>
        <li><a href="./voitures.php">Les voitures</a></li>
        <li><a href="./reservation.php">Réserver une voiture</a></li>
        <li><a href="./mes-reservations.php">Mes réservations</a></li>
        </ul>
    </nav>
    <header>
    <img src="./img/logo.jpg" alt="logo"/>
    </header>