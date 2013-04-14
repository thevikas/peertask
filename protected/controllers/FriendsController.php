<?php

class FriendsController extends Controller
{
	public function actionAccept()
	{
		$this->render('accept');
	}

	public function actionIndex()
	{
	    echo "userid:" . Yii::app()->user->id;
		$friends = self::$dic->get('Friend')->byuser(Yii::app()->user->id)->findAll();
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
            if($model->sendRequest(Yii::app()->user->id,$_POST['Friend']['person2email']))
            {
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