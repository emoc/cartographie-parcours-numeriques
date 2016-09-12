<?php

/**
 * cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 *
 * production de la liste des actualités en javascript
 *
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */
 
header('Content-type: text/javascript');

error_reporting(0);
define("IN_CARTO", true);
include("../_inc/init.php");

define("DEBUG", false);
if (DEBUG) echo "<!DOCTYPE html>
<html>

<head>
<meta charset=\"utf-8\" />
<title>js actualités</title>
</head>


<body>";



// *****************************************************************************
// chercher tous les id's des lieux appartenant aux différents réseaux
// en associant les coordonnées géo à chaque lieu,
// construire le chemin le plus court pour chaque réseau


$req = "SELECT actualites.texte, actualites.date_debut, actualites.date_fin, 
               actualites.titre, actualites.lien, actualites.image, 
               lieux.latitude, lieux.longitude, lieux.nom, lieux.id, lieux.commune  
        FROM actualites, lieux 
        WHERE actualites.id_lieu = lieux.id 
        AND ( (TO_DAYS(DATE(date_debut)) - (TO_DAYS(CURDATE()))) < 21 )
        ORDER BY actualites.date_debut";

$rez = connexion_base($req);
$A = array();

while ($truc = mysqli_fetch_object ($rez)) {

    $id_lieu        = $truc->id;   
    $lien           = $truc->lien; 
    $image          = $truc->image;
    $textebrut      = $truc->texte;
    $titre          = $truc->titre;
    $latitude       = $truc->latitude;
    $longitude      = $truc->longitude;
    $commune        = $truc->commune;
    $nom            = $truc->nom;
    $date_debut     = $truc->date_debut;
    $date_fin       = $truc->date_fin;
    
    // construction de la date en langage clair!   
    setlocale(LC_TIME, 'fr','fr_FR','fr_FR@euro','fr_FR.utf8','fr-FR','fra');

    
    if (substr($date_fin, 0, 4) == "0000") {
        $df = "";
    } else {
        if (substr($date_fin, 11, 5) == "00:00") { // 0000-00-00 00:00:00
            $df = strftime('%d %b', strtotime($date_fin));
        } else {
            $df = strftime('%d %b à %H:%M', strtotime($date_fin));
        }
    }
    if (substr($date_debut, 0, 4) == "0000") {
        $dd = "";
    } else {
        if (substr($date_debut, 11, 5) == "00:00") { // 0000-00-00 00:00:00
            $dd = strftime('%d %b', strtotime($date_debut));
        } else {
            $dd = strftime('%d %b à %H:%M', strtotime($date_debut));
        }
    }
    
    if ($df == "") $dateok = "Le " . $dd;
    else {$dateok = "Du " . $dd . " au " . $df;
    }

    // construction du texte de l'info-bulle
    $texte =  "<div class='leaflet-popup-content-title'>" . $titre . "</div>";
    if (strlen(trim($image != "")) > 0) {
        $texte .= "<img src='./actupix/" . $image . "' width='210' height='140' /><br />";
    } else {
        $texte .= "<br />";
    }
    $texte .= "<strong>" . $commune . ", " . $nom . "</strong><br />"
            . "<strong>" . $dateok . "</strong><br />"
            . nl2br($textebrut)
            . " <a href='" . $lien . "' target='_blank' >+ infos</a>";

    
    // Faut il garder cette actualité ?
    // critères : on la garde si
    // aujourdhui - date_debut < 7 (c'est fait par la requête)
    // ET ( (date_fin != 0000 ET demain <= date_fin) OU (date_fin == 0000 ET demain <= date_debut))
    $keepdate = false;
    
    $demain          = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));
    $hier            = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
    $aujourdhui      = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
    $time_date_fin   = strtotime($date_fin);
    $time_date_debut = strtotime($date_debut);
    
    if (substr($date_fin, 0, 4) == "0000") { // pas de date de fin
        if ($aujourdhui <= $time_date_debut) {
            $keepdate = true;
        }
    } else { // date de fin précisée
        if ($aujourdhui <= $time_date_fin) {
            $keepdate = true;
        }
    }
    

    if ($keepdate) {
        $DATES[$id_lieu]["latitude"] = $latitude;
        $DATES[$id_lieu]["longitude"] = $longitude;
        $DATES[$id_lieu]["texte"] .= $texte;
    }
    
}
if (DEBUG) var_dump($DATES);

foreach ($DATES as $idl => $contenu) {
    $A[] = array($DATES[$idl]["latitude"], $DATES[$idl]["longitude"], $DATES[$idl]["texte"]);
}


/*
var actualites = {
    1 : {   "latitude" : "",
            "longitude" : "",
            "texte" : "ce sera bien",
        },
    2 : {   "latitude" : "",
            "longitude" : "",
            "texte" : "ce sera bien bien",
        },    
}
*/
$str_js = "";
$str_js .= "var actualites = {\n";  
foreach ($A as $id => $actu) {  
    $str_js .= "\t$id : {\t";
    $str_js .= "\"latitude\" : \""      . $actu[0] . "\",\n";
    $str_js .= "\t\t\"longitude\" : \"" . $actu[1] . "\",\n";
    $str_js .= "\t\t\"texte\" : "     . json_encode($actu[2]) . ",\n"; // en ligne
    $str_js .= "\t},\n";
    
    if (DEBUG) {
        $error = json_last_error();
        echo "erreur : " . $error;
        echo "
    0 = JSON_ERROR_NONE
    1 = JSON_ERROR_DEPTH
    2 = JSON_ERROR_STATE_MISMATCH
    3 = JSON_ERROR_CTRL_CHAR
    4 = JSON_ERROR_SYNTAX
    5 = JSON_ERROR_UTF8\n\n";
    }
}
$str_js .= "}\n";  

if (DEBUG) {
    echo "<hr />codage js des actualités : <pre>" . $str_js . "</pre><hr />";
} else echo $str_js;
?>