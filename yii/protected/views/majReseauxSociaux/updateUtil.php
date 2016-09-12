<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */

$this->breadcrumbs=array(
	'Mettre à jour un réseau social',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux sociaux', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un réseau social', 'url'=>array('createUtil')),
);
?>

<h1>Mettre à jour</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>