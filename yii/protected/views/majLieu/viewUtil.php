<?php
/* @var $this MajLieuController */
/* @var $model Lieux */

$this->breadcrumbs=array(
	"Voir la fiche : " . $model->nom,
);

$this->menu=array(
	array('label'=>'Modifier cette fiche', 'url'=>array('updateUtil', 'id'=>$model->id)),
);
?>

<h1><?php echo $model->nom; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nom',
		'type',
		'presentation',
		'horaires',
		'activites',
		'acces_mobilite_reduite',
		'lien_article',
		'latitude',
		'longitude',
		'adresse',
		'code_postal',
		'commune',
		'email',
		'telephone',
		'site_web',
		'fil_rss',
	),
)); ?>
