<?php
/* @var $this MajEspaceController */
/* @var $model Espaces */

$this->breadcrumbs=array(
	'Administrer les espaces',
);

$this->menu=array(
	array('label'=>'Administrer les espaces', 'url'=>array('adminUtil')),
	array('label'=>'Ajouter un espace', 'url'=>array('createUtil')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#espaces-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrer les espaces</h1>

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
	'id'=>'espaces-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*'id',
		'id_lieu',*/
		'espace',
		array(
          'class'=>'CButtonColumn',
          'viewButtonUrl'=>'Yii::app()->createUrl("/majEspaces/viewUtil", array("id" => $data["id"]))',
          'updateButtonUrl'=>'Yii::app()->createUrl("/majEspaces/updateUtil", array("id" =>  $data["id"]))',
        ),
	),
)); ?>
