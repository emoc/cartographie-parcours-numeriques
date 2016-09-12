<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */

$this->breadcrumbs=array(
	'Afficher un réseau social',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux sociaux', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un réseau social', 'url'=>array('createUtil')),
);
?>

<h1>Afficher un réseau social</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',
		'id_lieu',*/
		'reseau',
		'lien',
	),
)); ?>
