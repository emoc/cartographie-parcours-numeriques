<?php
/* @var $this MajActualitesController */
/* @var $model Actualites */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<!-- div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div -->

	<div class="row">
		<?php echo $form->label($model,'id_lieu'); ?>
		<?php echo $form->textField($model,'id_lieu'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titre'); ?>
		<?php echo $form->textArea($model,'titre',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'texte'); ?>
		<?php echo $form->textArea($model,'texte',array('rows'=>6, 'cols'=>50)); ?>
	</div>
    
    <div class="row">
		<?php echo $form->label($model,'lien'); ?>
		<?php echo $form->textField($model,'lien',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_debut'); ?>
		<?php echo $form->textField($model,'date_debut'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date_fin'); ?>
		<?php echo $form->textField($model,'date_fin'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Rechercher'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->