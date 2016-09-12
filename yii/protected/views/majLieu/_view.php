<?php
/* @var $this MajLieuController */
/* @var $data Lieux */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_util')); ?>:</b>
	<?php echo CHtml::encode($data->id_util); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nom')); ?>:</b>
	<?php echo CHtml::encode($data->nom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('presentation')); ?>:</b>
	<?php echo CHtml::encode($data->presentation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('horaires')); ?>:</b>
	<?php echo CHtml::encode($data->horaires); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activites')); ?>:</b>
	<?php echo CHtml::encode($data->activites); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('acces_mobilite_reduite')); ?>:</b>
	<?php echo CHtml::encode($data->acces_mobilite_reduite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lien_article')); ?>:</b>
	<?php echo CHtml::encode($data->lien_article); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('latitude')); ?>:</b>
	<?php echo CHtml::encode($data->latitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longitude')); ?>:</b>
	<?php echo CHtml::encode($data->longitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('adresse')); ?>:</b>
	<?php echo CHtml::encode($data->adresse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_postal')); ?>:</b>
	<?php echo CHtml::encode($data->code_postal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commune')); ?>:</b>
	<?php echo CHtml::encode($data->commune); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telephone')); ?>:</b>
	<?php echo CHtml::encode($data->telephone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site_web')); ?>:</b>
	<?php echo CHtml::encode($data->site_web); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fil_rss')); ?>:</b>
	<?php echo CHtml::encode($data->fil_rss); ?>
	<br />

	*/ ?>

</div>