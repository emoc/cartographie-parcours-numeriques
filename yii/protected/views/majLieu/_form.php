<?php
/* @var $this MajLieuController */
/* @var $model Lieux */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lieux-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs marqués d'une <span class="required">*</span> sont obligatoires.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_util'); ?>
		<?php echo $form->textField($model,'id_util'); ?>
		<?php echo $form->error($model,'id_util'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nom'); ?>
		<?php echo $form->textField($model,'nom',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', CHtml::listData(Lieux::model()->findAll(), 'type', 'type')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'presentation'); ?>
		<?php echo $form->textArea($model,'presentation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'presentation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'horaires'); ?>
		<?php echo $form->textArea($model,'horaires',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'horaires'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'activites'); ?>
		<?php echo $form->textArea($model,'activites',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'activites'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'acces_mobilite_reduite'); ?>
        oui <?php echo $form->radioButton($model,'acces_mobilite_reduite',array('value'=>1,'uncheckValue'=>null)); ?>
         non <?php echo $form->radioButton($model,'acces_mobilite_reduite',array('value'=>0,'uncheckValue'=>null)); ?>
		<?php echo $form->error($model,'acces_mobilite_reduite'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lien_article'); ?>
		<?php echo $form->textField($model,'lien_article',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lien_article'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude'); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude'); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'adresse'); ?>
		<?php echo $form->textField($model,'adresse',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'adresse'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code_postal'); ?>
		<?php echo $form->textField($model,'code_postal',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'code_postal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commune'); ?>
		<?php echo $form->textField($model,'commune',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'commune'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->emailField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'site_web'); ?>
		<?php echo $form->urlField($model,'site_web',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'site_web'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fil_rss'); ?>
		<?php echo $form->urlField($model,'fil_rss',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fil_rss'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Enregistrer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->