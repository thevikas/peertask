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

    public function actionShare($id=0)
    {
        $model=new TaskUser;
        if($id)
            $model->id_task = $id;
        
        $me=User::model()->findByPk(Yii::app()->user->id);
         
        if(isset($_POST['TaskUser']))
        {
            $model->attributes=$_POST['TaskUser'];
            $model->rel = TaskUser::REL_SHAREDOWNER;
            $model->dated = $this->getDatestring();
            $model->status = TaskUser::STATUS_PENDING;
            $model->id_from_user = Yii::app()->user->id;
            if($model->validate())
            {
                $model->save();
                Log::model()->logShareTask($model);
                $this->redirect(array('/objectives/index'));
            }
        }
        $this->render('share',array('model' => $model,'me' => $me));
    }

    public function actionAccept($id)
    {
        $model=TaskUser::model()->findByPk($id);
        $model->status = TaskUser::STATUS_ACTIVE;
        $model->update(array('status'));
        Log::model()->logAcceptTask($model);
        $this->redirect(array('/objectives/index'));
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
                Log::model()->logCompleteTask($model);
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
                if(!$model->save())
                {
                    Yii::log("saving new task failed","error");
                    return false;
                }
                else
                    Log::model()->logAddTask($model);
                
                $model2 = new TaskUser();
                $model2->rel = TaskUser::REL_OWNER;
                $model2->dated = $this->getDatestring();
                $model2->status = TaskUser::STATUS_ACTIVE;
                $model2->id_user = $model2->id_from_user = Yii::app()->user->id;
                $model2->id_task = $model->id_task;
                if($model2->validate())
                {
                    if(!$model2->save())
                    {
                        Yii::log("saving new task failed","error");
                        return false;
                    }
                }
                //also add the task in task user
                $this->render('tasksaved',array('model'=>$model));
                return;
            }
        }
        $this->render('new',array('model'=>$model));
    }
}