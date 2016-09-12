<?php
/* @var $this MajLieuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lieuxes',
);

$this->menu=array(
	array('label'=>'Create Lieux', 'url'=>array('create')),
	array('label'=>'Manage Lieux', 'url'=>array('admin')),
);
?>

<h1>Lieuxes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
