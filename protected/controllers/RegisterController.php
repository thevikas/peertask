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
			if($model->save())
			{
			    $this->getSendMail()->toUser($model);
			    $this->render("success",array('model' => $model));    			    
			    return;
			}
			//@todo to check why validator and save method is seperate and what happens when save does not save and returns fals
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