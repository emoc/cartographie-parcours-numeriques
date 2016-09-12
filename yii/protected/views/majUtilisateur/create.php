<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */

$this->breadcrumbs=array(
	'Gérer les profils utilisateur'=>array('admin'),
	'Ajouter un nouveau profil',
);

$this->menu=array(
	array('label'=>'Gérer les profils utilisateurs', 'url'=>array('admin')),
);
?>

<h1>Ajouter un nouveau profil utilisateur</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>