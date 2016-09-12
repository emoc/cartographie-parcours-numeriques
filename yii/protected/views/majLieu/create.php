<?php
/* @var $this MajLieuController */
/* @var $model Lieux */

$this->breadcrumbs=array(
	'Gérer les fiches de renseignements de lieux'=>array('admin'),
	'Ajouter un nouveau lieu',
);

$this->menu=array(
	array('label'=>'Gérer les lieux', 'url'=>array('admin')),
);
?>

<h1>Ajouter une fiche de renseignements pour un nouveau lieu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>