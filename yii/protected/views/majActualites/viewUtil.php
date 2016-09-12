<?php
/* @var $this MajActualitesController */
/* @var $model Actualites */

$this->breadcrumbs=array(
	'Afficher une actualité',
);

$this->menu=array(
	array('label'=>'Administrer les actualités', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter une actualité', 'url'=>array('createUtil')),
);
?>

<h1>Voir : <?php echo $model->titre; ?></h1>

<?php 
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id',
		'id_lieu',*/
		'titre',
		'texte',
		'image',
		'date_debut',
		'date_fin',
	),
)); 
echo CHtml::image(Yii::app()->request->baseUrl.'/../actupix/'.$model->image,"image",array("width"=>210, "height"=>140)); 
?>
