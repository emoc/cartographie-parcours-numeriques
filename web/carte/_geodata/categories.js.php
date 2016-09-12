<?php

/**
 * cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 *
 * production de la liste des catégories en javascript
 *
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */
 
header('Content-type: text/javascript');


define("IN_CARTO", true);
include("../_inc/init.php");

function my_mb_ucfirst($str) {
    $fc = mb_strtoupper(mb_substr($str, 0, 1));
    return $fc.mb_substr($str, 1);
}

define("DEBUG", false);
if (DEBUG) echo "<!DOCTYPE html>
<html>

<head>
<meta charset=\"utf-8\" />
<title>js catégories</title>
</head>


<body>";

$C = array();
// *****************************************************************************
// une petite liste des activités
if (DEBUG) echo "toutes les activités<br />\n";
$req = "SELECT COUNT(id) AS cid, activite 
        FROM activites 
        GROUP BY activite 
        ORDER BY cid DESC";
//if (DEBUG) mysql_afficher_resultats_bruts($req);
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $C[] = $truc->activite; 
}



if (DEBUG) echo "<hr />";

// *****************************************************************************
// une petite liste des centre d'intérêt
if (DEBUG) echo "tous les centres d'intérêt<br />\n";
$req = "SELECT COUNT(id) AS cid, centre_interet 
        FROM centres_interet 
        GROUP BY centre_interet 
        ORDER BY cid DESC";
//if (DEBUG) mysql_afficher_resultats_bruts($req);
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $C[] = $truc->centre_interet; 
}



if (DEBUG) echo "<hr />";

// *****************************************************************************
// une petite liste des espaces
if (DEBUG) echo "tous les espaces<br />\n";
$req = "SELECT COUNT(id) AS cid, espace 
        FROM espaces 
        GROUP BY espace 
        ORDER BY cid DESC";
//if (DEBUG) mysql_afficher_resultats_bruts($req);
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $C[] = $truc->espace; 
}



if (DEBUG) echo "<hr />";



if (DEBUG) json_dump($C);


$str_js = "";
$str_js .= "var toutes_categories = [\n";  
foreach ($C as $id => $cat) {  
    $str_js .= "\t\"" . trim(my_mb_ucfirst($cat)) . "\",\n";
}
$str_js .= "]\n";  

if (DEBUG) {
    echo "<hr />codage js des lieux : <pre>" . $str_js . "</pre><hr />";
} else echo $str_js;

?>