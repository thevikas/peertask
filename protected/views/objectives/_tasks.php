<ol>
<?php
foreach($tasks as $t)
{
    ?>
    <li>
	<?php 
	    echo $t->name . ' ';
    	echo CHtml::link('edit',array('/tasks/update','id' => $t->id_task)) . ' ';
    	echo CHtml::link('delete',array('/tasks/delete','id' => $t->id_task)) . ' ';
    	echo CHtml::link('log',array('/tasks/logbook','id' => $t->id_task)) . ' ';
    	echo CHtml::link('share',array('/tasks/share','id' => $t->id_task)) . ' ';
    	
    	if($t->mytask->rel == TaskUser::REL_SHAREDOWNER)
    	{
    	    $mytask = $t->mytask;
    	    echo "From: " . $mytask->fromuser->person->fullname . ' ';
    	    if($mytask->status == TaskUser::STATUS_PENDING)
    	    {
    	        echo CHtml::link('accept',array('/tasks/accept','id' => $mytask->id_taskuser)) . ' ';
    	    }
    	}
		else
		{
		    if(count($t->shared)>0)
		        echo "Shared with: ";
		    
		    foreach($t->shared as $tu)
		    {
		        echo ' <strong title="' . $tu->user->username . '">' . $tu->user->person->fullname . '</strong> ';
		    }
		    
		}
    ?>
    </li>
    <?php 
} 
?>
</ol>