<?php
/* @var $this MajLieuController */
/* @var $model Lieux */

$this->breadcrumbs=array(
	'Gérer les fiches de renseignements de lieux'=>array('admin'),
	$model->nom,
);

$this->menu=array(
	array('label'=>'Gérer les lieux', 'url'=>array('admin')),
    array('label'=>'Ajouter un lieu', 'url'=>array('create')),
	array('label'=>'Effacer cette fiche', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Voulez-vous vraiment effacer cet élément?'), 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->role==='2'),
);
?>

<h1><?php echo $model->nom; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_util',
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
