<?php session_start() ?>
<?php
// Vérifie si la variable $_REQUEST contient un champ nommé "nom"
// Si c'est le cas c'est que l'appel provient du formulaire dans la page index.php
if(isset($_REQUEST['action']) && $_REQUEST['action'] == "inscription")
{
    include_once("./inc/header.php");
    include_once("./classe/client.class.php");  

    // Creation de l'objet client
    $Client = new client;

    if(isset($_REQUEST['promotion']))
        $_REQUEST['promotion'] = "Oui";
    else
        $_REQUEST['promotion'] = "Non";

    if(isset($_REQUEST['modalite']))
        $_REQUEST['modalite'] = "Oui";
    else
        $_REQUEST['modalite'] = "Non";

    // ifsset(toute les params)
    $Client->set_client($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['courriel'],
                        $_REQUEST['password'], $_REQUEST['pays'], $_REQUEST['noPorte'], $_REQUEST['rue'],
                        $_REQUEST['ville'], $_REQUEST['province'], $_REQUEST['codePostal'],
                        $_REQUEST['type'], $_REQUEST['telephone'], $_REQUEST['paysDelivrance'],
                        $_REQUEST['naissance'], $_REQUEST['noPermis'], $_REQUEST['expired'],
                        $_REQUEST['promotion'], $_REQUEST['modalite']);

    // Ajoute le client a base de donnees
    $Client->add($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['courriel'],
                $_REQUEST['password'], $_REQUEST['noPorte'], $_REQUEST['rue'],
                $_REQUEST['ville'], $_REQUEST['province'], $_REQUEST['codePostal'],
                $_REQUEST['type'], $_REQUEST['telephone'], $_REQUEST['paysDelivrance'],
                $_REQUEST['naissance'], $_REQUEST['noPermis'], $_REQUEST['expired'],
                $_REQUEST['promotion'], $_REQUEST['modalite']);


    echo "<h1 class=\"center\">Informations recues !</h1><br>";

    //Affichage des infos du client (pas de methode etant donner qu'on ne reutilise pas cette affichage)
    echo "<div class=\"traitementRegNoFloat\">";
        echo "<ul><li class=\"mainLi\">Profil</li>";
        echo "<ul>";
            echo "<li><span class=\"boldFont\">Nom: </span>" . $Client->get_nom() . "</li>";
            echo "<li><span class=\"boldFont\">Prénom: </span>" . $Client->get_prenom() . "</li>";
            echo "<li><span class=\"boldFont\">Courriel: </span>" . $Client->get_courriel() . "</li>";
            echo "<li><span class=\"boldFont\">Mot de passe: </span>" . $Client->get_password() . "</li>";
        echo "</ul></ul>";

        echo "<br>";

        echo "<ul><li class=\"mainLi\">Coordonnées</li>";
        echo "<ul>";
            echo "<li><span class=\"boldFont\">Pays: </span>" . $Client->get_pays() . "</li>";
            echo "<li><span class=\"boldFont\">Adresse: </span>" . $Client->get_noPorte() . " " . $Client->get_rue() . "</li>";
            echo "<li><span class=\"boldFont\">Ville: </span>" . $Client->get_ville() . "</li>";
            echo "<li><span class=\"boldFont\">Province: </span>" . $Client->get_province() . "</li>";
            echo "<li><span class=\"boldFont\">Code postal: </span>" . $Client->get_codePostal() . "</li>";
            echo "<li><span class=\"boldFont\">Type Telephone: </span>" . $Client->get_typeTel() . "</li>";
            echo "<li><span class=\"boldFont\">Telephone: </span>" . $Client->get_telephone() . "</li>";
        echo "</ul></ul>";

        echo "<br>";

        echo "<ul><li class=\"mainLi\">Information conducteur</li>";
        echo "<ul>";
            echo "<li><span class=\"boldFont\">Pays de delivrance: </span>" . $Client->get_paysDelivrance() . "</li>";
            echo "<li><span class=\"boldFont\">Date de naissance: </span>" . $Client->get_dateNaissance() . "</li>";
            echo "<li><span class=\"boldFont\">Numero de permis: </span>" . $Client->get_noPermis() . "</li>";
            echo "<li><span class=\"boldFont\">Date d'expiration: </span>" . $Client->get_dateExpirationPermis() . "</li>";
        echo "</ul></ul>";

        echo "<br>";

        echo "<ul><li class=\"mainLi\">Préférences</li>";
        echo "<ul>";
        echo "<li><span class=\"boldFont\">Infolettre: </span>";
        if($Client->get_preferencePromotion()=="on")
            echo "Oui</li>";
        else
            echo "Non</li>";
        
        echo "<li><span class=\"boldFont\">Modalite: </span>";
        if($Client->get_preferenceModalite()=="on")
             echo "Oui</li>";
         else
             echo "Non</li>";

        echo "</ul></ul>";
    echo "</div>";

}
elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'login')                        // Gestion Login
{
    // Load la class
    include_once("./classe/client.class.php");  

    $Client = new client;

    if($Client->is_authentified($_REQUEST['username'], $_REQUEST['sessPassword']))
    {
        $_SESSION['username'] = $_REQUEST['username']; 
        include_once("./inc/header.php");
      
        echo "<h1 class=\"center\">Bienvenue " . $_SESSION['username'] . "!</h1";
    }
    else
        header('Location: ./login.php?action=error');  
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'deconnected')                  // Gestion  De la connexion
{
    session_destroy();  
    header('Location: ./index.php');                                                        // detruit la session lorsque deconnexion
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == 'reservation')                  // Gestion  des reservations
{
    include_once("./inc/header.php");
   if(isset($_SESSION['username']))
   {             
        if(isset($_REQUEST['voiture']) && isset($_REQUEST['debutLocation']) && $_REQUEST['debutLocation'] > 0)
        {
            // Load la class
             include_once("./classe/reservation.class.php");    

            // Sauvegarde dans la session l'objet reservation
            $reservation = new reservation;
            $reservation->set_reservation(0, 0, $_REQUEST['voiture'], $_REQUEST['debutLocation'], $_REQUEST['finLocation'], $_REQUEST['age']);

            // Ajoute la reservation dans la BDD si le return de add n'a pas d'erreur.
            if($reservation->add($_SESSION['username'], $_REQUEST['voiture'], $_REQUEST['debutLocation'], $_REQUEST['finLocation'], $_REQUEST['age']) == false)
            {
                echo "<div>";
                echo "<h2 class=\"center\"> Merci de votre confiance " . $_SESSION['username'] . "!</h2";
                echo "<br><br>";
                echo "</div>";
                $reservation->printDetail();
            }
            else
               echo "<h2>Réservation non terminée !</h2>"; 
        }
        else
             echo "<h2 class=\"center\">Aucune voiture selectionné ou aucune date de début entrée. Réservation non completée.</h2><br>";
   }
   else
       echo "<h3 class=\"center\"> Veuillez vous connecter! </h3>";
}?>
<?php include_once("./inc/footer.php")?>