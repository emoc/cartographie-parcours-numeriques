<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */

$this->breadcrumbs=array(
	'Ajouter un réseau social',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux sociaux', 'url'=>array('admin')),
);
?>

<h1>Ajouter un réseau social</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>