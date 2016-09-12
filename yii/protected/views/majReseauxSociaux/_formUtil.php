<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reseaux-sociaux-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Les champs marqués d'une <span class="required">*</span> sont requis.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'id_lieu'); ?>
		<?php echo $model->id_lieu; //echo $form->textField($model,'id_lieu'); ?>
		<?php //echo $form->error($model,'id_lieu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reseau'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                'name'=>'ReseauxSociaux[reseau]',
                'value'=>$model->reseau,
                'source'=>$this->createUrl('MenuReseauSocialAutocomplete'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'minLength'=>'0',
                ),
                'htmlOptions'=>array(
                    'size'=>60,
                    'maxlength'=>255,
                    'id'=>'ReseauxSociaux_reseau',
                ),
            ));
        ?>
		<?php echo $form->error($model,'reseau'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lien'); ?>
		<?php echo $form->textField($model,'lien',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lien'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Enregistrer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->