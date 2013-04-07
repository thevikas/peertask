<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-new-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'id_objective'); ?>
		<?php
		$olist = CHtml::listData(Objective::model()->byuser(Yii::app()->user->id)->findAll(), 'id_objective', 'name');
		$options = array(
		        'tabindex' => '0',
				'id' => 'combobox',
		        'empty' => '(not set)',
		);
		?>
		<?php echo CHtml::activeDropDownList($model,'id_objective', $olist, $options); ?>
		<a href="<?php echo $this->createUrl("/objective/new"); ?>">New Objective</a>
		<?php echo $form->error($model,'id_objective'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->