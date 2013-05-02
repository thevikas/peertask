<?php

class ObjectivesController extends Controller
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
        $model=Objective::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Objective']))
        {
            $model->attributes=$_POST['Objective'];
            if($model->save())
                $this->redirect(array('/objectives'));
        }

        $this->render('new',array(
                'model'=>$model,
        ));
    }

    public function actionIndex()
    {
        $obs = self::$dic->get('Objective')->bytaskuser(Yii::app()->user->id)->findAll();
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
                Log::model()->logAddObjective($model);
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