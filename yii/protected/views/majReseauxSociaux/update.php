<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */

$this->breadcrumbs=array(
	'Mettre à jour un réseau social',
);

$this->menu=array(
	array('label'=>'Ajouter un réseau social', 'url'=>array('create')),
	array('label'=>'Administrer les réseaux sociaux', 'url'=>array('admin')),
);
?>

<h1>Mettre à jour un réseau social</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>