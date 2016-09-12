<?php
/* @var $this MajActualitesController */
/* @var $model Actualites */

$this->breadcrumbs=array(
	'Ajouter une actualité',
);

$this->menu=array(
	array('label'=>'Administrer les actualités', 'url'=>array('adminUtil')),
);
?>

<h1>Ajouter une actualité</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>