<?php
/* @var $this MajActualitesController */
/* @var $model Actualites */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'actualites-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Les champs marqués d'une <span class="required">*</span> sont requis.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_lieu'); ?>
		<?php echo $form->textField($model,'id_lieu'); ?>
		<?php echo $form->error($model,'id_lieu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titre'); ?>
		<?php echo $form->textArea($model,'titre',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'titre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'texte'); ?>
		<?php echo $form->textArea($model,'texte',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'texte'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'lien'); ?>
		<?php echo $form->textField($model,'lien',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lien'); ?>
	</div>

    <div class="row">
    <?php //echo "L'image sera automatiquement redimensionnée à 210 x 140 pixels"; ?>
    <?php echo $form->labelEx($model,'image') . "L'image sera automatiquement redimensionnée à 210 x 140 pixels<br />"; ?>
    <?php //echo CHtml::activeFileField($model, "image");?>
    
    <?php echo $form->fileField($model, 'image'); ?>
    <?php echo $form->error($model,'image'); ?>
    </div>
    
    <div class="row">
    <?php if ($model->image != "") echo CHtml::image(Yii::app()->request->baseUrl.'/../actupix/'.$model->image,"image",array("width"=>210, "height"=>140)); // pour le cas d'un update ?> 
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_debut'); ?>
		<?php //echo $form->textField($model,'date_debut'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker',array(
                'model'=>$model, //Model object
                'language' => 'fr',
                'attribute'=>'date_debut', //attribute name
                        'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'options'=>array(
                    'timeFormat'=>'hh:mm:ss',//strtolower(Yii::app()->locale->timeFormat),
                    'dateFormat'=>'yy-mm-dd',
                    'showSecond'=>true,
                ) // jquery plugin options
            ));
        ?>
		<?php echo $form->error($model,'date_debut'); ?>
	</div>
    


	<div class="row">
		<?php echo $form->labelEx($model,'date_fin'); ?>
		<?php //echo $form->textField($model,'date_fin'); ?>
        <?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
            $this->widget('CJuiDateTimePicker',array(
                'model'=>$model, //Model object
                'language' => 'fr',
                'attribute'=>'date_fin', //attribute name
                        'mode'=>'datetime', //use "time","date" or "datetime" (default)
                'options'=>array(
                    'timeFormat'=>'hh:mm:ss',//strtolower(Yii::app()->locale->timeFormat),
                    'dateFormat'=>'yy-mm-dd',
                    'showSecond'=>true,
                ) // jquery plugin options
            ));
        ?>
		<?php echo $form->error($model,'date_fin'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Créer' : 'Enregistrer'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->