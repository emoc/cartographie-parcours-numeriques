<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */

$this->breadcrumbs=array(
	"Voir le profil : " . $model->username,
);

$this->menu=array(
	array('label'=>'Modifier cette fiche', 'url'=>array('updateUtil', 'id'=>$model->id)),
);
?>

<h1><?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*'id', */
		/*'id_lieu',*/
		'username',
		'email',
		/*'password',*/
		/*'role',
		'valide',*/
		'derniere_connexion',
	),
)); ?>
