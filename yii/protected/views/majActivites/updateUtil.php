<?php
/* @var $this MajActivitesController */
/* @var $model Activites */

$this->breadcrumbs=array(
	'Mettre à jour une activité',
);

$this->menu=array(
	array('label'=>'Administrer les activités', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter une activité', 'url'=>array('createUtil')),
);
?>

<h1>Mettre à jour une activité</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>