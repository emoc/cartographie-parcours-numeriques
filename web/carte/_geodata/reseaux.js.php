<?php

/**
 * cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 *
 * production de la liste des réseaux en javascript
 *
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */
 
header('Content-type: text/javascript');

define("IN_CARTO", true);
include("../_inc/init.php");
include("../_inc/convex_hull.php");

define("DEBUG", false);
if (DEBUG) echo "<!DOCTYPE html>
<html>

<head>
<meta charset=\"utf-8\" />
<title>export javascript des informations géographiques</title>
</head>


<body>";

// *****************************************************************************
// chercher tous les id's des lieux appartenant aux différents réseaux
// en associant les coordonnées géo à chaque lieu,

$req = "SELECT reseaux.id_lieu, reseaux.reseau, lieux.latitude, lieux.longitude, lieux.nom 
        FROM reseaux, lieux 
        WHERE reseaux.id_lieu = lieux.id 
        ORDER BY reseau";


// construire un array d'array pour chaque reseau
$R = array();
// construire un array d'array pour chaque ensemble de points
$E = array();

$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {

    $id_lieu        = $truc->id_lieu;      
    $reseau         = $truc->reseau;
    $latitude       = $truc->latitude;
    $longitude      = $truc->longitude;
    $nom            = $truc->nom;

    $R[$reseau][] = array($id_lieu, $reseau, $latitude, $longitude, $nom, "0", "0"); // les deux dernieres correspondent à "lieu inclus dans parcours ?", "place dans le parcours"
    $E[$reseau][] = array($latitude, $longitude);
    
}


// Calculer les envelopes ******************************************************
$ENV = array();
foreach ($E as $nom_reseau => $points) {
    $coords = array();
    $hull = new ConvexHull( $points );
    $coords = $hull->getHullPoints();
    
    foreach($coords as $k => $v) {
        $ENV[$nom_reseau][] = array($v[0], $v[1]);
    }
}


if (DEBUG) echo "<hr />";
if (DEBUG) json_dump($lieux);
if (DEBUG) echo "<hr />";
if (DEBUG) json_dump($R);

// Construire la structure de données à renvoyer, 1re partie *******************
$nr = 0;

$str_js = "var reseaux = [];\n";    
foreach ($R as $nom_reseau => $lieux) {  
    $str_js .= "reseaux[" . $nr . "] = L.polygon([\n"; 

    foreach($ENV[$nom_reseau] as $k => $coord) {
        $str_js .= "\t[" . $coord[0] . ", " . $coord[1] . "],\n";
    }
    $str_js .= "]).setStyle({color:'black', weight:0, opacity:1, fillColor:'#E37459', fillOpacity:0.3, dashArray:'1,5', clickable:false});\n";   
    $nr ++;
}




// *****************************************************************************
// chercher tous les id's des lieux appartenant aux différents réseaux

$req = "SELECT reseaux.id_lieu, reseaux.reseau, lieux.latitude, lieux.longitude, lieux.nom 
        FROM reseaux, lieux 
        WHERE reseaux.id_lieu = lieux.id 
        ORDER BY reseau";

// construire un array d'array pour chaque reseau
$R = array();

$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {

    $id_lieu        = $truc->id_lieu;      
    $reseau         = $truc->reseau;

    $R[$reseau][] = array($id_lieu, $reseau); 
    
}


if (DEBUG) echo "<hr />";
if (DEBUG) json_dump($lieux);
if (DEBUG) echo "<hr />";
if (DEBUG) json_dump($R);


$nr = 0;

$str_js .= "\n\nvar reseaux2 = {\n";    
foreach ($R as $nom_reseau => $lieux) {  
    $str_js .= "\t" . $nr . " : {\"nom\" : \""      . $nom_reseau . "\",\n";
    $str_js .=            "\t\t \"membres\" : [";
    $maxlieux = count($lieux);
    $nblieux = 0;
    foreach($lieux as $li) {
        $str_js .= "\"" . $li[0] . "\"";
        if ($nblieux < $maxlieux - 1) $str_js .= ",";
        $nblieux++;
    }
    $str_js .=            "],\n";
    $str_js .=            "\t\t},\n";
    
    $nr++;
}
$str_js .="}";

if (DEBUG) {
    echo "<hr />codage js des reseaux : <pre>" . $str_js . "</pre><hr />";
} else echo $str_js;
?>
