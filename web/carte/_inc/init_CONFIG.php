<?php

/**
 * cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 *
 * initialisation, petits bouts, fonctions utiles
 *
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */


// renommer en init.php après configuration



if (!defined("IN_CARTO") || !IN_CARTO) exit();

error_reporting(E_ALL & ~E_NOTICE);
//error_reporting(0);

$database = array(
                    "host" => "",               // nom du serveur de base de données
                    "dbname" => "",             // nom de la base de données
                    "username" => "",           // nom de l'utilisateur
                    "password" => ""            // mot de passe de l'utilisateur
                ); 

// *****************************************************************************

// version mysqli
function connexion_base ($requete) {
    global $database;
    $connexion = mysqli_connect($database["host"], $database["username"], $database["password"], $database["dbname"]);
        
    /* check connection */
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    /* change character set to utf8 */
    if (!$connexion->set_charset("utf8")) {
      printf("Error loading character set utf8: %s\n", $connexion->error);
    } 
    mysqli_query($connexion, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
    
    $resultat = mysqli_query ($connexion, $requete)
   	  or die ("Impossible de questionner la base ($requete)");

    $connexion->close();
    
    return $resultat;

}



// DEBUG : présentation basique de résultats 
function mysql_afficher_resultats_bruts($req) {
    $rez = connexion_base($req);
    echo "<pre>";
    while($row = mysqli_fetch_assoc($rez)){
        foreach($row as $cname => $cvalue){
            print "$cname: $cvalue\t";
        }
        print "\r\n";
    }
    echo "</pre>";
}

// *****************************************************************************
// debug

function fast_dump ($truc) {
    echo "<pre>";
    var_dump($truc);
    echo "</pre>";
}

function json_dump($S) {
    echo '<pre>'.json_encode($S, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).'</pre>';
}

// *****************************************************************************
// géo

function haversine_distance($lat1, $lon1, $lat2, $lon2) {
  $R = 6371000; // metres
  $phi1 = deg2rad($lat1);
  $phi2 = deg2rad($lat2);
  $deltaphi = deg2rad($lat2 - $lat1);
  $deltalambda = deg2rad($lon2 - $lon1);
  $a = sin($deltaphi / 2) * sin($deltaphi / 2) +
            cos($phi1) * cos($phi2) *
            sin($deltalambda / 2) * sin($deltalambda / 2);
  $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
  $distance = $R * $c;
  return $distance;
}


// *****************************************************************************
// divers

function nl2br2($string) {
    $string = str_replace(array("\r\n", "\r", "\n"), "<br />", $string);
    return $string; 
}
function ajouter_blancs($str, $ln) {
    $esp = "                             ";
    $str = substr($esp, 0, $ln) . $str;
    return $str;
}

function ajouter_zeros($str, $ln) {
    $esp = "000000000000000000000000000000";
    $str = substr($esp, 0, $ln - strlen($str)) . $str;
    return $str;
}

function ecrire_fichier($fichier, $contenu) {
    $handle = fopen($fichier, "w+");
    fwrite($handle, $contenu);
    fclose($handle);
}

// *****************************************************************************
// mise en page

function form_tableau_deux_colonnes($r) {
    $nb = count($r);
    if (fmod($nb, 2) == 0) $nbcol = $nb / 2;
    else $nbcol = ceil($nb / 2);
    $col1 = "";
    $col2 = "";
    for($i = 0; $i < $nb; $i++) {
        $class ="";
        if ($r[$i]["class"] != "") {
            $class = "class=\"" . $r[$i]["class"] . "\""; 
        }
        if ($i < $nbcol) {
            $col1 .= "<input type=\"checkbox\" $class id=\"".$r[$i]["name"]."\" value=\"1\" " .($r[$i]["checked"] ? 'checked="checked"' : '') . "/>".$r[$i]["display"]."<br />\n";
        } else {
            $col2 .= "<input type=\"checkbox\" $class id=\"".$r[$i]["name"]."\" value=\"1\" " .($r[$i]["checked"] ? 'checked="checked"' : '') . "/>".$r[$i]["display"]."<br />\n";
        }
    }
    echo "<table>\n<tr>\n<td style=\"vertical-align:top;width:50%;\">\n$col1</td>\n<td style=\"vertical-align:top;width:50%;\">\n$col2</td>\n</tr>\n</table>\n";
}
?>