<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */

$this->breadcrumbs=array(
	'Administrer les réseaux sociaux',
);

$this->menu=array(
	array('label'=>'Administrer les réseaux sociaux', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un réseau social', 'url'=>array('createUtil')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#reseaux-sociaux-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrer les réseaux sociaux</h1>

<p>
Vous pouvez utiliser un opérateur de comparaison (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
ou <b>=</b>) au début de chaque champ de recherche pour affiner la recherche avancée.<br />
Pour afficher les résultats dans l'ordre alphabétique d'une colonne, cliquez sur le nom de la colonne.
</p>

<?php echo CHtml::link('Recherche avancée','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_searchUtil',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'reseaux-sociaux-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*'id',
		'id_lieu',*/
		'reseau',
		'lien',
		array(
          'class'=>'CButtonColumn',
          'viewButtonUrl'=>'Yii::app()->createUrl("/majReseauxSociaux/viewUtil", array("id" => $data["id"]))',
          'updateButtonUrl'=>'Yii::app()->createUrl("/majReseauxSociaux/updateUtil", array("id" =>  $data["id"]))',
        ),
	),
)); ?>
