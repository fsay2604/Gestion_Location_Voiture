<?php

class voiture
{
private $_id;
private $_marque;
private $_modele;
private $_category;
private $_passagers;
private $_img;
private $_description;

// Constructeurs / Desctructeurs
public function __construct($fetchedArray = array())
{
    if(!empty($fetchedArray))
    {
        $this->_id = $fetchedArray[0];
        $this->_marque = $fetchedArray[1];
        $this->_modele = $fetchedArray[2];
        $this->_category = $fetchedArray[3];
        $this->_passagers = $fetchedArray[4];
        $this->_img = $fetchedArray[5];
        $this->_description = $fetchedArray[6];
    }
}

public function __destructor(){
    $this->_marque = 0;
    $this->_modele = 0;
    $this->_category = 0;
    $this->_passager = 0;
    $this->_img = 0;
    $this->_description = 0;
}

//  Getters
public function get_id(){
    return $this->_id;
}
public function get_marque(){
    return $this->_marque;
}
public function get_modele(){
    return $this->_modele;
}
public function get_category(){
    return $this->_category;
}
public function get_passagers(){
    return $this->_passagers;
}
public function get_img(){
    return $this->_img;
}
public function get_description(){
    return $this->_description;
}

// Setters
public function set_id($id){
    $this->_id = $id;
}
public function set_marque($marque){
    $this->_marque = $marque;
}
public function set_modele($modele){
    $this->_modele = $modele;
}
public function set_category($category){
    $this->_category = $category;
}
public function set_passagers($passagers){
    $this->_passagers = $passagers;
}
public function set_img($img){
    $this->_img = $img;
}
public function set_description($description){
    $this->_description = $description;
}

public function printDetail()
{
    echo "<h2>" . $this->_marque . " " . $this->_modele . " - " . $this->_category .  "</h2><br>";
    echo "<img src=\"".$this->_img ."\" alt=\"img voiture\" >";
    echo "<p> Passagers: " . $this->_passagers . "</p>";
    echo "<p> Description: " . $this->_description . "</p>";
}

public function get_voitures($filtre)
{
    $sql= "SELECT * FROM tbl_voiture";
    $WHERE="WHERE ";

    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(!empty($filtre))
    {
        if(isset($filtre[0]) && $filtre[0] != "")
            $WHERE = "$WHERE marque='$filtre[0]' AND ";
        if(isset($filtre[1]) && $filtre[1] != 0)
            $WHERE = "$WHERE idCategorie='$filtre[1]' AND ";
        if(isset($filtre[2]) && $filtre[2] != "")
            $WHERE = "$WHERE description REGEXP '$filtre[2]?' AND ";

        $WHERE = "$WHERE 1=1";
        $completeQuery = "$sql $WHERE";
        $query = $BDD->query("$completeQuery");
    }
    else
        $query = $BDD->query("$sql");

    $voitures = array();
    while($row = $query->fetch())
    {
        $temp = new voiture;
        // init des variables de l'objet
        if(isset($row["idVoiture"]))
            $temp->set_id($row["idVoiture"]);
        if(isset($row["marque"]))
            $temp->set_marque($row["marque"]);
        if(isset($row["modele"]))
            $temp->set_modele($row["modele"]);
        if(isset($row["passager"]))
            $temp->set_passagers($row["passager"]);
        if(isset($row["image"]))
            $temp->set_img($row["image"]);
        if(isset($row["description"]))
            $temp->set_description($row["description"]);
        if(isset($row["idCategorie"]))
        {
            $category = $temp->get_listeCategorie();
            $temp->set_category($category[$row["idCategorie"]-1][1]);
        }
        array_push($voitures, $temp);
    }
    $query->closeCursor();  // Fermeture de la requete
    $BDD = null;            // Fermeture de la connection a la BDD

    return $voitures;       // Retourne le tableau de voiture remplis
}

public function get_voiture($id)
{
    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requete SQL
    $query = $BDD->query("SELECT * FROM tbl_voiture WHERE idVoiture=$id");

    while($row = $query->fetch())
    {
        $this->_id = $row["idVoiture"];
        $this->_marque = $row["marque"];
        $this->_modele = $row["modele"];
        $this->_passagers = $row["passager"];
        $this->_img = $row["image"];
        $this->_description = $row["description"];

        $temp = new voiture();
        $category = $temp->get_listeCategorie();
        $this->_category = $category[$row["idCategorie"]-1][1];
    }

    $query->closeCursor();  // Fermeture de la requete
    $BDD = null;            // Fermeture de la connection a la BDD

    return $this;
}

public function get_listeMarque()
{
    $sql = "SELECT DISTINCT marque FROM tbl_voiture ORDER BY marque ASC;"; //Liste une seule fois chaque marque dans la base de donnees.

    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $BDD->query($sql);

    $marques = array();
    while($row = $result->fetch())
        array_push($marques, $row[0]);  // Construction de l'array contenant l'ensemble des marques.

    $result->closeCursor();         // Fermeture de la requete
    $BDD = null;                    // Fermeture de la connection a la BDD

    return $marques;                // Retourne un array contenant la liste de marque disponible
}

public function get_listeCategorie()
{
    $sql = "SELECT DISTINCT idCategorie, categorie FROM tbl_categorie ORDER BY categorie ASC"; //Liste une seule fois chaque marque dans la base de donnees.

    // Connection a la base de donnees.
    $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
    $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $BDD->query($sql);

    $categories = array();
    while($row = $result->fetch())
        array_push($categories, $row);      // Construction de l'array contenant l'ensemble des marques.

    $result->closeCursor();                 // Fermeture de la requete
    $BDD = null;                            // Fermeture de la connection a la BDD

    return $categories;                     // Retourne un array contenant la liste de marque disponible
}
}?>