<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-share-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id_user'); ?>
		<?php
		$person_list = CHtml::listData($me->person->friends, 'id_person2', 'fullname');
		$options = array(
		        'tabindex' => '0',
				'id' => 'combobox',
		        'empty' => '(not set)',
		);
		?>
		<?php echo CHtml::activeDropDownList($model,'id_user', $person_list, $options); ?>
		<?php echo CHtml::link('New Friend',array("friends/new"));?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'id_task'); ?>
		<?php
		$olist = CHtml::listData($me->mytasks, 'id_task', 'task.name');
		$options = array(
		        'tabindex' => '0',
				'id' => 'combobox',
		        'empty' => '(not set)',
		);
		?>
		<?php echo CHtml::activeDropDownList($model,'id_task', $olist, $options); ?>
		<?php echo CHtml::link('New Task',array("tasks/new"));?>
		<?php echo $form->error($model,'id_task'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->