<?php
/* @var $this MajEspaceController */
/* @var $model Espaces */

$this->breadcrumbs=array(
	'Mettre à jour un espace',
);

$this->menu=array(
	array('label'=>'Ajouter un espace', 'url'=>array('create')),
	array('label'=>'Administrer les espaces', 'url'=>array('admin')),
);
?>

<h1>Mettre à jour un espace</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>