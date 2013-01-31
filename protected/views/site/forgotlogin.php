<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
        'Login',
);
?>

    <div class="twelve columns">
    <!-- left column -->


      <ul class="breadcrumbs">
        <li><span>Home</span></li>
        <li><span>Forgot Login</span></li>
      </ul>

      <h2 class="h2-green">Recover Login Information</h2>

      <hr>
      <br class="clear">

	<?php $form=$this->beginWidget('CActiveForm', array(
	        'id'=>'login-form',
	        'enableClientValidation'=>true,
	        'clientOptions'=>array(
	                'validateOnSubmit'=>true,
	        ),
	        'htmlOptions' => array(
	                'class' => 'ten columns',
            ),
)); ?>

	<p class="note">
		Fields with <span class="required">*</span> are required.
	</p>

	<label>Email Address<sup>*</sup></label>
    <input type="text" name="email" class="email" />



    <br clear="left">

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit',array('class' => 'btn-green')); ?>
	</div>

	<?php $this->endWidget(); ?>

    </div>