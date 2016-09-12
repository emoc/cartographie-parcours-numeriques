<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */

$this->breadcrumbs=array(
	"Modifier le profil utilisateur : " . $model->username,
);

$this->menu=array(
	array('label'=>'Voir le profil', 'url'=>array('viewUtil', 'id'=>$model->id))
);
?>

<h1><?php echo $model->username; ?></h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>