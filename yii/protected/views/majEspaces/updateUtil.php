<?php
/* @var $this MajEspaceController */
/* @var $model Espaces */

$this->breadcrumbs=array(
	'Mettre à jour un espace',
);

$this->menu=array(
	array('label'=>'Administrer les espaces', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un espace', 'url'=>array('createUtil')),
);
?>

<h1>Mettre à jour</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>