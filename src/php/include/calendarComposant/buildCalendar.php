<?php
/* NOUVELLE VERSION DE LA CONSTRUCTION DE L'AGENDA CI DESSOUS */
?>


<?php
// VERIFICATION DES VARIABLES PASSE DANS LA BARRE DE LIEN
$date  = date('Y-m');
if (isset($_GET['date'])) {
    $_GET['date'] = htmlspecialchars($_GET['date']);
    $compoDate = explode('-', $_GET['date']);
    $_GET['date'] = $compoDate[0].'-'.$compoDate[1];
}
if (isset($_POST['month'])) {
    $_POST['month'] = htmlspecialchars($_POST['month']);
}
if (isset($_POST['year'])) {
    $_POST['year'] = htmlspecialchars($_POST['year']);
}

// TODO: A REVOIR
// echo date('Y').'-'.((date('m') - 3)%12+1).'-01';
// $deleteOldEventSQL = "DELETE FROM calendar WHERE dateEvent < :dateRef";
// $deleteOldEvent = $db->prepare($deleteOldEventSQL);
// $deleteOldEvent->execute([
//     'dateRef' => date('Y').'-'.((date('m') - 3)%12+1).'-01'
// ]);


// DEFINITION DE LA TIMEZONE POUR OBTENIR LES INFORMATIONS LIEE AU TEMPS
date_default_timezone_set('Europe/Paris');

$days   = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
$months = array('Janvier', 'Février', 'Mars','Avril', 'Mai', 'Juin','Juillet', 'Aout', 'Septembre','Octobre', 'Novembre', 'Décembre');
$weeks  = array();

// BLOCK DEFINITION DE LA DATE SOUHAITE
if (isset($_GET['date'])) {   // recupère l'année et le mois de la timezone
    $date = $_GET['date'];      // définie la variable $ym tel que $ym = "AAAA-MM"
} else if (!isset($_POST['year']) && !isset($_POST['month'])) { // si le formulaire pour aller a une date précise n'est pas rempli alors
    $date = date('Y-m');  // définir la date a celle de la timezone
} else {    // sinon
    $askMonth = $_POST['month'];
    $askYear  = $_POST['year'];

    if ($askMonth < 1 || $askMonth > 12) {
        $askMonth = $askMonth % 12;
    }
    $date = $askYear.'-'.$askMonth;   // définir le temps a celui demandé par le formulaire
}

// DEFINITION DES VARIABLES NECESSAIRE
$timestamp = strtotime($date, '-01');    // format AAAA-MM
$actualMonth = $months[date('m', $timestamp) - 1].'-'.date('Y', $timestamp);
$today = date('Y-m-d', time());
$posStartDayOfMonth = date('w', mktime(0, 0, 0, date('m', $timestamp), 0, date('Y', $timestamp)));
$week = '';
$week = $week.str_repeat('<td></td>', $posStartDayOfMonth); // ajoute les cases au début pour créer le décallage
$cptDay = date('t', $timestamp);
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));    // $prev --> mois précédent
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));    // $next --> mois suivant


global $db;

// ACQUISITION DES EVENEMENT UTILISATEUR
$checkEventSQL = "SELECT title, dateEvent, description, type FROM calendar WHERE idUser = :idUser";
$checkEvent = $db->prepare($checkEventSQL);
$checkEvent->execute(['idUser'    => $_SESSION['id']]);
$eventDate = array();
$cptEvent = 0;
while ($eventDay = $checkEvent->fetch()) {
    array_push($eventDate, $eventDay);
    $cptEvent++;
}

// ACQUISITION DES REUNIONS GLOBALES POUR PROFS SUIVEURS
if ($_SESSION['promo'] == 0) {
    $PSTofFollower = getPSTForFollower($_SESSION['id']);
    $cptProjectOfFollower = getSizeArray($PSTofFollower);

    $datesProjectMeeting = array();
    $cptDateProject = 0;

    $getEventPSTSQL = "SELECT * FROM calendar WHERE type = :project AND (idUser = :id1 OR idUser = :id2 OR idUser = :id3 OR idUser = :id4 OR idUser = :id5)";
    $getEventPST = $db->prepare($getEventPSTSQL);
    for ($i = 0; $i < $cptProjectOfFollower; $i++) {
        $getEventPST->execute([
            'project' => 'meeting',
            'id1'     => $PSTofFollower[$i]['idProjectManager'],
            'id2'     => $PSTofFollower[$i]['idMember2'],
            'id3'     => $PSTofFollower[$i]['idMember3'],
            'id4'     => $PSTofFollower[$i]['idMember4'],
            'id5'     => $PSTofFollower[$i]['idMember5'],
        ]);

        if ($getEventPST) {
            while ($element = $getEventPST->fetch()) {
                array_push($datesProjectMeeting, $element);
                $cptDateProject++;
            }
        } else {
            echo 'Erreur lors du chargement des évènements de tous les projets suivie ! </br>';
        }
    }
}

// ACQUISITION DES DEADLINES DES CONSIGNES ET DES DEPOTS DE FICHIERS
if ($_SESSION['promo'] != 0) {
    $checkEventOrderSQL = "SELECT step, titleStep, contentOrder, deadLine FROM orderprojects WHERE year = :yearUser";
    $checkEventOrder = $db->prepare($checkEventOrderSQL);
    $checkEventOrder->execute(['yearUser' => $_SESSION['promo']]);

    $checkEventReportSQL = "SELECT * FROM reportorders WHERE year = :yearUser";
    $checkEventReport = $db->prepare($checkEventReportSQL);
    $checkEventReport->execute(['yearUser' => $_SESSION['promo']]);
} else {
    $checkEventOrderSQL = "SELECT step, titleStep, contentOrder, deadLine FROM orderprojects WHERE year BETWEEN 2 AND 5";
    $checkEventOrder = $db->prepare($checkEventOrderSQL);
    $checkEventOrder->execute();

    $checkEventReportSQL = "SELECT * FROM reportorders WHERE year BETWEEN 2 AND 5";
    $checkEventReport = $db->prepare($checkEventReportSQL);
    $checkEventReport->execute();
}
$deadLineOrder = array();
$cptDeadLineOrder = 0;
while ($dateDeadLineOrder = $checkEventOrder->fetch()) {
    array_push($deadLineOrder, $dateDeadLineOrder);
    $cptDeadLineOrder++;
}

$deadLineReport = array();
$cptDeadLineReport = 0;
while ($dateDeadLineReport = $checkEventReport->fetch()) {
    array_push($deadLineReport, $dateDeadLineReport);
    $cptDeadLineReport++;
}

for ($day = 1; $day <= $cptDay; $day++, $posStartDayOfMonth++) {   // Boucle qui parcours le tableau et qui affiche les éléments du calendrier
    if ($day < 10) $day = '0'.$day;
    $dateComplete = $date . '-' . $day;
    $testDateAlreadyWrite = 0;

    // CONSIGNE PST DEADLINE
    if ($testDateAlreadyWrite != 1) {
        for ($i = 0; $i < $cptDeadLineOrder; $i++) {
            if ($dateComplete == $deadLineOrder[$i]['deadLine']) {
                $week .= '<td>';
                $week .= '<a class="eventDay deadLineOrder" href="calendarMenu/infoEvent.php?date='.$deadLineOrder[$i]['deadLine'].'">' . $day.'</a>';
                $i = $cptDeadLineOrder;
                $testDateAlreadyWrite = 1;
            }
        }
    }

    // DEPOT FICHIER DEADLINE
    if ($testDateAlreadyWrite != 1) {
        for ($i = 0; $i < $cptDeadLineReport; $i++) {
            if ($dateComplete == $deadLineReport[$i]['deadLine']) {
                $week .= '<td>';
                $week .= '<a class="eventDay deadLineReport" href="calendarMenu/infoEvent.php?date='.$deadLineReport[$i]['deadLine'].'">' . $day.'</a>';
                $i = $cptDeadLineReport;
                $testDateAlreadyWrite = 1;
            }
        }
    }

    // REUNIONS PST (POUR PROFS)
    if ($_SESSION['promo'] == 0) {
        if ($testDateAlreadyWrite != 1) {
            for ($i = 0; $i < $cptDateProject; $i++) {
                if ($dateComplete == $datesProjectMeeting[$i]['dateEvent']) {
                    $week .= '<td>';
                    $week .= '<a class="eventDay meetingPST" href="calendarMenu/infoEvent.php?date='.$datesProjectMeeting[$i]['dateEvent'].'">' . $day.'</a>';
                    $i = $cptDateProject;
                    $testDateAlreadyWrite = 1;
                }
            }
        }
    }

    // EVENEMENT CLASSIQUE + AUJOURD'HUI
    if ($testDateAlreadyWrite != 1) {
        for ($i = 0; $i < $cptEvent; $i++) {
            if ($dateComplete == $eventDate[$i]['dateEvent'] && $dateComplete == $today) {
                $week .= '<td class="today">';
                $week .= '<a class="eventDay" href="calendarMenu/infoEvent.php?date='.$eventDate[$i]['dateEvent'].'">' . $day.'</a>';
                $i = $cptEvent;
                $testDateAlreadyWrite = 1;
            }
        }
    }

    // EVENEMENT CLASSIQUE
    if ($testDateAlreadyWrite != 1) {
        for ($i = 0; $i < $cptEvent; $i++) {
            if ($dateComplete == $eventDate[$i]['dateEvent']) {
                $week .= '<td>';
                $week .= '<a class="eventDay" href="calendarMenu/infoEvent.php?date='.$eventDate[$i]['dateEvent'].'">' . $day.'</a>';
                $i = $cptEvent;
                $testDateAlreadyWrite = 1;
            }
        }
    }

    // AUJOURD'HUI
    if ($testDateAlreadyWrite != 1) {
        if ($dateComplete == $today) {
            $week .= '<td class="today" style="color: black;">'.$day;
            $testDateAlreadyWrite = 1;
        }
    }

    // JOURS SANS EVENEMENT
    if ($testDateAlreadyWrite != 1) {
        $week .= '<td>' . $day;
        $testDateAlreadyWrite = 1;
    }

    $week .= '</td>';

    if ($posStartDayOfMonth % 7 == 6 || $day == $cptDay) {
       if ($day == $cptDay) {
           $week .= str_repeat('<td></td>', 6 - ($posStartDayOfMonth % 7));
       }

       $weeks[] = '<tr>' . $week . '</tr>';
       $week = '';
    }
}
 ?>
