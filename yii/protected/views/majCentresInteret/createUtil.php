<?php
/* @var $this MajCentresInteretController */
/* @var $model CentresInteret */

$this->breadcrumbs=array(
	"Ajouter un centre d'intérêt",
);

$this->menu=array(
	array('label'=>"Administrer les centres d'intérêt", 'url'=>array('adminUtil')),
);
?>

<h1>Ajouter un centre d'intérêt</h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>