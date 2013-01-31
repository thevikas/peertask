<?php

class ObjectivesController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionNew()
	{
        $model=new Objective('new');
    
        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='objective-new-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        */
    
        if(isset($_POST['Objective']))
        {
            $model->attributes=$_POST['Objective'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('new',array('model'=>$model));
	}

	public function actionProgess()
	{
		$this->render('progess');
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