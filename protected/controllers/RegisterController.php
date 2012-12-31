<?php

class RegisterController extends Controller
{
	public function actionIndex()
	{
		$model=new Person('register');

		// uncomment the following code to enable ajax-based validation
		/*
		if(isset($_POST['ajax']) && $_POST['ajax']==='person-register-form')
		{
		echo CActiveForm::validate($model);
		Yii::app()->end();
		}
		*/

		if(isset($_POST['Person']))
		{
			$model->attributes=$_POST['Person'];
			$model->updated = $model->created = date('Y-m-d H:i:s');
			if($model->validate())
			{
				$model->save();
				// form inputs are valid, do something here
				return;
			}
		}
		$this->render('register',array('model'=>$model));
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