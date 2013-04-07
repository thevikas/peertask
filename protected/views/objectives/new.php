<?php
/* @var $this ObjectiveController */
/* @var $model Objective */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'objective-new-form',
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
		<?php echo $form->labelEx($model,'id_frequency'); ?>
		<?php
		$olist = CHtml::listData(Frequenct::model()->findAll(), 'id_frequency', 'name');
		$options = array(
		        'tabindex' => '0',
				'id' => 'combobox',
		        'empty' => '(not set)',
		);
		?>
		<?php echo CHtml::activeDropDownList($model,'id_frequency', $olist, $options); ?>		
		<?php echo $form->error($model,'id_frequency'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->