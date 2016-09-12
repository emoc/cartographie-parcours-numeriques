<?php
/* @var $this MajEspaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Espaces',
);

$this->menu=array(
	array('label'=>'Create Espaces', 'url'=>array('create')),
	array('label'=>'Manage Espaces', 'url'=>array('admin')),
);
?>

<h1>Espaces</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
