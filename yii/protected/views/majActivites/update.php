<?php
/* @var $this MajActivitesController */
/* @var $model Activites */

$this->breadcrumbs=array(
	'Mettre à jour une activité',
);

$this->menu=array(
	array('label'=>'Administrer les activités', 'url'=>array('admin')),
	array('label'=>'Ajouter une activité', 'url'=>array('create')),
);
?>

<h1>Mettre à jour une activité</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>