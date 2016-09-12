<?php
/* @var $this MajLieuController */
/* @var $model Lieux */

$this->breadcrumbs=array(
	'Gérer les fiches de renseignements de lieux',
);

$this->menu=array(
	array('label'=>'Ajouter un nouveau lieu', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lieux-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gérer les fiches de renseignements de lieux</h1>

<p>
Une partie des informations de chaque lieu est affichée dans le tableau ci-dessous, les fiches complètes sont accessibles en cliquant sur l'icone loupe à droite<br />
Vous pouvez utiliser un opérateur de comparaison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) au début de chaque champ de recherche pour affiner la recherche avancée.<br />
Pour afficher les résultats dans l'ordre alphabétique d'une colonne, cliquez sur le nom de la colonne.
</p>

<?php echo CHtml::link('Recherche avancée','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lieux-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'enablePagination'=>true,
	'columns'=>array(
		'id', //array( 'name'=>'id','header'=>'ID lieu' ),
        'id_util', //array( 'name'=>'id_util','header'=>'ID utilisateur' ),
		'nom',
		'commune',
		'email',
        'telephone',
        /*
        'type',
        'adresse',
        'code_postal',
        'presentation',
		'horaires',
		'activites',
		'acces_mobilite_reduite',
		'lien_article',
		'latitude',
		'longitude',
		'site_web',
		'fil_rss',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
