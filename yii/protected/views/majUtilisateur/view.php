<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */

$this->breadcrumbs=array(
	'Gérer les profils utilisateur'=>array('admin'),
	'Voir le profil utilisateur : ' . $model->username,
);

$this->menu=array(
    array('label'=>'Gérer les profils utilisateurs', 'url'=>array('admin')),
	array('label'=>'Ajouter un profil utilisateur', 'url'=>array('create')),
	array('label'=>'Mettre à jour ce profil', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Effacer ce profil', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Voulez vous vraiment effacer cet élément?')),
);
?>

<h1>Voir le profil utilisateur : <?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_lieu',
		'username',
		'email',
		/*'password',*/
		'role',
		'valide',
		'derniere_connexion',
	),
)); ?>
