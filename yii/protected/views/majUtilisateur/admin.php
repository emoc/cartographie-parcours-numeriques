<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */

$this->breadcrumbs=array(
	'Gérer les profils utilisateur',
);

$this->menu=array(
	array('label'=>'Ajouter un profil utilisateur', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#utilisateurs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gérer les profils utilisateur</h1>

<p>
Une partie des informations de chaque profil est affichée dans le tableau ci-dessous, les fiches complètes sont accessibles en cliquant sur l'icone loupe à droite<br />
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
	'id'=>'utilisateurs-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_lieu',
		'username',
		'email',
		
		'role',
        'valide',
		'derniere_connexion',
		/*
		'password',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
