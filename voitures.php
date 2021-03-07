<?php session_start() ?>
<?php include_once("./inc/header.php")?>
<?php include_once("./classe/voiture.class.php")?>

<?php

if(isset($_REQUEST['id']))
{
    $voiture = new voiture;
    $voiture->get_voiture($_REQUEST['id']);

    echo "<div class=\"voitureInfo\">";
        $voiture->printDetail();
        echo "<a class=\"right\" href=\"./voitures.php\">Retour a la liste des voitures</a>";
    echo "</div>";

}
else
{
    $voiture = new voiture;
    $listeMarque = $voiture->get_listeMarque();
    $listeCategorie = $voiture->get_listeCategorie();
                    
    echo "<h2> Voitures disponibles! </h2>";

    // Filtrage des voitures 
    echo "<form action=\"./voitures.php\" method=\"get\">";
        echo "<br>";
        echo "<h3> Filtrer les resultats:</h3>";
        echo "<div class=\"filterContainer\">";

        echo "<div class=\"filter\">";                                                                                       // Filtre par marque
        echo "<label for=\"listeMarque\">Marque:</label><br>";
            echo "<select name=\"marque\" id=\"listeMarque\">";
            echo    "<option value=\"\">Toutes</option>";

            $size = count($listeMarque);
            for($i = 0; $i < $size; $i++)
            {
                echo    "<option value=\"" . $listeMarque[$i] . "\">" . $listeMarque[$i] . "</option>";
            }
            echo "</select>";
        echo "</div>";

        echo "<div class=\"filter\">";                                                                                       // Filtre par category
            echo "<label for=\"listeCategorie\">Categorie:</label><br>";
            echo "<select name=\"idCategorie\" id=\"listeCategorie\">";
            echo    "<option value=\"\">Toutes</option>";

            $size = count($listeCategorie); 
            for($i = 0; $i < $size; $i++)
            {
                echo    "<option value=\"" . $listeCategorie[$i][0] . "\">" . $listeCategorie[$i][1] . "</option>";
            }
            echo "</select>";
        echo "</div>";

        echo "<div class=\"filter\">";                                                                                       // Filtre par keywords
            echo "<label for=\"keywords\">Mots-clefs:</label><br>";
            echo "<input type=\"text\" for=\"keywords\" name=\"keywords\" placeholder=\"Entrer un mot-clef...\">";
        echo "</div>";
        
        echo "<div>";
            echo   "<input type=\"submit\" value=\"Filtrer\" id=\"FilterButton\">";
        echo "</div>";
        echo "</div>";
    echo "</form>";
    echo "<hr>";

    // Construction de l'array de filtre
    $filtre = array();
    if(isset($_REQUEST['marque']))
        array_push($filtre, $_REQUEST['marque']);

    if(isset($_REQUEST['idCategorie']))
        array_push($filtre, $_REQUEST['idCategorie']);

    if(isset($_REQUEST['keywords']))
        array_push($filtre, $_REQUEST['keywords']);

    $voiture = new voiture;
    $voitures = $voiture->get_voitures($filtre);

    // Liste de toutes les voitures
    echo "<h3>Selectionner une voiture pour en savoir plus:</h3>";
    echo "<div class=\"voitureListe\">";

    if($size = count($voitures))
    {
        for($i = 0; $i < $size; $i++ )
            echo "<a href=\"./voitures.php?id=" . $voitures[$i]->get_id() . "\">" . $voitures[$i]->get_marque() . " " . $voitures[$i]->get_modele() . "</a><br><br>";
    }
    else
        echo "<h2> Aucune voiture ne correspond aux filtres indiqués.</h2><br>";

    echo "</div>";

}
?>
<?php include_once("./inc/footer.php")?>