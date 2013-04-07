<?php
/* @var $this ObjectiveController */
/* @var $model Objective */
/* @var $form CActiveForm */
?>

New objective <strong><?php echo $model->name;?></strong> saved. You can proceed to add some <?php echo CHtml::link('tasks',array('/tasks/new','id_objective' => $model->id_objective)); ?> into that.
</div><!-- form -->