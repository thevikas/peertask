<table class="tasklog">
<?php
foreach($task->tasklogs as $log)
{
      ?>
      <tr>
          <td><?php echo $log->dated; ?></td>
          <td><?php echo $log->comment; ?></td>
      </tr>
      <?php   
}
?>
</table>