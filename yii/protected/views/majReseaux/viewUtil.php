<?php
/* @var $this MajReseauController */
/* @var $model Reseaux */

$this->breadcrumbs=array(
	'Afficher un réseau',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un réseau', 'url'=>array('createUtil')),
);
?>

<h1>Afficher un réseau</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',
		'id_lieu',*/
		'reseau',
	),
)); ?>
