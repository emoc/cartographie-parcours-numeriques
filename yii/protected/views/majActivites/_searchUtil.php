<?php
/* @var $this MajActivitesController */
/* @var $model Activites */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'activite'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                'name'=>'Activites[activite]',
                'value'=>$model->activite,
                'source'=>$this->createUrl('MenuActiviteAutocomplete'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'minLength'=>'0',
                ),
                'htmlOptions'=>array(
                    'size'=>60,
                    'maxlength'=>255,
                    'id'=>'Activites_activite',
                ),
            ));
        ?>
		<?php echo $form->error($model,'activite'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Rechercher'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->