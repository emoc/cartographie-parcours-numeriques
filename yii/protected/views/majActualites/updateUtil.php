<?php
/* @var $this MajActualitesController */
/* @var $model Actualites */

$this->breadcrumbs=array(
	'Mettre à jour une actualité',
);

$this->menu=array(
	array('label'=>'Administrer les actualités', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter une actualité', 'url'=>array('createUtil')),
);
?>

<h1>Mettre à jour <?php echo $model->titre; ?></h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>