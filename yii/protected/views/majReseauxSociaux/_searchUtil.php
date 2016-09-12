<?php
/* @var $this MajReseauxSociauxController */
/* @var $model ReseauxSociaux */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

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
		<?php echo $form->label($model,'lien'); ?>
		<?php echo $form->textField($model,'lien',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Rechercher'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->