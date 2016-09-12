<?php
/* @var $this MajLieuController */
/* @var $model Lieux */

$this->breadcrumbs=array(
	'Gérer les fiches de renseignements de lieux'=>array('admin'),
	'Modifier un lieu',
);

$this->menu=array(
	array('label'=>'Gérer les lieux', 'url'=>array('admin')),
    array('label'=>'Ajouter un lieu', 'url'=>array('create')),
);
?>

<h1>Mettre à jour un lieu</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>