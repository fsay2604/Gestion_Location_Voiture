<?php 
/*
TO DO:
      CHANGER TOUTE LES PLACES OU INCLUDE LA DATA PAR LE INCLUDE DE LA CLASSE ET UTILISER LES FONCTION GET VOITURE DE LA CLASSE VOITURE POUR ACCEDER AUX DONNEES)
*/
    include_once("./classe/voiture.class.php");

    $voiture = new voiture;
    $voitures = $voiture->get_voitures();     // Contient l'ensemble des donnees des voitures

  ?>