<?php
/* @var $this ObjectivesController */

$this->breadcrumbs=array(
	'Objectives',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<ol>
<?php
foreach($objectives as $obj)
{
    ?>
    <li>
	<?php echo $obj->name . " " . $obj->frequencyname . ' ';
	echo CHtml::link('edit',array('/objectives/update','id' => $obj->id_objective)) . ' ';
	echo CHtml::link('Add Task',array('/tasks/new','id_objective' => $obj->id_objective)) . ' ';
        echo $this->renderPartial("_tasks",array('tasks' => $obj->tasks));
        ?>
    </li>
    <?php 
} 
?>
</ol>
<?php echo CHtml::link('New Objective',array('/objectives/new'));?>