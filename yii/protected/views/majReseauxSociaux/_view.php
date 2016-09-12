<?php
/* @var $this MajReseauxSociauxController */
/* @var $data ReseauxSociaux */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('lien')); ?>:</b>
	<?php echo CHtml::encode($data->lien); ?>
	<br />


</div>