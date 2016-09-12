<?php
/* @var $this MajEspaceController */
/* @var $model Espaces */

$this->breadcrumbs=array(
	'Ajouter un espace',
);

$this->menu=array(
	array('label'=>'Administrer les espaces', 'url'=>array('adminUtil')),
);
?>

<h1>Ajouter un espace</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>