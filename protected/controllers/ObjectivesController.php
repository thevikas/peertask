<?php

class ObjectivesController extends Controller
{
	public function actionIndex()
	{
	    $obs = self::$dic->get('Objective')->byuser(Yii::app()->user->id)->findAll();
		$this->render('index',array('objectives' => $obs));
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
            $model->id_user = Yii::app()->user->id;
            if($model->validate())
            {
                // form inputs are valid, do something here
                $model->save();
                $this->render('newsaved',array('model'=>$model));
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