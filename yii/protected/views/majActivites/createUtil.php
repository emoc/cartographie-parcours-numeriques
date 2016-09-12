<?php
/* @var $this MajActivitesController */
/* @var $model Activites */

$this->breadcrumbs=array(
	'Ajouter une activité',
);

$this->menu=array(
	array('label'=>'Administrer les activités', 'url'=>array('adminUtil')),
);
?>

<h1>Ajouter une activité</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>