<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?>, <?php if(Yii::app()->user->id>0) echo Yii::app()->user->fullname;?></i></h1>

<?php
if(Yii::app()->user->id > 0)
{
    echo '<h3>Pending friend requests</h3>';
    echo '<ol>';
    foreach(Yii::app()->user->person->pending_friend_requests as $friend)
    {
         echo '<li>' . $friend->person1->fullname;
         echo ' ' . CHtml::link('accept',array('friends/accept','id' => $friend->id_friend));
         echo ' ' . CHtml::link('refuse',array('friends/accept','id' => $friend->id_friend,'status' => 'no'));
         echo '</li>';
    }
    echo '</ol>';
} 
?>