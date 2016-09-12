<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */

$this->breadcrumbs=array(
	'Gérer les profils utilisateur'=>array('admin'),
	'Mettre à jour un profil',
);

$this->menu=array(
	array('label'=>'Ajouter un nouveau profil', 'url'=>array('create')),
	array('label'=>'Gérer les profils utilisateurs', 'url'=>array('admin')),
);
?>

<h1>Mettre à jour le profil : <?php echo $model->username; ?></h1>

<?php $this->renderPartial('_formUpdate', array('model'=>$model)); ?>