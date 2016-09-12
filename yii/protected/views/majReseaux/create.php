<?php
/* @var $this MajReseauController */
/* @var $model Reseaux */

$this->breadcrumbs=array(
	'Ajouter un réseau',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux', 'url'=>array('admin')),
);
?>

<h1>Ajouter un réseau</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>