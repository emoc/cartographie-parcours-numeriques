<?php
/* @var $this MajActivitesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Activites',
);

$this->menu=array(
	array('label'=>'Create Activites', 'url'=>array('create')),
	array('label'=>'Manage Activites', 'url'=>array('admin')),
);
?>

<h1>Activites</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
