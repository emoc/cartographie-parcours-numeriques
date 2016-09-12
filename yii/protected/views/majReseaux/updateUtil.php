<?php
/* @var $this MajReseauController */
/* @var $model Reseaux */

$this->breadcrumbs=array(
	'Mettre à jour un réseau',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un réseau', 'url'=>array('createUtil')),
);
?>

<h1>Mettre à jour un réseau</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>