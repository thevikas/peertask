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
        <?php echo $obj->name;
        echo $this->renderPartial("_tasks",array('tasks' => $obj->tasks));
        ?>
    </li>
    <?php 
} 
?>
</ol>