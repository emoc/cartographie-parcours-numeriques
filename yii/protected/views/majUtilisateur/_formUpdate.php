<?php
/* @var $this MajUtilisateurController */
/* @var $model Utilisateurs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'utilisateurs-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs marqués d'une <span class="required">*</span> sont requis.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lieu'); ?>
		<?php echo $form->textField($model,'id_lieu'); ?>
		<?php echo $form->error($model,'id_lieu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<br /><br />
    <strong>Nouveau mot de passe</strong> (ne remplir qu'en cas de changement!)
	<div class="row">
      <?php echo $form->labelEx($model,'new_password'); ?>
      <?php echo $form->passwordField($model,'new_password',array('size'=>50,'maxlength'=>50)); ?>
      <?php echo $form->error($model,'new_password'); ?>
    </div>

    <div class="row">
      <?php echo $form->labelEx($model,'new_password_repeat'); ?>
      <?php echo $form->passwordField($model,'new_password_repeat',array('size'=>50,'maxlength'=>50)); ?>
      <?php echo $form->error($model,'new_password_repeat'); ?>
    </div>
    
    
	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?> 
		<?php echo $form->textField($model,'role'); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>
    (indiquer 1 pour un simple utilisateur, 2 pour un administrateur)

	<div class="row">
		<?php echo $form->labelEx($model,'valide'); ?> 
		<?php echo $form->textField($model,'valide'); ?>
		<?php echo $form->error($model,'valide'); ?>
	</div>
    (laisser vide)

	<div class="row">
		<?php //echo $form->labelEx($model,'derniere_connexion'); ?>
		<?php echo $form->hiddenField($model,'derniere_connexion'); ?>
		<?php echo $form->error($model,'derniere_connexion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Enregistrer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->