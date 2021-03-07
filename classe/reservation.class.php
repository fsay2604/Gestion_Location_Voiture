<?php

class reservation
{
//  Variables
private $_idReservation;
private $_idClient;
private $_idVoiture;
private $_dateDebut;
private $_dateFin;
private $_ageLocataire;

// Methodes
public function __construct()
{
}

public function set_reservation($idReservation=0, $idClient=0, $idVoiture, $dateDebut, $dateFin, $ageLocataire)
{
    $this->_idReservation = $idReservation;
    $this->_idClient = $idClient;
    $this->_idVoiture = $idVoiture;
    $this->_dateDebut = $dateDebut;
    $this->_dateFin = $dateFin;
    $this->_ageLocataire = $ageLocataire;
}

public function __destruct()
{
    $this->_idReservation = 0;
    $this->_idClient = 0;
    $this->_idVoiture = 0;
    $this->_dateDebut = 0;
    $this->_dateFin = 0;
    $this->_ageLocataire = 0;
}

public function get_idReservation(){
    return $this->_idReservation;
}
public function get_idClient(){
    return $this->_idCLient;
}
public function get_idVoiture(){
    return $this->_idVoiture;
}
public function get_dateDebut()
{
    return $this->_dateDebut;
}
public function get_dateFin()
{
    return $this->_dateFin;
}
public function get_ageLocataire()
{
    return $this->_ageLocataire;
}

// Fonction qui va chercher les reservation d'un utilisateur dans la base de donnees
// return un array de reservation
public function get_reservations($username)
{
    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recuperation de l'id client
    $query = "SELECT idClient FROM tbl_client WHERE courriel='$username';";
    $reponse = $BDD->query($query);
    $rep = $reponse->fetch();
    $idClient = $rep['idClient'];
    $reponse->closeCursor();

    // Requete pour selectionner l'ensemble des reservations
    $reservations = array();

    $query = "SELECT * FROM tbl_reservation WHERE idCLient='$idClient' ORDER BY dateDebut;";
    $reponse = $BDD->query($query);


    while($row = $reponse->fetch())
    {   
        // set les attributs de la reservations
        $temp = new reservation;
        if(isset($row['dateDebut']) && isset($row['dateFin']) && isset($row['ageLocataire']) && isset($row['idVoiture']))
        {
            $temp->set_reservation($row['idReservation'], $row['idClient'], $row['idVoiture'], $row['dateDebut'], $row['dateFin'], $row['ageLocataire']);
            array_push($reservations, $temp); 
        }
    }

    // Fermeture de la BDD
    $BDD = null;

    return $reservations;
}

//  Setters
public function set_idReservation($idReservation){
    $this->_idReservation = $idReservation;
}
public function set_idClient($idClient){
    $this->_idCLient = $idClient;
}
public function set_idVoiture($idVoiture){
    $this->_idVoiture = $idVoiture;
}
public function set_dateDebut($dateDebut)
{
    $this->_dateDebut = $dateDebut;
}
public function set_dateFin($dateFin)
{
    $this->_dateFin = $dateFin;
}
public function set_ageLocataire($ageLocataire)
{
    $this->_ageLocataire = $ageLocataire;
}

// Fonction qui ajoute dans la BDD une reservation
// param: Les donnees a ajouter dans chaque colonnede la table
public function add($username, $idVoiture, $dateDebut, $dateFin, $age)
{
    $error = false;
    $error_msg = "Erreur: ";

    // Securite avant d'ajouter a la BD
    $tomorrow = date("Y-m-d", strtotime("+1 day"));
    $twoWeeksFromStart = date("Y-m-d", strtotime("$dateDebut +2 week"));
    if($dateDebut < $tomorrow)
    {
        $error_msg = "$error_msg" . "La date de debut doit obligatoirement etre au minimum demain.<br>"; 
        $error = true;
    }
    if($dateFin <= $dateDebut || $dateFin > $twoWeeksFromStart)
    {
        $error_msg = "$error_msg" . "La date de fin de location doit être plus tard que la date de début de location, mais ne pas excéder 2 semaines. <br>";
        $error = true;
    }
    if($age < 25)
    {
        $error_msg = "$error_msg" . "L'age de l'utilisateur doit etre au moins de 25 ans.<br>";
        $error = true;
    }

    if($error == false)
    {
        // Connection a la base de donnees.
        $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
        $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recuperation de l'id client
        $query = "SELECT idClient, noPermis FROM tbl_client WHERE courriel='$username';";
        $reponse = $BDD->query($query);
        $rep = $reponse->fetch();
        $reponse->closeCursor();
        $idClient = $rep['idClient'];

            if($rep['noPermis'] != null)
            {
                // Requete pour ajouter dans la base de donnees une reservation.
                $sql = "INSERT INTO tbl_reservation (idClient, idVoiture, dateDebut, dateFin, ageLocataire) VALUES ('$idClient', '$idVoiture', '$dateDebut', '$dateFin', '$age');";
                $reponse = $BDD->exec($sql);
                $BDD = null;
            }
            else
                echo "Aucun numéro de permis associé à cet utilisateur.";
    }
    else
        echo "<h2>$error_msg</h2>";

    return $error;
}

// Fonction qui delete un enregistrement de la bdd
public function remove($idReservation)
{
    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($idReservation))
    {
        $query = "DELETE FROM tbl_reservation WHERE idReservation='$idReservation'";
        $BDD->exec($query);
    }
    else
        echo "Aucun id definit";

    // Fermeture de la bdd
    $BDD=null;
}

public function printDetail()
{
    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Aller chercher le nom et la marque de la voiture enfonction de l'attribut voiture (id)
    $sql = "SELECT marque, modele FROM tbl_voiture WHERE idVoiture='$this->_idVoiture';";
    $reponse = $BDD->query($sql);
    $rep = $reponse->fetch();
    $modele = "";
    $marque = "";
    if($rep){
        $modele = $rep['modele'];
        $marque = $rep['marque'];
    }

    $reponse->closeCursor();

    echo "<br><br>";
    echo "<div class=\"traitementReg\">";
    echo "<ul>";
    echo    "<li><span class=\"boldFont\">Debut Location: </span>$this->_dateDebut</li>";
    echo    "<li><span class=\"boldFont\">Fin Location: </span> $this->_dateFin</li>";
    echo    "<li><span class=\"boldFont\">Age: </span>$this->_ageLocataire</li>";
    echo    "<li><span class=\"boldFont\">Voiture: </span>$marque $modele</li>";
    echo "</ul>";

    include_once("./classe/voiture.class.php");
    $voiture = new voiture;
    $voiture = $voiture->get_voiture($this->_idVoiture);
    $description = $voiture->get_description();

        echo "<div class=\"description\">";
            echo "<button class=\"btn_description\"><span class=\"btn_desc_value\">Voir la description</span></button>";
        echo "</div>";
        echo "<div class=\"descriptionContainer hide\">";
            echo "<p>" . $description . "</p>";
        echo "</div>";

    echo "</div>";
    }

}
?>