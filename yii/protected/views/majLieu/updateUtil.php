<?php
/* @var $this MajLieuController */
/* @var $model Lieux */

$this->breadcrumbs=array(
	"Modifier la fiche : " . $model->nom,
);

$this->menu=array(
	array('label'=>'Voir la fiche', 'url'=>array('viewUtil', 'id'=>$model->id))
);
?>

<h1><?php echo $model->nom; ?></h1>

<?php $this->renderPartial('_formUtil', array('model'=>$model)); ?>