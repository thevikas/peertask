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
    <?php
     if($f->status == Friend::STATUS_PENDING) 
     {
         echo ' ' . CHtml::link('accept',array('friends/accept','id' => $f->id_friend));
         echo ' ' . CHtml::link('refuse',array('friends/accept','id' => $f->id_friend,'status' => 'no'));
     }
     ?>
    </li>
    <?php
}
?>
</ol>
<?php echo CHtml::link('Invite a friend',array('/friends/new'));?>