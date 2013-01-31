<?php

class TasksController extends Controller
{
	public function actionHistory()
	{
		$this->render('history');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogbook()
	{
		$this->render('logbook');
	}

	public function actionNew()
	{
		$model=new Task('new');

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='task-new-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
    
        if(isset($_POST['Task']))
        {
            $model->attributes=$_POST['Task'];
            if($model->validate())
            {
                // form inputs are valid, do something here
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