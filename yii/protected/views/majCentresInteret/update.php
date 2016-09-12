<?php
/* @var $this MajCentresInteretController */
/* @var $model CentresInteret */

$this->breadcrumbs=array(
	"Mettre à jour un centre d'intérêt",
);

$this->menu=array(
	array('label'=>"Ajouter un centre d'intérêt", 'url'=>array('create')),
	array('label'=>"Administrer les centres d'intérêt", 'url'=>array('admin')),
);
?>

<h1>Mettre à jour un centre d'intérêt</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>