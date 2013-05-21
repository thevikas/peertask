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
    <?php echo $f->fullname;?>, <?php echo $f->status;?> - <?php if(isset($f->person2)) echo $f->person2->score;?>
    </li>
    <?php
}
?>
</ol>
<?php echo CHtml::link('Invite a friend',array('/friends/new'));?>