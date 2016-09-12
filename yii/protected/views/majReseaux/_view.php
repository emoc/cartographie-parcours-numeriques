<?php
/* @var $this MajReseauController */
/* @var $data Reseaux */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lieu')); ?>:</b>
	<?php echo CHtml::encode($data->id_lieu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reseau')); ?>:</b>
	<?php echo CHtml::encode($data->reseau); ?>
	<br />


</div>