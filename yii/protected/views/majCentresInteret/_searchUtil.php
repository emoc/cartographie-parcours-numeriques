<?php
/* @var $this MajCentresInteretController */
/* @var $model CentresInteret */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


    <div class="row">
		<?php echo $form->labelEx($model,'centre_interet'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                'name'=>'CentresInteret[centre_interet]',
                'value'=>$model->centre_interet,
                'source'=>$this->createUrl('MenuCentreInteretAutocomplete'),
                // additional javascript options for the autocomplete plugin
                'options'=>array(
                    'minLength'=>'0',
                ),
                'htmlOptions'=>array(
                    'size'=>60,
                    'maxlength'=>255,
                    'id'=>'CentresInteret_centre_interet',
                ),
            ));
        ?>
		<?php echo $form->error($model,'centre_interet'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Rechercher'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->