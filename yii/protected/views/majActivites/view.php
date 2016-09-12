<?php
/* @var $this MajActivitesController */
/* @var $model Activites */

$this->breadcrumbs=array(
	'Afficher une activité',
);

$this->menu=array(
	array('label'=>'Ajouter une activité', 'url'=>array('create')),
	array('label'=>'Administrer les activités', 'url'=>array('admin')),
);
?>

<h1>Afficher une activité</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		'id_lieu',
		'activite',
	),
)); ?>
