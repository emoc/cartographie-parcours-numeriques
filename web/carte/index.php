<?php

/**
 * accès public pour la cartographie parcours numériques
 * http://parcoursnumeriques.net/carte/
 * PHP version 5.3
 * @author     Pierre Commenge <pierre@lesporteslogiques.net>
 * @copyright  2015-2016
 */
 
 

//error_reporting(E_ALL & ~E_NOTICE);
define("IN_CARTO", true);
include("./_inc/init.php");


/* récupérer les valeurs en GET pour les cartes "embed" ************************
   embed, zoom, lat, lng **************************************************** */

$MODE = "normal";
$LATBASE = 47.4020674;
$LAT = $LATBASE;
$LNGBASE = -2.4115;
$LNG = $LNGBASE;
$ZOOM = 8;

if (isset($_GET["embed"]) && ($_GET["embed"] == "embed")) {
    $MODE = "embed";
    $LAT  = preg_replace("/[^0-9-\.]/", "", $_GET["lat"])  + 0;
    if (($LAT < -90) || ($LAT > 90)) $LAT = $LATBASE;
    $LNG  = preg_replace("/[^0-9-\.]/", "", $_GET["lng"])  + 0;
    if (($LNG < -180) || ($LAT > 180)) $LNG = $LNGBASE;
    $ZOOM = preg_replace("/[^0-9]/",    "", $_GET["zoom"]) + 0;
    if (($ZOOM < 1) || ($ZOOM > 15)) $ZOOM = 8;
}



   
   
// *****************************************************************************


?><!DOCTYPE html>
<html>

<head>
<title>cartographie parcours numeriques</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


<!-- link rel="stylesheet" media="screen" href="./_css/now/" type="text/css"/ --> 
<link rel="stylesheet" href="./_libs/font-awesome-4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./_libs/leaflet-0.7.5/leaflet.css" />
<link rel="stylesheet" href="./_libs/sidebar-v2/css/leaflet-sidebar.css" />

<link rel="stylesheet" href="./_libs/markercluster/MarkerCluster.Default.css" />
<link rel="stylesheet" href="./_libs/markercluster/MarkerCluster.css" />
<link rel="stylesheet" href="./_css/styles.css" />

<link rel="stylesheet" href="./_libs/jquery-toggles/css/toggles.css">
<link rel="stylesheet" href="./_libs/jquery-toggles/css/toggles-light.css">
</head>



<body>

<div id="sidebar" class="sidebar collapsed">
    <!-- Nav tabs -->
    <div class="sidebar-tabs">
        <ul role="tablist">
            <li><a href="#home" role="tab"><i class="fa fa-star"></i></a></li>
            <li><a href="#recherche" role="tab"><i class="fa fa-search"></i></a></li>
            <li><a href="#partage" role="tab"><i class="fa fa-share"></i></a></li>
            <li><a href="#info" role="tab"><i class="fa fa-info-circle"></i></a></li>
        </ul>
    </div>

    <!-- Tab panes -->
    <div class="sidebar-content">
        <div class="sidebar-pane" id="home">
            <h1 class="sidebar-header">
                Le réseau parcours numériques
                <div class="sidebar-close"><i class="fa fa-caret-left"></i></div>
            </h1>
            <?php if($MODE == "embed") {
                echo "<p><a href=\"http://parcoursnumeriques.net/carte/\" target=\"_blank\">ouvrir le site en plein écran</a></p>";
            }
            ?>
            <p>Cartographie participative des réseaux de médiation numérique des Pays de la Loire. Cette carte peut être modifiée par les membres du réseau. Recensement établi par <a href="mailto:mona@pingbase.net">PiNG <i class="fa fa-envelope"></i></a></p>
            <p>Différentes options permettent d'affiner la recherche (onglet <i class="fa fa-search"></i>). La carte peut-être intégrée sur d'autres sites (onglet <i class="fa fa-share"></i>). Ce site est développé sous licences libres (onglet <i class="fa fa-info-circle"></i>)</p>

            <div>
                <fieldset>
                <legend>Sur la carte</legend>
                <img src="./_pix/marker-b-legende.png" width="12" height="20" /> association<br />
                <img src="./_pix/marker-j-legende.png" width="12" height="20" /> collectivité<br />
                <img src="./_pix/marker-v-legende.png" width="12" height="20" /> entreprise<br />
                <img src="./_pix/marker-legende.png" width="12" height="20" /> autre<br />
                </fieldset>
                <br />
                <fieldset>
                <legend>Dans les infobulles de chaque lieu</legend>
                <i class="fa fa-envelope"></i> envoyer un email<br />
                <i class="fa fa-external-link-square"></i> visiter le site<br />
                <i class="fa fa-rss"></i> flux rss<br />
                <i class="fa fa-facebook"></i> visiter la page facebook<br />
                <i class="fa fa-twitter"></i> visiter la page twitter<br />
                </fieldset>
            </div>

            <p>Cette cartographie est soutenue par la Région Pays de la Loire et la DRAC Pays de la Loire.</p>
            <p>Cartographie développée par l'association PiNG sous licence creative commons BY-NC-SA</p>
            
            <img src="./_pix/logos_2016.png" width="375" height="76" title="logos partenaires" alt="logos partenaires" />
        </div>

        <div class="sidebar-pane" id="recherche">
            <h1 class="sidebar-header">Réglages de recherche<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
            <form action='' method='GET' style='font-size:smaller;' id="form-rech">

<!--   fonctionnel mais retiré pour la version 1         
                <br />
                <b>Coordonnées (cliquer sur la carte pour définir les coordonnées)</b>
                <br />
                
                <input type='text' name='latitude' id='latitude'> latitude<br />
                <input type='text' name='longitude' id='longitude'> longitude<br />
                               
                <br />

                distance maximum : 
                <select name="km" id="km">
                    <option value="0.5" selected> 0.5 km</option>
                    <option value="2"> 2 km</option>
                    <option value="5"> 5 km</option>
                    <option value="10"> 10 km</option>
                    <option value="20"> 20 km</option>
                    <option value="30"> 30 km</option>
                    <option value="40"> 40 km</option>
                    <option value="50"> 50 km</option>
                    <option value="60"> 60 km</option>
                    <option value="70"> 70 km</option>
                    <option value="80"> 80 km</option>
                    <option value="90"> 90 km</option>
                    <option value="100"> 100 km</option>
                    <option value="120"> 120 km</option>
                    <option value="150"> 150 km</option>
                </select>
-->                
                <br /><br />
                <b>Centrer sur un lieu : </b><br />
                
                <select name="lieux" id="lieux">
                </select>
                
                <br /><br /><hr /><br />
                <b>Centrer sur une agglomération : </b>
                
                <select name="communes" id="communes">
                    <option value="aucune" selected>(aucune)</option>
                    <option value="Nantes">Nantes</option>
                    <option value="Angers">Angers</option>
                    <option value="Le_Mans">Le Mans</option>
                    <option value="La_Roche-sur-Yon"> La Roche-sur-Yon</option>
                    <option value="Cholet">Cholet</option>
                    <option value="Saint-Nazaire">Saint-Nazaire</option>
                    <option value="Laval">Laval</option>
                </select>
                
                <br /><br /><hr /><br />
                
                <!-- input type="button" id="hide_actu" name="hide_actu" value="masquer" /> - 
                <input type="button" id="show_actu" name="show_actu" value="afficher" / -->
                
                <div class="toggle toggle-light" style='display: inline-block; vertical-align: top;'> 
                </div>
                <b> &nbsp; Afficher / masquer les évènements d'actualité</b>
                
                <br /><br /><hr /><br />
                <b>Afficher les lieux par mot-clé</b><br />
                (Seules les réponses correspondantes seront affichées sur la carte.)
                <br /><br />
                
                <input type="button" id="uncheck_all" name="uncheck_all" value="tout décocher" /> - 
                <input type="button" id="check_all" name="check_all" value="tout cocher" />
                
                <br /><br />
                
                <b><u>Activités</u></b>
                <br />
                <?php
                
                /*
                toutes_categories.push("(espaces non renseignés)");
                toutes_categories.push("(activités non renseignées)");
                toutes_categories.push("(intérêts non renseignés)");
                */
                
                // chercher le nombre total de lieux pour calculer les champs non renseignés
                $rez = connexion_base("SELECT id FROM lieux");
                $nb_lieux = mysqli_num_rows($rez);
                
                
                $rez = connexion_base("SELECT DISTINCT(id_lieu) FROM activites");
                $nbla = mysqli_num_rows($rez); // nombre de lieux ayant déclaré une activité
                
                $r = array();
                $req = "SELECT COUNT(id) AS cid, activite 
                        FROM activites 
                        GROUP BY activite 
                        ORDER BY cid DESC";
                $rez = connexion_base($req);

                $i = 0;
                while ($truc = mysqli_fetch_object ($rez)) {
                    $r[$i]["name"]      = $truc->activite;
                    $r[$i]["display"]   = $truc->activite . " (" . $truc->cid . ")";
                    $r[$i]["class"]     = "cat";
                    $r[$i]["checked"]   = true;
                    $i ++;
                }
                $r[$i]["name"]      = "(activités non renseignées)";
                $r[$i]["display"]   = "(activités non renseignées)" . " (" . ($nb_lieux - $nbla) . ")";
                $r[$i]["class"]     = "cat";
                $r[$i]["checked"]   = true;
                
                echo form_tableau_deux_colonnes($r);
                ?>

                
                
                <hr />
                <b><u>Espaces</u></b>
                <br />         
                <?php
                
                $rez = connexion_base("SELECT DISTINCT(id_lieu) FROM espaces");
                $nble = mysqli_num_rows($rez); // nombre de lieux ayant déclaré une activité
                
                $r = array();
                $req = "SELECT COUNT(id) AS cid, espace 
                        FROM espaces 
                        GROUP BY espace 
                        ORDER BY cid DESC";
                $rez = connexion_base($req);

                $i = 0;
                while ($truc = mysqli_fetch_object ($rez)) {
                    $r[$i]["name"]      = $truc->espace;
                    $r[$i]["display"]   = $truc->espace . " (" . $truc->cid . ")";
                    $r[$i]["class"]     = "cat";
                    $r[$i]["checked"]   = true;
                    $i ++;
                }
                
                $r[$i]["name"]      = "(espaces non renseignés)";
                $r[$i]["display"]   = "(espaces non renseignés)" . " (" . ($nb_lieux - $nble) . ")";
                $r[$i]["class"]     = "cat";
                $r[$i]["checked"]   = true;
                
                echo form_tableau_deux_colonnes($r);
                ?>
                


                
                <hr />
                <b><u>Centres d'intérêt</u></b>
                <br />
                
                <?php
                
                $rez = connexion_base("SELECT DISTINCT(id_lieu) FROM centres_interet");
                $nbli = mysqli_num_rows($rez); // nombre de lieux ayant déclaré une activité
                
                $r = array();
                $req = "SELECT COUNT(id) AS cid, centre_interet 
                        FROM centres_interet 
                        GROUP BY centre_interet 
                        ORDER BY cid DESC";
                $rez = connexion_base($req);

                $i = 0;
                while ($truc = mysqli_fetch_object ($rez)) {
                    $r[$i]["name"]      = $truc->centre_interet;
                    $r[$i]["display"]   = $truc->centre_interet . " (" . $truc->cid . ")";
                    $r[$i]["class"]     = "cat";
                    $r[$i]["checked"]   = true;
                    $i ++;
                }
                
                $r[$i]["name"]      = "(intérêts non renseignés)";
                $r[$i]["display"]   = "(intérêts non renseignés)" . " (" . ($nb_lieux - $nbli) . ")";
                $r[$i]["class"]     = "cat";
                $r[$i]["checked"]   = true;
                
                echo form_tableau_deux_colonnes($r);
                ?>
                
                
                
                
                <br /><hr /><br />
                <b>Afficher les réseaux</b>
                <br /><br />
                
                <?php
                
                $r = array();
                $req = "SELECT count(id) AS cid, reseau 
                        FROM reseaux 
                        GROUP BY reseau 
                        ORDER BY reseau";
                $rez = connexion_base($req);

                $i = 0;
                while ($truc = mysqli_fetch_object ($rez)) {
                    $r[$i]["name"]      = $i; // = "reseau".$i;
                    $r[$i]["display"]   = $truc->reseau . " (" . $truc->cid . ")";
                    $r[$i]["class"]     = "reseau";
                    $r[$i]["checked"]   = false;
                    $i ++;
                }
                $nb_reseaux = $i;
                echo form_tableau_deux_colonnes($r);

                ?>
                
                <br /><br />
            </form>
        </div>

        
        <div class="sidebar-pane" id="partage">
            <h1 class="sidebar-header">Partage<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
            
            <p>Pour <b>intégrer cette carte à un site</b>, choisissez le niveau de zoom et le cadrage de la carte puis copiez le morceau de code suivant dans le code de votre site.</p>
            
            <form>
            <textarea name="lien_partage" id="lien_partage" cols="20" rows="4"></textarea>
            </form>
            
            <br />
            
            <hr />
                               
            <p>Flux RSS des actualités :<br /><br />
            
            <i class="fa fa-rss"></i> <a href='./actualites_parcours_numeriques.rss' target="_blank">actualités parcours numériques</a>
            </p -->
        </div>
        
        
        <div class="sidebar-pane" id="info">
            <h1 class="sidebar-header">Informations<div class="sidebar-close"><i class="fa fa-caret-left"></i></div></h1>
            <p>Ce site est développé sous licences libres.<br /><a href="https://github.com/emoc/cartographie-parcours-numeriques" target="_blank">Code disponible sur github.</a></p>
            <p>Il s'appuie sur</p>
            
            <p>
            - <a href="http://openstreetmap.org" target="_blank">OpenStreetMap</a><br />
            - framework PHP : <a href="http://www.yiiframework.com/" target="_blank">Yii 1.1</a><br />
            - <a href="http://leafletjs.com/" target="_blank">Leaflet</a> + <a href="https://github.com/Leaflet/Leaflet.markercluster" target="_blank">Leaflet.markercluster</a> + <a href="https://github.com/turbo87/sidebar-v2/" target="_blank">sidebar v2</a><br />
            - <a href="http://fontawesome.io/" target="_blank">Font-awesome</a><br />
            - <a href="http://jquery.com/" target="_blank">JQuery</a><br />
            - algorithme "quickhull" de calcul d'enveloppes convexes en PHP par <a href="http://www.westhoffswelt.de/blog/2009/10/21/calculate-a-convex-hull-the-quickhull-algorithm" target="_blank">Jakob Westhoff</a></p>
            
            <p>Police de caractères : <a href="https://fontlibrary.org/en/font/now" target="_blank">Now</a> par Alfredo Marco Pradil, <a href="http://scripts.sil.org/OFL" target="_blank">licence SIL Open Font (OFL)</a></p>
            
            <p>
            Produit par <a href="http://pingbase.net">PiNG</a><br />
            Réalisé par Pierre Commenge (<a href="http://lesporteslogiques.net">Les Portes Logiques</a>)<br />
            Hébergé par la <a href="http://lacms.net">Coopérative Multimédia Solidaire</a></p>
        </div>
    </div>
</div>

    
    
    
    
    

<div id="map" class="sidebar-map"></div>
<a href="./modifier/">
<?php
    if ($MODE != "embed") echo "<img style=\"position: fixed; top: 0; right: 0; border: 0;\" src=\"./_pix/mon_compte.png\" alt=\"mon_compte\">";
?>
</a>

<script src="_libs/leaflet-0.7.5/leaflet.js"></script>
<script src="_libs/leaflet-plugins/KML.js"></script>
<script src="_libs/sidebar-v2/js/leaflet-sidebar.js"></script>
<script src="_libs/jquery-1.11.3.js"></script>
<script src="_libs/markercluster/leaflet.markercluster-src.js"></script>
<script src="_libs/jquery-toggles/toggles.js" type="text/javascript"></script>

<script src="_js/scripts.js"></script>

<script src="_geodata/reseaux.js.php"></script>
<script src="_geodata/actualites.js.php"></script>
<script src="_geodata/lieux.js.php"></script>
<script src="_geodata/categories.js.php"></script>
<script>
$(document).ready(function(){

    
    function majuscule(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function main_execute() {
        
        // tuiles de fond de carte *********************************************
        <?php
        if ($MODE != "embed") echo "var attrib='&copy; <a href=\"http://osm.org/copyright\">OpenStreetMap</a> contributors';";
        else echo "var attrib='&copy; <a href=\"http://osm.org/copyright\" target=\"_blank\">OpenStreetMap</a> contributors | <a href=\"http://parcoursnumeriques.net/carte/\" target=\"_blank\">cartographie parcours numériques</a>';";
        ?>
        var mapnik = L.tileLayer(
                'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'
                , {attribution: attrib}
        )
        
        // actualites *********************************************************
        /*
            var actualites = {
                1 : {   "latitude" : "",
                        "longitude" : "",
                        "texte" : "titre image texte lien", // HTML
                    }, 
            }
        */
        var popus = L.layerGroup();

        actu = [];
        actuvisible = [];
        for (key in actualites) {
            var inpop = "<div class='actuheader'>Actualité<div class='closepopup' id='" + key + "'><img src='./_pix/close.png'></div></div><div class='popuponclick' id='" + key + "'>" + actualites[key]["texte"] + "</div>";
            actu[key] = L.popup({closeOnClick: false, maxWidth:226, maxHeight:240, autoPan: false, closeButton: false, className:"actu-popup"})
                .setLatLng([actualites[key]["latitude"],actualites[key]["longitude"]])
                .setContent(inpop);            
            actuvisible[key] = 1;    
        }
        // si l'affichage NE se fait PAS en mode embed, afficher les popups d'actualité
        <?php
        
        if ($MODE != "embed") {
            //echo "popus.clearLayers();";
            echo "\t\t\tfor (key in actualites) {\n
                \t\t\t\tpopus.addLayer(actu[key]);\n
            \t\t\t}\n";
        }
        
        ?>
        
        // carte principale ****************************************************
        var map = L.map('map', {
            center: new L.LatLng(<?php echo $LAT; ?>, <?php echo $LNG; ?>), 
            zoom: <?php echo $ZOOM; ?>, 
            layers: [mapnik, popus]
        });
        
        
        
        // reseaux *************************************************************
        <?php
        
        // assigner la fonction pour afficher / masquer les checkboxes
        // le nombre de réseau est connu depuis la première partie du script!
        
        for ($i = 0; $i < $nb_reseaux; $i++) {
            echo "// afficher / masquer le réseau $i\n";
            echo "$(\"#" . $i . "\").click(function() {\n";
            echo "\tif ($('#" . $i . "').prop('checked')) map.addLayer(reseaux[" . $i . "]);\n";
            echo "\telse map.removeLayer(reseaux[" . $i . "]);\n";
            echo "});\n";
        }
        ?>
                

    
        // sidebar *************************************************************
        var sidebar = L.control.sidebar('sidebar').addTo(map); 
        <?php
        if ($MODE != "embed") echo "L.control.sidebar('sidebar').open(\"home\");";
        ?>

        /* fonctionnel mais retiré pour la version 1
        // vous etes ici *******************************************************
        var vous_etes_ici = L.icon({
            iconUrl: '_pix/marqueur_vousetesici.png',
            iconSize:     [32, 32], // size of the icon
            iconAnchor:   [16, 16], // point of the icon which will correspond to marker's location
        });
        var ici_marqueur = L.marker();
        
        
        // cercle de distance **************************************************
        var ici_cercle = L.circle([0,0], 500, {color:'#E37459', weight:'1', opacity:'1', fillOpacity:'0.4'});
        var ici_cercle_rayon = 500;
        */
        
        // lieux ***************************************************************
        
        // icone en fonction du type 
                
        var cpnIcon = {
            "collectivité" : L.icon({
                iconUrl:       './_pix/marker-j-icon.png',
                iconRetinaUrl: './_pix/marker-j-icon-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "autre" : L.icon({
                iconUrl:       './_pix/marker-icon.png',
                iconRetinaUrl: './_pix/marker-icon-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "association" : L.icon({
                iconUrl:       './_pix/marker-b-icon.png',
                iconRetinaUrl: './_pix/marker-b-icon-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "entreprise" : L.icon({
                iconUrl:       './_pix/marker-v-icon.png',
                iconRetinaUrl: './_pix/marker-v-icon-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "sel" : L.icon({
                iconUrl:       './_pix/marker-sel.png',
                iconRetinaUrl: './_pix/marker-sel.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
        }
        
        var cpnIconSel = {
            "collectivité" : L.icon({
                iconUrl:       './_pix/marker-j-icon-sel.png',
                iconRetinaUrl: './_pix/marker-j-icon-sel-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "autre" : L.icon({
                iconUrl:       './_pix/marker-icon-sel.png',
                iconRetinaUrl: './_pix/marker-icon-sel-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "association" : L.icon({
                iconUrl:       './_pix/marker-b-icon-sel.png',
                iconRetinaUrl: './_pix/marker-b-icon-sel-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
            "entreprise" : L.icon({
                iconUrl:       './_pix/marker-v-icon-sel.png',
                iconRetinaUrl: './_pix/marker-v-icon-sel-x2.png',
                iconSize: [25, 41],
                iconAnchor: [12, 20],
                popupAnchor: [0, -21],
                }),
        }
        
        var markers = new L.MarkerClusterGroup({
            maxClusterRadius:40,
            iconCreateFunction: function (cluster) {
				var markers = cluster.getAllChildMarkers();
                var n = markers.length;
                
                return L.divIcon({ html: n, className: 'mycluster', iconSize: L.point(40, 40) });
			},
            polygonOptions: {color:'black', weight:1, opacity:1, fillColor:'#fff', fillOpacity:0.5, dashArray:'1,5', clickable:false},
        });
        
        var categories = {},
            categories_meta = {},
            overlayMaps = {},
            markers_category = {},
            leaflet_meta = {},
            random_category_index = '',
            categories = {};

        // ajouter les catégories vides pour que les marqueurs apparaissent tout de même dans un groupe
        toutes_categories.push("(espaces non renseignés)");
        toutes_categories.push("(activités non renseignées)");
        toutes_categories.push("(intérêts non renseignés)");
        
        for (var i = 0; i < toutes_categories.length; i++) {
            var cat = toutes_categories[i];
            categories[cat] = new L.layerGroup().addTo(map);
        }

        for(var index in categories) {
            markers_category[index] = [];
            overlayMaps[index] = categories[index];
            //console.log(index);
        }
        /*
        var lieux = {
            0 : {	"latitude" : "47.9958091",
                    "longitude" : "0.2341616",
                    "titre" : "Mission Locale de l'Agglomération Mancelle",
                    "texte" : " texte pour 0",
            },
            1 : {	"latitude" : "47.9236717",
                    "longitude" : "0.1526194",
                    "titre" : "Cyber@spay",
                    "texte" : " texte pour 1",
        },
        */
        
        var allMarkersObjArray = [];
        
        function onClickMarker(e) { // DEBUG
                //this.setIcon(cpnIcon["sel"]);
                console.log(this.number);
        }
        
        for (key in lieux) {

            var iconType = lieux[key]["type"];
            var markerpopup = L.popup({
                                maxWidth:250,
                                minWidth:250,
                                closeOnClick: false,
                              }).setContent(lieux[key]["texte"])
            var marker = L.marker(
                            [ lieux[key]["latitude"], lieux[key]["longitude"] ],
                            { icon: cpnIcon[iconType], title: lieux[key]["titre"] }
                        ).bindPopup(markerpopup).on('click', onClickMarker);
                        
            marker.number = key;
            allMarkersObjArray[key] = marker;
            

            
            
            // CETTE LIGNE AFFICHE TOUS LES MARQUEURS, Y COMPRIS CEUX QUI NE RENTRENT DANS AUCUNE CAT
            //markers.addLayer(marker);
            
            
            // créer des ensembles de marqueurs par catégorie ******************           
            var cat = "";

            if (typeof lieux[key]["centres_interet"] !== "undefined") {
                for (var i = 0; i < lieux[key]["centres_interet"].length; i++) {
                    var cat = majuscule(lieux[key]["centres_interet"][i]);
                    //console.log(key + " : |" + cat + "|");
                    markers_category[cat].push(marker);
                }
            } else {
                markers_category["(intérêts non renseignés)"].push(marker);
            }
            
            cat = "";

            if (typeof lieux[key]["espaces"] !== "undefined") {
                for (var i = 0; i < lieux[key]["espaces"].length; i++) {
                    var cat = majuscule(lieux[key]["espaces"][i]);
                    //console.log(key + " : " + cat);
                    markers_category[cat].push(marker);
                }
            } else {
                markers_category["(espaces non renseignés)"].push(marker);
            }
            
            cat = "";
            
            if (typeof lieux[key]["activites"] !== "undefined") {
                for (var i = 0; i < lieux[key]["activites"].length; i++) {
                    var cat = majuscule(lieux[key]["activites"][i]);
                    //console.log(key + " : " + cat);
                    markers_category[cat].push(marker);
                }
            } else {
                markers_category["(activités non renseignées)"].push(marker);
            }
        }

        map.addLayer(markers);

        
        // afficher tous les calques au démarrage
        for (var i = 0; i < toutes_categories.length; i++) {
                var cat = toutes_categories[i];
                //categories[cat] = new L.layerGroup().addTo(map);
                markers.addLayers(markers_category[cat]);
        }

        // *********************************************************************
        // *********************************************************************
        
        /* fonctionnel mais retiré pour la version 1
        // placer "vous etes ici" au clic sur la carte *************************
        map.on('click', onMapClick);
        function onMapClick(e) {
        
            // ajouter un marqueur là ou la carte a été cliquée
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
       
            if (typeof ici_marqueur != 'undefined') { // effacer marqueur et cercle (s'ils existent) et ajouter 
              map.removeLayer(ici_marqueur);  
              ici_marqueur.setIcon(vous_etes_ici).setLatLng(e.latlng).addTo(map);
              map.removeLayer(ici_cercle); 
              ici_cercle.setRadius(ici_cercle_rayon).setLatLng(e.latlng).addTo(map);
            }
            else { // juste ajouter, si c'est la première fois
              ici_marqueur.setIcon(vous_etes_ici).setLatLng(e.latlng).addTo(map);
              ici_cercle.setRadius(ici_cercle_rayon).setLatLng(e.latlng).addTo(map);
            }
            
            // ajouter ces coordonnées au formulaire
            $('#latitude').val(e.latlng.lat);
            $('#longitude').val(e.latlng.lng);
        }
        */
        
        // mettre à jour le code embed *****************************************
        map.on('click', updateEmbed);
        map.on('moveend', updateEmbed);
        map.on('zoomend', updateEmbed);
        map.on('load', updateEmbed);
        
        function updateEmbed(e) { 
            $('#lien_partage').val("<iframe frameborder='1' scrolling='no' width='540' height='360' src='http://parcoursnumeriques.net/carte/<?php $p = pathinfo(__FILE__); echo $p['basename']; ?>?embed=embed&zoom=" + map.getZoom() + "&lat=" + map.getCenter().lat + "&lng=" + map.getCenter().lng + "' name='cartopn' id='cartopn'></iframe>");
        }
        
        
        // sélectionner tout le code embed au clic *****************************
        $('#lien_partage').on("click", function () {
            $(this).select();
        });
        
        
        // afficher / masquer les popups d'évènements **************************
        /*
        $("#hide_actu").click(function() {
            if (map.hasLayer(popus)) {
                popus.clearLayers();
            } else {
                //alert("map haz not layer popus!");
            }
        });
        
        $("#show_actu").click(function() {
            for (key in actualites) {
                popus.addLayer(actu[key]);
                actuvisible[key] = 1;
            }
        });*/
        
        // cocher / décocher toutes les catégories *****************************
        $("#uncheck_all").click(function() {
            $(".cat").removeAttr('checked');
            for (var i = 0; i < toutes_categories.length; i++) {
                var cat = toutes_categories[i];
                markers.removeLayers(markers_category[cat]);
            }
        });
        $("#check_all").click(function() {
            $(".cat").prop('checked', 'checked');
            for (var i = 0; i < toutes_categories.length; i++) {
                var cat = toutes_categories[i];
                markers.addLayers(markers_category[cat]);
            }
        });
                
        // afficher / masquer les calques de catégories ************************
        $("input.cat:checkbox").change(
            function() {
                if (this.checked) {
                    markers.addLayers(markers_category[this.id]);
                } else {
                    // d'abord on enlève tout
                    for (var i = 0; i < toutes_categories.length; i++) {
                        var cat = toutes_categories[i];
                        markers.removeLayers(markers_category[cat]);
                    }
                    // puis on affiche de nouveau les catégories cochées
                    $(".cat,:checkbox").each(function() {
                        if (this.checked) markers.addLayers(markers_category[this.id]);
                    });
                }
            }
        );
        
        /* fonctionnel mais retiré pour la version 1
        // changer le périmètre kilométrique ***********************************
        $( "#km" ).change(function() {
            var str = $(this).children(":selected").val();
            ici_cercle_rayon = str * 1000;
            if (typeof ici_cercle != 'undefined') {
                ici_cercle.setRadius(ici_cercle_rayon);
            }
        });
        */
        
        // centrer sur une commune *********************************************
        $( "#communes" ).change(function() {
            var str = $(this).children(":selected").val();

            //  Nantes, Angers, Le Mans, La Roche-sur-Yon, Cholet, Saint-Nazaire et Laval
            switch (str) {
                case "aucune": 
                    break;
                case "Nantes": 
                    map.panTo([47.2260967, -1.5665817], [true, 5]);
                    map.setZoom(12);
                    break;
                case "Saint-Nazaire": 
                    map.panTo([47.2743374, -2.2283363], [true, 5]);
                    map.setZoom(13);
                    break;
                case "Cholet": 
                    map.panTo([47.0610013, -0.8813095], [true, 5]);
                    map.setZoom(13);
                    break;
                case "Angers": 
                    map.panTo([47.4682534, -0.5582427], [true, 5]);
                    map.setZoom(12);
                    break;
                case "Le_Mans": 
                    map.panTo([48.0048547, 0.20084381], [true, 5]);
                    map.setZoom(12);
                    break;
                case "La_Roche-sur-Yon":
                    map.panTo([46.6689938, -1.4281368], [true, 5]);
                    map.setZoom(14);
                    break;
                case "Laval":
                    map.panTo([48.0698206, -0.7716179], [true, 5]);
                    map.setZoom(14);
                    break;            
            }
            
        });
        
              
        
        // passer en premier-plan le popup cliqué ******************************
        // le contenu du popup est inclus dans un <div> de classe .popuponclick 
        // avec comme id sa place dans le tableau actu
        $('#map').on('click', '.popuponclick', function() {
            var inpopup = this.id;
            popus.clearLayers();
            for (key in actualites) {
                if ((key != inpopup) && (actuvisible[key] == 1)) popus.addLayer(actu[key]);
            }
            popus.addLayer(actu[inpopup]);
        });
        

        // fermer le popup en enregistrant sa valeur de visibilité afin d'éviter qu'il ne se réouvre
        // après un click dans le popup, puis réafficher la pile
        
        $('#map').on('click', '.closepopup', function() {
            var inpopup = this.id;
            for (key in actualites) {
                if (key == inpopup) actuvisible[key] = 0;
            }
            
            popus.clearLayers();
            for (key in actualites) {
                if ((key != inpopup) && (actuvisible[key] == 1)) popus.addLayer(actu[key]);
            }
            
        });
        
        
        // créer la liste de lieux *********************************************                    
        var selectlieux = []; // créer un array pour y stocker les valeurs de l'objet lieux
        
        for (key in lieux) {
            var id = key;
            var commune = lieux[key]["commune"];
            var titre = lieux[key]["titre"];
            selectlieux.push([key, commune, titre]);
        }
        
        selectlieux.sort(function(a,b){ // tri sur le 2e élément
            a = a[1];
            b = b[1];
            //return a == b ? 0 : (a < b ? -1 : 1);
            return a.localeCompare(b);
        })
        
        var baliselieux = document.getElementById("lieux");
        for (var i = 0; i < selectlieux.length; i++) {
            var option = document.createElement("option");
            option.value = selectlieux[i][0];
            option.text = (selectlieux[i][1] + " - " + selectlieux[i][2]).substr(0, 60);
            baliselieux.add(option);
        }
        

        // recadrer la carte si un lieu est choisi *****************************
        $( "#lieux" ).change(function() {
            var key = $(this).children(":selected").val();
            //alert(key);
            map.panTo([lieux[key]["latitude"], lieux[key]["longitude"]], [true, 5]);
            map.setZoom(16);
            
        });
        
        /*  RESEAUX ************************************************************
        var reseaux = {
            1 : { "nom" : "reseau1",  
                  "membres" : [ 0, 12, 23, 24, 25, 26 ],
                },
            2 : { "nom" : "reseau2",  
                  "membres" : [ 3, 5, 6, 19, 27 ],
                },
        }
        ********************************************************************* */
        
        /*
        // afficher les réseaux en changeant leur icone
        */
        
        function isInArray(value, array) {
            return array.indexOf(value) > -1;
        }

        function changeMarkerIcon(idreseau, etat) { // etat : true: selectionné ; false : normal

            for (key in allMarkersObjArray) {
                if (isInArray(key, reseaux2[idreseau]["membres"])) {
                    var typeLieu = lieux[key]["type"];
                    if (etat) {
                        allMarkersObjArray[key].setIcon(cpnIconSel[typeLieu]);
                        //console.log("lieu " + key + " sélectionné " + lieux[key]["titre"]);
                        //console.table(allMarkersObjArray[key]);
                    } else {
                        allMarkersObjArray[key].setIcon(cpnIcon[typeLieu]);
                        //console.log("lieu " + key + " désélectionné " + lieux[key]["titre"]);
                        //console.table(allMarkersObjArray[key]);
                    }
                }
            }
        }
        
        
        
        $(".reseau,:checkbox").change(
            function() {              
                if (this.checked) {
                    var idreseau = this.id;
                    changeMarkerIcon(idreseau, true);
                } else {
                    // d'abord on enlève tout
                    for (key in reseaux) {
                        changeMarkerIcon(key, false);
                    }
                    // puis on affiche de nouveau les catégories cochées
                    $("input.reseau:checkbox").each(function() {  
                        if (this.checked) {
                            changeMarkerIcon(this.id, true); 
                        }
                    })
                }
            }
        );
        
        
        // DEBUG : Itérer sur tous les marqueurs et changer leur couleur 
        /*
        for (key in allMarkersObjArray) {
            allMarkersObjArray[key].setIcon(cpnIcon["sel"]);
        } */
        
        
        // "toggle" des actualités *********************************************
        $('.toggle').toggles({
          drag: true, 
          click: true, 
          text: {
            on: 'ON', 
            off: 'OFF' 
          },
          on: true, 
          width: 60, 
          height: 20, 
          type: 'compact' // || 'select' 
        });
        
        // masquer les actualités au chargement de la page ********************* 
        /*
        if (map.hasLayer(popus)) {
                popus.clearLayers();
        }*/
        
        // Masquer / afficher les actualités selon la position du "toggle"
        $('.toggle').on('toggle', function(e, active) {
          if (active) {
            for (key in actualites) {
                popus.addLayer(actu[key]);
                actuvisible[key] = 1;
            }
          } else {
            if (map.hasLayer(popus)) {
                popus.clearLayers();
            } 
          }
        });
        
        
    }
    
    // ************************************************************************
    main_execute(); 

    
});

</script>

<!-- ----------------------------------------------------------------------- -->



<!-- ----------------------------------------------------------------------- -->

</body>
</html>
