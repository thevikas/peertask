<?php

class FriendsController extends Controller
{
	public function actionAccept($id,$status = 'yes')
	{
	    $friend = Friend::model()->findByPk($id);
	    if($friend->person2email != Yii::app()->user->person->email)
	    {
	        Yii::log("not your friend record:$id for user:" . Yii::app()->user->id,"error");
	        return false;
	    }
	    if(Friend::STATUS_PENDING != $friend->status)
	    {
	        Yii::log("status of friendship is not pending, ignoring ($id)","warning");
	        $this->redirect(array('/friends'));
	    }
	    if('yes' == $status)
	    {
	        $friend->status = Friend::STATUS_ACCEPTED;
	        $friend->id_person2 = Yii::app()->user->id_person;
	    }
	    else
	    {
	        $friend->status = Friend::STATUS_REFUSED;
	    }
	    $friend->responded_date = $this->getDatestring();
	    if(!$friend->save())
	    {
	        print_r($friend->getErrors());
	    }
	    if(Friend::STATUS_ACCEPTED == $friend->status)
	    {
	        Log::model()->logAcceptFriend($friend);
	        
	        //add a second record with flipped person1 and person2 records
	        $friend2 = new Friend();
	        $friend2->id_person1 = $friend->id_person2;
	        $friend2->id_person2 = $friend->id_person1;
	        $friend2->person2email = 'accepted@email.com';
	        $friend2->person2key = 'key';
	        $friend2->status = $friend->status;
	        $friend2->requested_date = $this->getDatestring();
	        if(!$friend2->save())
	        {
	            print_r($friend2->getErrors());
	            die;
	        }
	    }
	    $this->redirect(array('/friends'));
	}

	public function actionIndex()
	{
	    echo "userid:" . Yii::app()->user->id;
		$friends = self::$dic->get('Friend')->byuser(Yii::app()->user->person->id_person)->findAll();
		$this->render('index',array('friends' => $friends));
	}

	public function actionNew()
	{
	    $model=new Friend('request');

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='friend-new-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
	    
	    if(isset($_POST['Friend']))
        {
            if($friend = $model->sendRequest(Yii::app()->user->id,$_POST['Friend']['person2email']))
            {
                Log::model()->logAddFriend($friend);
                $this->render('requestsent');
                return;
            }
        }
        $this->render('new',array('model'=>$model));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}