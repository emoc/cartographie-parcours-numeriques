<?php
/* @var $this MajEspaceController */
/* @var $model Espaces */

$this->breadcrumbs=array(
	'Afficher un espace',
);

$this->menu=array(
	array('label'=>'Ajouter un espace', 'url'=>array('create')),
	array('label'=>'Administrer les espaces', 'url'=>array('admin')),
);
?>

<h1>Afficher un espace</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',*/
		'id_lieu',
		'espace',
	),
)); ?>
