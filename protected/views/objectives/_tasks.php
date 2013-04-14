<ol>
<?php
foreach($tasks as $t)
{
    ?>
    <li>
	<?php echo $t->name . ' ';
	echo CHtml::link('edit',array('/tasks/update','id' => $t->id_task)) . ' ';
	echo CHtml::link('delete',array('/tasks/delete','id' => $t->id_task)) . ' ';
	echo CHtml::link('log',array('/tasks/logbook','id' => $t->id_task)) . ' ';
	echo CHtml::link('share',array('/tasks/share','id' => $t->id_task)) . ' ';
        ?>
    </li>
    <?php 
} 
?>
</ol>