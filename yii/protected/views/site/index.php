<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<?php 
if (Yii::app()->user->isGuest) {
    echo "Interface d'administration de la cartographie parcours numériques. Chaque membre du réseau &laquo;parcours numériques en Pays de Loire&raquo; peut se connecter avec ses identifiants personnalisés pour mettre à jour ses informations. <br /><br />Pour accéder à l'administration, veuillez vous <a href='" . Yii::app()->request->baseUrl . '/index.php/site/login' . "'>connecter</a><br /><br />Pour plus d'informations, contacter <a href='mailto:mona@pingbase.net'>PiNG</a>";
}

if (Yii::app()->user->id != '') {
    echo "<p>Choisissez dans le menu ci-dessous l'action à effectuer :</p>";
    if (Yii::app()->user->role === '2') {
    ?>
<p>
    <ul>
        <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majLieu/admin/"; ?>'>gérer les fiches renseignements de lieux</a></li>
        <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majUtilisateur/admin/"; ?>'>gérer les profils utilisateur</a></li>
        <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majActualites/admin/" . Yii::app()->user->lieu; ?>'>ajouter / modifier une actualité</a></li>
        <li>ajouter / modifier les mots clés d'un lieu, par catégorie :</li>
        <ul>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majActivites/admin/" . Yii::app()->user->lieu; ?>'>activités</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majEspaces/admin/" . Yii::app()->user->lieu; ?>'>espaces</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majReseaux/admin/" . Yii::app()->user->lieu; ?>'>réseaux</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majReseauxSociaux/admin/" . Yii::app()->user->lieu; ?>'>réseaux sociaux</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majCentresInteret/admin/" . Yii::app()->user->lieu; ?>'>centres d'intérêt</a></li>
        </ul>
    </ul>
</p>
    
     
    <?php
    } else {
    ?>
<p>
    <ul>
        <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majLieu/updateUtil/" . Yii::app()->user->lieu; ?>'>mettre à jour la fiche de renseignements principale</a></li>
        <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majUtilisateur/updateUtil/" . Yii::app()->user->id; ?>'>mettre à jour votre profil utilisateur</a></li>
        <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majActualites/adminUtil/" . Yii::app()->user->lieu; ?>'>ajouter / modifier une actualité</a></li>
        <li>ajouter / modifier les mots clés, par catégorie :</li>
        <ul>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majActivites/adminUtil/" . Yii::app()->user->lieu; ?>'>activités</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majEspaces/adminUtil/" . Yii::app()->user->lieu; ?>'>espaces</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majReseaux/adminUtil/" . Yii::app()->user->lieu; ?>'>réseaux</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majReseauxSociaux/adminUtil/" . Yii::app()->user->lieu; ?>'>réseaux sociaux</a></li>
            <li><a href='<?php echo Yii::app()->request->baseUrl . "/index.php/majCentresInteret/adminUtil/" . Yii::app()->user->lieu; ?>'>centres d'intérêt</a></li>
        </ul>
    </ul>
</p><?php
    
    }

}
?>