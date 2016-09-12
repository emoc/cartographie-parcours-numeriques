<?php
/* @var $this MajActualitesController */
/* @var $data Actualites */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lieu')); ?>:</b>
	<?php echo CHtml::encode($data->id_lieu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('titre')); ?>:</b>
	<?php echo CHtml::encode($data->titre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('texte')); ?>:</b>
	<?php echo CHtml::encode($data->texte); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('lien')); ?>:</b>
	<?php echo CHtml::encode($data->lien); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('image')); ?>:</b>
	<?php echo CHtml::encode($data->image); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_debut')); ?>:</b>
	<?php echo CHtml::encode($data->date_debut); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_fin')); ?>:</b>
	<?php echo CHtml::encode($data->date_fin); ?>
	<br />


</div>