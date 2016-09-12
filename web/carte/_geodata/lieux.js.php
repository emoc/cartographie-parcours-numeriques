<?php

/**
 * cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 *
 * production de la liste des lieux en javascript
 *
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */
 
header('Content-type: text/javascript');

define("IN_CARTO", true);
include("../_inc/init.php");

define("DEBUG", false);
if (DEBUG) echo "<!DOCTYPE html>
<html>

<head>
<meta charset=\"utf-8\" />
<title>lieux.js.php</title>
</head>


<body>";

// *****************************************************************************
// tous les lieux dans un beau tableau

if (DEBUG) echo "tous les lieux<br />\n";
$req = "SELECT lieux.* FROM lieux ORDER BY lieux.commune, lieux.nom, lieux.id";


// construire un array d'array pour chaque reseau
$L = array();
$toutid = array(); // tous les ids trouvés dans la table lieux utilisé plus bas 

$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {

    $id                                = $truc->id;   
    $L[$id]["nom"]                     = $truc->nom;    
    $L[$id]["type"]                    = $truc->type;
    $L[$id]["presentation"]            = $truc->presentation;
    $L[$id]["horaires"]                = $truc->horaires;
    $L[$id]["activites_txt"]           = $truc->activites;
    $L[$id]["acces_mobilite_reduite"]  = $truc->acces_mobilite_reduite;
    $L[$id]["lien_article"]            = $truc->lien_article;
    $L[$id]["latitude"]                = trim($truc->latitude);
    $L[$id]["longitude"]               = trim($truc->longitude);
    $L[$id]["adresse"]                 = $truc->adresse;
    $L[$id]["code_postal"]             = $truc->code_postal;
    $L[$id]["commune"]                 = trim($truc->commune);
    $L[$id]["email"]                   = $truc->email;
    $L[$id]["telephone"]               = $truc->telephone;
    $L[$id]["site_web"]                = $truc->site_web;
    $L[$id]["fil_rss"]                 = $truc->fil_rss;
    
    $L[$id]["activites"]               = array();
    $L[$id]["espaces"]                 = array();
    $L[$id]["centres_interet"]         = array();
    $L[$id]["reseaux_sociaux"]         = array();
    
    $toutid[] = $id;

}

$req = "SELECT * FROM reseaux_sociaux ORDER BY id_lieu";
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $id_lieu     = $truc->id_lieu;
    $reseau      = $truc->reseau;
    $lien_reseau = $truc->lien;
    $L[$id_lieu]["reseaux_sociaux"][] = array("$reseau" => "$lien_reseau");
    if (DEBUG) echo $id_lieu . " " . $reseau . " " . $lien_reseau . "<br />";
}

$req = "SELECT * FROM activites ORDER BY id_lieu";
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $id_lieu     = $truc->id_lieu;
    $L[$id_lieu]["activites"][] = trim($truc->activite);
}

$req = "SELECT * FROM centres_interet ORDER BY id_lieu";
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $id_lieu     = $truc->id_lieu;
    $L[$id_lieu]["centres_interet"][] = trim($truc->centre_interet);
}

$req = "SELECT * FROM espaces ORDER BY id_lieu";
$rez = connexion_base($req);
while ($truc = mysqli_fetch_object ($rez)) {
    $id_lieu     = $truc->id_lieu;
    $L[$id_lieu]["espaces"][] = trim($truc->espace);    
}
//if (DEBUG) json_dump($L);

$str_js = "";
$str_js .= "var lieux = {\n";  



// classer le tableau en fonction de la commune ********************************
  
function tri_par_commune($a,$b) {
    return ($a["commune"] <= $b["commune"]) ? -1 : 1;
}
uasort($L, "tri_par_commune");


// préparer les données à renvoyer *********************************************

foreach ($L as $id => $lieu) {  

    $estr_js = "";

    $TXT  = "<div><div class='leaflet-popup-content-title'>" . $L[$id]["nom"] . "</div>";
    if ($L[$id]["lien_article"] != "") {
        $TXT .= "<div class='leaflet-popup-content-articlelink'><a href='" . $L[$id]["lien_article"] . "' target='_blank'>lire l'article</a></div>";
    }
    
    $TXTRS = "";
    
    if ($L[$id]["email"] != "") $TXTRS .= "<a class='icon' href='mailto:".nl2br2($L[$id]["email"])."'><i class='fa fa-envelope'></i></a>";
    if ($L[$id]["site_web"] != "") $TXTRS .= "<a class='icon' href='".nl2br2($L[$id]["site_web"])."' target='_blank'><i class='fa fa-external-link-square'></i></a>";
    
    if (count($L[$id]["reseaux_sociaux"]) > 0) {
    
        foreach($L[$id]["reseaux_sociaux"] as $kk => $vv) {
            foreach ($vv as $k => $v) {
                switch (trim($k)) {
                    case "facebook":
                        $TXTRS .= "<a class='icon' href='$v' title='Facebook' target='_blank'><i class='fa fa-facebook'></i></a>";
                        break;
                    case "google plus":
                        $TXTRS .= "<a class='icon' href='$v' title='Google Plus' target='_blank'><i class='fa fa-google-plus'></i></a>";
                        break;
                    case "youtube":
                        $TXTRS .= "<a class='icon' href='$v' title='YouTube' target='_blank'><i class='fa fa-youtube'></i></a>";
                        break;
                    case "wix":
                        $TXTRS .= "<a class='icon autres' href='$v' title='wix' target='_blank'>w</a>";
                        break;
                    case "twitter":
                        $TXTRS .= "<a class='icon' href='$v' title='Twitter' target='_blank'><i class='fa fa-twitter'></i></a>";
                        break;
                    case "dailymotion":
                        $TXTRS .= "<a class='icon autres' href='$v' title='dailymotion' target='_blank'>dm</a>";
                        break;
                    case "scoop.it":
                        $TXTRS .= "<a class='icon autres' href='$v' title='scoop.it' target='_blank'>sc</a>";
                        break;
                    case "deezer":
                        $TXTRS .= "<a class='icon autres' href='$v' title='deezer' target='_blank'>dz</a>";
                        break;
                    case "linkedin":
                        $TXTRS .= "<a class='icon' href='$v' title='Linkedin' target='_blank'><i class='fa fa-linkedin'></i></a>";
                        break;
                    case "flickr":
                        $TXTRS .= "<a class='icon' href='$v' title='Twitter' target='_blank'><i class='fa fa-flickr'></i></a>";   
                        break;
                    default :
                        $TXTRS .= "<a class='icon' href='$v' title='$k' target='_blank'>";
                        if (strlen($k) >= 2) $TXTRS .= substr($k, 0, 2) . "</a>";
                        else $TXTRS .= "X";
                    
                }
            }
        }
    }
    if ($TXTRS != "") $TXT .= nl2br2("<div id='socialicons'>" . $TXTRS . "</div>");
    //else $TXT .= nl2br2("<br /><br />");
    $TXT .= "<br /><br />";
    
    if ($L[$id]["presentation"] != "") $TXT .= nl2br2($L[$id]["presentation"]). "<br /><br />";
    if ($L[$id]["horaires"] != "") $TXT .= nl2br2($L[$id]["horaires"]). "<br /><br />";
    if ($L[$id]["activites_txt"] != "") $TXT .= nl2br2($L[$id]["activites_txt"]) . "<br /><br />";
    if ($L[$id]["adresse"] != "") $TXT .= nl2br2($L[$id]["adresse"]) . "<br />";
    if ($L[$id]["code_postal"] != "") $TXT .= nl2br2($L[$id]["code_postal"]) . "<br />";
    if ($L[$id]["commune"] != "") $TXT .= nl2br2($L[$id]["commune"]) . "<br /><br />";
    if ($L[$id]["telephone"] != "") $TXT .= nl2br2($L[$id]["telephone"]) . "<br /><br />";
    if ($L[$id]["acces_mobilite_reduite"] == "1") $TXT .= "accès mobilite réduite : oui<br /><br />";
    else $TXT .= "accès mobilite réduite : non<br /><br />";
    
    
    $estr_js .= "\t$id : {\t";
    $estr_js .= "\"latitude\" : \"" . $L[$id]["latitude"]  . "\",\n";
    $estr_js .= "\t\t\"longitude\" : \"" . $L[$id]["longitude"]  . "\",\n";
    $estr_js .= "\t\t\"type\" : \"" . $L[$id]["type"] . "\",\n";
    
    
    // activités ***************************************************************
    $TXTAC = "";
    if (count($L[$id]["activites"]) > 0) {
        $ta = "";
        $i = 0;
        foreach($L[$id]["activites"] as $a) {
            $i++;
            $ta .= "\"" . trim($a) . "\"";
            $TXTAC .= trim($a);
            if ($i < count($L[$id]["activites"])) {
                $ta .= ", ";
                $TXTAC .= ", ";
            }
        }
        $estr_js .= "\t\t\"activites\" : [" . $ta . "],\n";    
    } 
    if ($TXTAC != "") $TXT .= "<p><strong>activités : </strong>" . $TXTAC . "</p>";
    
    
    // centres d'intérêt *******************************************************
    $TXTCI = "";
    if (count($L[$id]["centres_interet"]) > 0) {
        $tc = "";
        $i = 0;
        foreach($L[$id]["centres_interet"] as $c) {
            $i++;
            $tc .= "\"" . trim($c) . "\"";
            $TXTCI .= trim($c);
            if ($i < count($L[$id]["centres_interet"])) {
                $tc .= ", ";
                $TXTCI .= ", ";
            }
        }
        $estr_js .= "\t\t\"centres_interet\" : [" . $tc . "],\n";
    }
    if ($TXTCI != "") $TXT .= "<p><strong>centres d'intérêt : </strong>" . $TXTCI . "</p>";
    
    
    // espaces *****************************************************************
    $TXTES = "";
    if (count($L[$id]["espaces"]) > 0) {
        $te = "";
        $i = 0;
        foreach($L[$id]["espaces"] as $e) {
            $i++;
            $te .= "\"" . trim($e) . "\"";
            $TXTES .= trim($e);
            if ($i < count($L[$id]["espaces"])) {
                $te .= ", ";
                $TXTES .= ", ";
            }
        }
        $estr_js .= "\t\t\"espaces\" : [" . $te . "],\n";
    }
    if ($TXTES != "") $TXT .= "<p><strong>espaces : </strong>" . $TXTES . "</p>";
    
    $TXT .= "<span style='color:#dddddd;font-size:10px;'>$id</span>";
    $TXT .= "</div>";
    //$TXT = addslashes($TXT); 
    $TXT = json_encode($TXT);
    $estr_js .= "\t\t\"commune\" : " . json_encode($L[$id]["commune"]) . ",\n";
    $estr_js .= "\t\t\"titre\" : " . json_encode($L[$id]["nom"]) . ",\n";
    $estr_js .= "\t\t\"texte\" : " . $TXT . ",\n";

    $estr_js .= "\t},\n";
    
    // ICI on ajoute uniquement si les conditions sont remplies
    // cad. : le lieu a une fiche, une latitude et une longitude définies
    $addit = TRUE;
    
    if (!in_array($id, $toutid)) $addit = FALSE;   
    
    if (!isset($L[$id]["latitude"])) $addit = FALSE; 
    else {
        if ($L[$id]["latitude"] == '') $addit = FALSE; 
        if (!is_numeric($L[$id]["latitude"])) $addit = FALSE; 
    }
     
    if (!isset($L[$id]["longitude"])) $addit = FALSE; 
    else {
        if ($L[$id]["longitude"] == '') $addit = FALSE; 
        if (!is_numeric($L[$id]["longitude"])) $addit = FALSE; 
    }
    
    if ($addit) $str_js .= $estr_js;
    
}
$str_js .= "}\n";  



if (DEBUG) {
    echo "<hr />codage js des lieux : <pre>" . $str_js . "</pre><hr />";
} else echo $str_js;
?>