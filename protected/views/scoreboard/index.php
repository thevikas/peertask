<?php
/* @var $this ScoreboardController */

$this->breadcrumbs=array(
	'Scoreboard',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<table>
<?php
foreach($logs as $log)
{
    $param = unserialize($log->params);
    ?>
    <tr>
        <td><?php echo $log->dated;?></td>
        <td><strong><?php echo $param['score'];?></strong></td>
    </tr><?php 
} 
?>
</table>