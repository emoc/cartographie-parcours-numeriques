<?php
/* @var $this MajReseauController */
/* @var $model Reseaux */

$this->breadcrumbs=array(
	'Mettre à jour un réseau',
);

$this->menu=array(
	array('label'=>'Ajouter un réseau', 'url'=>array('create')),
	array('label'=>'Administrer les réseaux', 'url'=>array('admin')),
);
?>

<h1>Mettre à jour un réseau</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>