<?php
/* @var $this MajCentresInteretController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Centres Interets',
);

$this->menu=array(
	array('label'=>'Create CentresInteret', 'url'=>array('create')),
	array('label'=>'Manage CentresInteret', 'url'=>array('admin')),
);
?>

<h1>Centres Interets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
