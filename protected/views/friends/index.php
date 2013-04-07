<?php
/* @var $this FriendsController */

$this->breadcrumbs=array(
	'Friends',
);
?>
<ol>
<?php
foreach($friends as $f)
{
    ?>
    <li>
    <?php echo $f->fullname;?>, <?php echo $f->status;?>
    </li>
    <?php
}
?>
</ol>
<?php echo CHtml::link('Invite a friend',array('/friends/new'));?>