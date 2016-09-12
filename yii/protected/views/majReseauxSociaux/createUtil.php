<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */

$this->breadcrumbs=array(
	'Ajouter un réseau social',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux sociaux', 'url'=>array('adminUtil')),
);
?>

<h1>Ajouter un réseau social</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>