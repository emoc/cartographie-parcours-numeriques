<?php
/* @var $this MajActualitesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Actualites',
);

$this->menu=array(
	array('label'=>'Create Actualites', 'url'=>array('create')),
	array('label'=>'Manage Actualites', 'url'=>array('admin')),
);
?>

<h1>Actualites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
