<?php

class client
{
    //  Variables a enlever et utiliser des set/get avec des requetes mysql?
    private $_nom;
    private $_prenom;
    private $_courriel;
    private $_password;
    private $_pays;
    private $_noPorte;
    private $_rue;
    private $_ville;
    private $_province;
    private $_codePostal;
    private $_typeTel;
    private $_telephone;
    private $_paysDelivrance;
    private $_dateNaissance;
    private $_noPermis;
    private $_dateExpirationPermis;
    private $_preferencePromotion;
    private $_preferenceModalite;

    //  Methods
    public function __construct()
    {

    }

    public function set_client($nom, $prenom, $courriel, $password, $pays, $noPorte, $rue, $ville, $province, $codePostal, $typeTel, $telephone, $paysDelivrance, $dateNaissance, $noPermis, $dateExpriationPermis, $preferencePromotion, $preferenceModalite)
    {
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_courriel = $courriel;
        $this->_password = $password;
        $this->_pays = $pays;
        $this->_noPorte = $noPorte;
        $this->_rue = $rue;
        $this->_ville = $ville;
        $this->_province = $province;
        $this->_codePostal = $codePostal;
        $this->_typeTel = $typeTel;
        $this->_telephone =  $telephone;
        $this->_paysDelivrance = $paysDelivrance;
        $this->_dateNaissance = $dateNaissance;
        $this->_noPermis = $noPermis;
        $this->_dateExpirationPermis = $dateExpriationPermis;
        $this->_preferencePromotion = $preferencePromotion;
        $this->_preferenceModalite = $preferenceModalite;
    }

    public function __destruct()
    {
        $this->_nom = 0;
        $this->_prenom = 0;
        $this->_courriel = 0;
        $this->_password = 0;
        $this->_pays = 0;
        $this->_noPorte = 0;
        $this->_rue = 0;
        $this->_ville = 0;
        $this->_province = 0;
        $this->_codePostal = 0;
        $this->_typeTel = 0;
        $this->_telephone =  0;
        $this->_paysDelivrance = 0;
        $this->_dateNaissance = 0;
        $this->_noPermis = 0;
        $this->_dateExpirationPermis = 0;
        $this->_preferencePromotion = 0;
        $this->_preferenceModalite = 0;
    }

    //  Getters
    public function get_nom(){
        return $this->_nom;
    }
    public function get_prenom(){
        return $this->_prenom;
    }
    public function get_courriel(){
        return $this->_courriel;
    }
    public function get_password(){
        return $this->_password;
    }
    public function get_pays(){
        return $this->_pays;
    }
    public function get_noPorte(){
        return $this->_noPorte;
    }
    public function get_rue(){
        return $this->_rue;
    }
    public function get_ville(){
        return $this->_ville;
    }
    public function get_province(){
        return $this->_province;
    }
    public function get_codePostal(){
        return $this->_codePostal;
    }
    public function get_typeTel(){
        return $this->_typeTel;
    }
    public function get_telephone(){
        return $this->_telephone;
    }
    public function get_paysDelivrance(){
        return $this->_paysDelivrance;
    }
    public function get_dateNaissance(){
        return $this->_dateNaissance;
    }
    public function get_noPermis(){
        return $this->_noPermis;
    }
    public function get_dateExpirationPermis(){
        return $this->_dateExpirationPermis;
    }
    public function get_preferencePromotion(){
        return $this->_preferencePromotion;
    }
    public function get_preferenceModalite(){
        return $this->_preferenceModalite;
    }

    //  Setters
    public function set_nom($nom){
        $this->_nom = $nom;
    }
    public function set_prenom($prenom){
        $this->_prenom = $prenom;
    }
    public function set_courriel($courriel){
        $this->_courriel = $courriel;
    }
    public function set_password($password){
        $this->_password = $password;
    }
    public function set_pays($pays){
        $this->_pays;
    }
    public function set_noPorte($noPorte){
        $this->_noPorte = $noPorte;
    }
    public function set_rue($rue){
       $this->_rue = $rue;
    }
    public function set_ville($ville){
        $this->_ville = $ville;
    }
    public function set_province($province){
        $this->_province = $province;
    }
    public function set_codePostal($codePostal){
        $this->_codePostal = $codePostal;
    }
    public function set_typeTel($typeTel){
        $this->_typeTel = $typeTel;
    }
    public function set_telephone($telephone){
        $this->_telephone = $telephone;
    }
    public function set_paysDelivrance($paysDelivrance){
        $this->_paysDelivrance = $paysDelivrance;
    }
    public function set_dateNaissance($dateNaissance){
        $this->_dateNaissance = $dateNaissance;
    }
    public function set_noPermis($noPermis){
        $this->_noPermis = $noPermis;
    }
    public function set_dateExpriationPermis($dateExpirationPermis){
        $this->_dateExpirationPermis = $dateExpirationPermis;
    }
    public function set_preferencePromotion($preferencePromotion){
        $this->_preferencePromotion = $preferencePromotion;
    }
    public function set_preferenceModalite($preferenceModalite){
        $this->_preferenceModalite = $preferenceModalite;
    }

    // Fonction qui permet d'ajouter dans la base de donnee un client.
    // param: l'ensemble des variables qui vont dans les colonnes de la BDD
    public function add($nom, $prenom, $courriel, $password, $noPorte, $rue, $ville, $province, $codePostal, $typeTel, $telephone, $paysDelivrance, $dateNaissance, $noPermis, $dateExpriationPermis, $preferencePromotion, $preferenceModalite)
    { 
        // Connection a la base de donnees.
        $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
        $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // Verification de l'existence de l'utilisateur dans la BDD
        $query ="SELECT COUNT(*) FROM tbl_client WHERE courriel = '$courriel';";
        $reponse = $BDD->query($query);
        $exist = $reponse->fetch();
        $reponse->closeCursor();

        if(!$exist[0])
        {
            // Requete pour recuperer l'id du pays
            $sqlPays = "SELECT idPays FROM tbl_pays WHERE pays ='$paysDelivrance';";
            $reponse = $BDD->query($sqlPays);
            $pays = $reponse->fetch();
            $idPays = $pays['idPays'];
            $reponse->closeCursor();
        

            // Requete insertion de l'adresses
            $sqlInsertAdresse =    "INSERT INTO tbl_adresse(noPorte, rue, ville, province, codePostal, idPays)
                                    VALUES ('$noPorte', '$rue','$ville','$province','$codePostal','$idPays');";

            $insertAdresse = $BDD->exec($sqlInsertAdresse);

            // Requete de pour trouver l'idAdresse
            $sqlQueryidAdresse = "SELECT idAdresse FROM tbl_adresse WHERE noPorte='$noPorte' AND rue='$rue';";

            // execution de la requete
            $reponse = $BDD->query($sqlQueryidAdresse);
            $Adresse = $reponse->fetch();
            $idAdresse = $Adresse['idAdresse'];
           // $reponse->closeCursor();

            // Requete pour le idTypeTel
            $sqlTypeTel = "SELECT idTypeTel FROM tbl_typetel WHERE typeTel ='$typeTel';";

            // Execution de la requete
            $reponse = $BDD->query($sqlTypeTel);
            $typeTel = $reponse->fetch();
            $idTypeTel = $typeTel['idTypeTel'];
            $reponse->closeCursor();


            // Generation de la date du jour pour l'inserer comme date de creation
            $today = DATE("Y-m-d");
            
            // Requete Client faites à la base de donnees pour inserer le client
            $sqlClient = "INSERT INTO tbl_client (prenom, nom, courriel, mdp, idAdresse, idTypeTel, tel, idPaysDelivrance, noPermis, dateNaissance, dateExp, infoLettre, modalite, dateCreation)
                                VALUES ('$prenom', '$nom', '$courriel', '$password', '$idAdresse', '$idTypeTel', '$telephone', '$idPays', '$noPermis',
                                        '$dateNaissance', '$dateExpriationPermis', '$preferencePromotion', '$preferenceModalite', '$today');";

            // Insertion de l'utilisateur dans la BDD
            $reponse = $BDD->exec($sqlClient);
        }
        else
        {
            echo "<h2 class=\"center\">Cet utilisateur existe deja.</h2>";
        }

        // Fermeture de la requete et de la connexion
        $BDD = null;
    }


    // Fonction qui authentifie un utilisateur
    // param: $username correspond au username a verifier dans la BDD
    // param: $password correspond au password a verifier dans la BDD
    // return true si les identifiants existent dans la BDD
    public function is_authentified($username, $password)
    {
        // Connection a la base de donnees.
        $BDD = new PDO('mysql:host=localhost;dbname=demolocvoiture;charset=utf8', 'root', '');
        $BDD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requete a la base de donnees
        $query = "SELECT COUNT(*) FROM tbl_client WHERE courriel='$username' AND mdp='$password';";
        $reponse = $BDD->query($query);
        $reponse = $reponse->fetch();

        if($reponse[0])
        {
            return true;
        }

        // Fermeture de la connection
      //  $reponse->closeCursor();
        $BDD = null;

       return false;
    }

}

?>