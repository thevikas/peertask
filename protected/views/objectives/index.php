<?php
/* @var $this ObjectivesController */

$this->breadcrumbs=array(
	'Objectives',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="linkbox">
<?php echo CHtml::link('Shared',array('/objectives/index','show' => 'shared'),array('class' => $sharedactive)); ?>
<?php echo CHtml::link('Mine',array('/objectives/index','show' => 'mine'),array('class' => $mineactive)); ?>
<?php echo CHtml::link('All',array('/objectives/index','show' => 'all'),array('class' => $allactive)); ?>
</div>

<ol>
<?php
foreach($objectives as $obj)
{
    ?>
    <li>
	<strong><?php echo $obj->name . " " . $obj->frequencyname . '</strong> ';
	echo CHtml::link('edit',array('/objectives/update','id' => $obj->id_objective)) . ' ';
	echo CHtml::link('Add Task',array('/tasks/new','id_objective' => $obj->id_objective)) . ' ';
        
        if(isset($obj->tasklogs[0]))
        {
            ?>
            <strong>
            <?php echo $obj->tasklogs[0]->dated . ' - ' .  $obj->tasklogs[0]->comment;?>
            </strong>
            <?php 
        }

                echo $this->renderPartial("_tasks",array('tasks' => $obj->tasks));
        ?>
    </li>
    <?php 
} 
?>
</ol>
<?php echo CHtml::link('New Objective',array('/objectives/new'));?>