<?php
/* @var $this MajCentresInteretController */
/* @var $model CentresInteret */

$this->breadcrumbs=array(
	"Afficher un centre d'intérêt",
);

$this->menu=array(
	array('label'=>"Ajouter un centre d'intérêt", 'url'=>array('create')),
	array('label'=>"Administrer les centres d'intérêt", 'url'=>array('admin')),
);
?>

<h1>Afficher un centre d'intérêt</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		'id_lieu',
		'centre_interet',
	),
)); ?>
