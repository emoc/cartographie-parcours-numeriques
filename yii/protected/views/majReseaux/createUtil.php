<?php
/* @var $this MajReseauController */
/* @var $model Reseaux */

$this->breadcrumbs=array(
	'Ajouter un réseau',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux', 'url'=>array('adminUtil')),
);
?>

<h1>Ajouter un réseau</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>