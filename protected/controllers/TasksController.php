<?php

class TasksController extends Controller
{
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Task the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
	$model=Task::model()->findByPk($id);
	if($model===null)
	    throw new CHttpException(404,'The requested page does not exist.');
	return $model;
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
	$this->loadModel($id)->delete();

	$this->redirect(array('/objectives'));
    }


    public function actionUpdate($id)
    {
	$model=$this->loadModel($id);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if(isset($_POST['Task']))
	{
	    $model->attributes=$_POST['Task'];
	    if($model->save())
		$this->redirect(array('/objectives'));
	}

	$this->render('new',array(
		'model'=>$model,
	));
    }

	public function actionHistory()
	{
		$this->render('history');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogbook($id)
	{
	    $task = self::$dic->get('Task')->findByPk($id);
		$model=new TaskLog;
		$model->id_task = $task->id_task;
		$model->id_objective = $task->id_objective;
		$model->id_user = Yii::app()->user->id;
		$model->dated = $this->getDatestring();
    
        if(isset($_POST['TaskLog']))
        {
            $model->attributes=$_POST['TaskLog'];
            if($model->validate())
            {
                $model->save();
                $this->redirect(array('/objectives/index'));
            }
        }
        $this->render('logbook',array('model'=>$model));
	}

	public function actionNew($id_objective = 0)
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
		
		if($id_objective)
		    $model->id_objective = $id_objective;
    
        if(isset($_POST['Task']))
        {
            $model->attributes=$_POST['Task'];
            if($model->validate())
            {
                // form inputs are valid, do something here
                $model->save();
                $this->render('tasksaved',array('model'=>$model));
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