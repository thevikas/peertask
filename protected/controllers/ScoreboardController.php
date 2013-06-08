<?php

class ScoreboardController extends Controller
{
	public function actionIndex()
	{
	    //list the user's scrore history
	    $logs = Log::model()->byuser(Yii::app()->user->id)->bytype(Log::L_UPDATEDSCORE)->findAll();
	    //print_r($logs[0]);
		$this->render('index',array('logs' => $logs));
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