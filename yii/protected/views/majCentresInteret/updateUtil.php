<?php
/* @var $this MajCentresInteretController */
/* @var $model CentresInteret */

$this->breadcrumbs=array(
	"Mettre à jour un centre d'intérêt",
);

$this->menu=array(
	array('label'=>"Administrer les centres d'intérêt", 'url'=>array('adminUtil')),
	array('label'=>"Ajouter un centre d'intérêt", 'url'=>array('createUtil')),
);
?>

<h1>Mettre à jour</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>