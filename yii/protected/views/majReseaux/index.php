<?php
/* @var $this MajReseauController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reseauxes',
);

$this->menu=array(
	array('label'=>'Create Reseaux', 'url'=>array('create')),
	array('label'=>'Manage Reseaux', 'url'=>array('admin')),
);
?>

<h1>Reseauxes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
