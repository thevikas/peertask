<ol>
<?php
foreach($tasks as $t)
{
    ?>
    <li>
        <?php echo $t->name;
        ?>
    </li>
    <?php 
} 
?>
</ol>