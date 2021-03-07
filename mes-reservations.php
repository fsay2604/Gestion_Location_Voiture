<?php 
    session_start();
    include_once("./classe/reservation.class.php"); 
    include_once("./classe/voiture.class.php");
?>

<?php
    if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'deleteReservation' && isset($_REQUEST['idReservation']))
    {
        $reservations = new reservation;
        $reservation = $reservations->get_reservations($_SESSION['username']);
        $reservations->remove($_REQUEST['idReservation']);
    }
?>
<?php include_once("./inc/header.php")?>

<?php
    if(isset($_SESSION['username']))
    { 
        $reservations = new reservation;
        $reservation = $reservations->get_reservations($_SESSION['username']);

        if(isset($reservation[0]))
        {
            // Generation de la date du jour pour l'inserer comme date de creation
            $today = DATE('Y-m-d');

            // Classement des reservations
            $upcomingReservation = array();
            $pastReservation = array();
            $arraySize = count($reservation);
            for($i = 0; $i<$arraySize; $i++)
            {
                if($reservation[$i]->get_dateDebut() >= $today)
                    array_push($upcomingReservation, $reservation[$i]);
                else
                    array_push($pastReservation,$reservation[$i]);
            }

            // Affichage des reservations a venir
            $arraySize = count($upcomingReservation);
            echo "<h3 class=\"center\">Reservation a venir:</h3><br>";
            for($i=0; $i < $arraySize; $i++)
            {
                $voiture = new voiture();
                $voiture = $voiture->get_voiture($upcomingReservation[$i]->get_idVoiture());
                $upcomingReservation[$i]->printDetail();
                echo "<img class=\"mesReservationImg\" src=\"" .  $voiture->get_img() . "\"  alt=\"" . $upcomingReservation[$i]->get_idVoiture() . "\">";

                echo "<div class=\"deleteContainer\">";
                echo "<a class=\"deleteReservation\" href=\"./mes-reservations.php?action=deleteReservation&idReservation=" . $upcomingReservation[$i]->get_idReservation() . "\">Annuler la reservation</a>";
                echo "</div>";
            }

            // Affichage de l'historique
            $arraySize = count($pastReservation);
            echo "<br><hr>";
            echo "<h3 class=\"center\">Historique des reservations:</h3><br>";
            for($i=0; $i < $arraySize; $i++)
            {
                $voiture = new voiture();
                $voiture = $voiture->get_voiture($pastReservation[$i]->get_idVoiture());
                $pastReservation[$i]->printDetail();
               // echo "<div class=\"deleteContainer\">";
                echo "<img class=\"mesReservationImg\" src=\"" .  $voiture->get_img() . "\"  alt=\"" . $pastReservation[$i]->get_idVoiture() . "\">";
              //  echo "</div>";
            }
        }
        else
            echo "<h2 class=\"center\">Vous n'avez aucune reservation. </h2>";
    }
    else
        echo "<h2 class=\"center\"> Veuillez vous connecter! </h2>";
?>

<?php include_once("./inc/footer.php")?>