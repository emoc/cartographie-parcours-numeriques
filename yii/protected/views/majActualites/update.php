<?php
/* @var $this MajActualitesController */
/* @var $model Actualites */

$this->breadcrumbs=array(
	'Mettre à jour une actualité',
);

$this->menu=array(
	array('label'=>'Administrer les actualités', 'url'=>array('admin')),
	array('label'=>'Ajouter une actualité', 'url'=>array('create')),
);
?>

<h1>Mettre à jour une actualité</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>