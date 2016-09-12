<?php
/* @var $this MajCentresInteretController */
/* @var $data CentresInteret */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lieu')); ?>:</b>
	<?php echo CHtml::encode($data->id_lieu); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('centre_interet')); ?>:</b>
	<?php echo CHtml::encode($data->centre_interet); ?>
	<br />


</div>