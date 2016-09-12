<?php
/* @var $this MajReseauxSociauxController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reseaux Sociauxes',
);

$this->menu=array(
	array('label'=>'Create ReseauxSociaux', 'url'=>array('create')),
	array('label'=>'Manage ReseauxSociaux', 'url'=>array('admin')),
);
?>

<h1>Reseaux Sociauxes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
