<?php
/* @var $this MajEspaceController */
/* @var $model Espaces */

$this->breadcrumbs=array(
	'Ajouter un espace',
);

$this->menu=array(
	array('label'=>'Administrer les espaces', 'url'=>array('admin')),
);
?>

<h1>Ajouter un espace</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>