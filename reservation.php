<?php session_start() ?>
<?php include_once("./inc/header.php")?>

<?php
if(isset($_SESSION['username']))
{
    // Init contenu des voitures
    include_once("./classe/voiture.class.php");
    $obj = new voiture;
    $voitures = $obj->get_voitures(array());

    // Contenu de la page
    echo    "<h1 class=\"center\">Reservez votre voiture</h1>";

    echo    "<form action=\"traitement.php?action=reservation\" method=\"post\">";
    echo    "<div class=\"reservationContainer\">";
    echo        "<div class=\"reservationInfoContainer\">";
    echo            "<label for=\"debutLocation\">Debut de la location:</label><input type=\"date\" name=\"debutLocation\" id=\"debutLocation\">";
    echo            "<label for=\"finLocation\">Fin de la location:</label><input type=\"date\" name=\"finLocation\" id=\"finLocation\"><br>";
    echo            "<label for=\"age\">Age du locataire:</label><input type=\"text\" name=\"age\" id=\"age\">";
    echo        "</div>";
    echo        "<hr>";
    echo        "<p>Selectionner une voiture:</p>";
    echo            "<div class=\"gridVoiture\">";

                // Boucle pour afficher l'ensemble des voitures
                $arraySize = count($voitures);
                for($i=0; $i<$arraySize; $i++)
                {
                    $marque = $voitures[$i]->get_marque();
                    $modele = $voitures[$i]->get_modele();
                    $image = $voitures[$i]->get_img();
                    $id = $voitures[$i]->get_id();

                    echo "<div>";
                    echo    "<input type=\"radio\" name=\"voiture\" value=\"$id\"> <img src=\"$image\" alt=\"$marque $modele\"><h2>$marque $modele</h2>";
                    echo "</div>";
                }

    echo        "</div>";
    echo       "<input type=\"submit\" value=\"Réserver la voiture\" id=\"reservationSubmit\">";
    echo    "</div>";
    echo    "</form>"; 
}
else 
{
    echo "<h2 class=\"center\">Veuillez vous connecter.</h2><br>";
}
?>

<?php include_once("./inc/footer.php")?>