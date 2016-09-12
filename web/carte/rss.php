<?php

/**
 * cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 *
 * production du flux RSS
 *
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */
 
define("IN_CARTO", true);
include("./_inc/init.php");

define("DEBUG", false);



// variables en GET : un id ou pas ? si id, on renvoie le flux d'un lieu, sinon on renvoie tout
$LIEU = "";
if ($_GET["lieu"] != '') {
	$LIEU = preg_replace("/[^0-9]/", "", $_GET["lieu"]) + 0;
} 

if ($LIEU == "") $TOUT = true;
else $TOUT = false;


$description = "";

// récupérer les données


// *****************************************************************************
// chercher tous les id's des lieux appartenant aux différents réseaux
// en associant les coordonnées géo à chaque lieu,

$req = "SELECT actualites.texte, actualites.date_debut, actualites.date_fin, 
               actualites.titre, actualites.lien, actualites.image, 
               lieux.latitude, lieux.longitude, lieux.nom, lieux.id, lieux.commune  
        FROM actualites, lieux 
        WHERE actualites.id_lieu = lieux.id ";
        
if (!($TOUT)) $req.= "AND lieux.id='" . $LIEU . "' ";

$req.= "AND ( (TO_DAYS(DATE(date_debut)) - (TO_DAYS(CURDATE()))) < 21 )
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
            $df = strftime('%d %B %Y', strtotime($date_fin));
        } else {
            $df = strftime('%d %B %Y à %H:%M', strtotime($date_fin));
        }
    }
    if (substr($date_debut, 0, 4) == "0000") {
        $dd = "";
    } else {
        if (substr($date_debut, 11, 5) == "00:00") { // 0000-00-00 00:00:00
            $dd = strftime('%d %B %Y', strtotime($date_debut));
        } else {
            $dd = strftime('%d %B %Y à %H:%M', strtotime($date_debut));
        }
    }
    
    if ($df == "") $dateok = "Le " . $dd;
    else {$dateok = "Du " . $dd . " au " . $df;
    }

    // Faut il garder cette actualité ?
    // critères : on la garde si
    // aujourdhui - date_debut < 21 (c'est fait par la requête)
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
        $DATES[$id_lieu]["titre"] .= $titre;

        // construction de la description
        $texte  = $commune . ", " . $nom . " / "
                . $dateok . " / "
                . $textebrut;
                
        $DATES[$id_lieu]["description"] = $texte;
        
        $DATES[$id_lieu]["enclosure"] = "";
        
        // construction du lien vers l'image
        $image_local = "./actupix/" . $image;
        $image_url   = "http://parcoursnumeriques.net/carte/actupix/" . $image;
        
        if (is_file($image_local)) {
        
            // récupérer le type
            list($image_width, $image_height, $image_type) = getimagesize($image_local);
            $image_mime = image_type_to_mime_type($image_type);
            
            // récupérer la taille du fichier
            $image_length = filesize($image_local);

            $DATES[$id_lieu]["enclosure"] = "<enclosure url=\"" . $image_url . "\" length=\"" . $image_length. "\" type =\"" . $image_mime . "\" />";
        }
        
        if ($lien != "") $DATES[$id_lieu]["lien"] = $lien;
    }
    
    
}

foreach ($DATES as $idl => $contenu) {
    $A[] = array($DATES[$idl]["titre"], $DATES[$idl]["description"], $DATES[$idl]["enclosure"], $DATES[$idl]["lien"]);
}


// envoyer les entêtes

header("Content-type: text/xml;charset=UTF-8");

echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
echo "<rss version=\"2.0\">\n";
echo "  <channel>\n";
echo "    <title>actualités du réseau parcours numériques</title>\n";
echo "    <description>" . $description . "</description>\n";
echo "    <link>http://www.parcoursnumeriques.net/carte/</link>\n";
echo "    <language>fr-fr</language>\n";
echo "    <lastBuildDate>" . date(DATE_RFC2822) . "</lastBuildDate>\n"; 

for ($i = 0; $i < count($A); $i++) {
    echo "<item>\n";
    echo "<title><![CDATA[" . $A[$i][0] . "]]></title>\n";
    echo "<description><![CDATA[" . $A[$i][1] . "]]></description>\n";  
    echo $A[$i][2];
    echo "<link>" . $A[$i][3] . "</link>\n";
    echo "</item>\n";
}

echo "  </channel>\n";
echo "</rss>\n";


?>