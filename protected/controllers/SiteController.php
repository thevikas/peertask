<?php

class SiteController extends Controller
{
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                        'class'=>'CCaptchaAction',
                        'backColor'=>0xFFFFFF,
                ),
                // page action renders "static" pages stored under 'protected/views/site/pages'
                // They can be accessed via: index.php?r=site/page&view=FileName
                'page'=>array(
                        'class'=>'CViewAction',
                ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
         
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                        "Reply-To: {$model->email}\r\n".
                        "MIME-Version: 1.0\r\n".
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
            {
                $this->redirect(Yii::app()->user->returnUrl);
                return;
            }
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }

    /**
     * @totest
     * @todo
     */
    public function actionForgotlogin()
    {
        if(isset($_POST['email']))
        {
            $mod = Person::model()->find('email = :email',array(':email' => $_POST['email']));
            //if the person with this email was found, the mail is sent.
            //otherwise, we still dont report the user that email is wrong
            if($mod)
            {
                $mod->user->password_str = $mod->user->password;
                $this->getSendMail()->toUser($mod);
            }
            else
            {
                Yii::log("email:" . $_POST['email'] . " was not found in forgot pass");
            }
            $this->render('afterforgot');
            return;
        }
        $this->render('forgotlogin');
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function checkFailures($id_frequency,$dt1,$dt2)
    {
        $freq = Frequency::model()->findByPk($id_frequency);
        $objectives = Objective::model()->findAll('id_frequency = ?',array($id_frequency));
        foreach($objectives as $obj)
        {
            echo "loopong for {$obj->name}($obj->id_objective)<br/>";
            //find tasks for this user for this objective
            $tasks = TaskUser::model()->with('task.objective')->findAll('objective.id_objective = :obj',array(':obj' => $obj->id_objective));
            if(!$tasks)
                continue;

            foreach($tasks as $t)
            {
                $tid[] = $t->id_task;
            }

            $criteria = new CDbCriteria();
            $criteria->addCondition('logtype = :logt');
            $criteria->addCondition('date(dated)>=date(:dt1) and date(dated)<=date(:dt2)');
            $criteria->params = array(
                    ':dt1' => date('Y-m-d',$dt1),
                    ':dt2' => date('Y-m-d',$dt2),
                    ':logt' => Log::L_COMPLETETASK,
            );
            $criteria->addInCondition("id_task", $tid);
            unset($tid);
            $logs = Log::model()->findAll($criteria);
            if(!$logs)
            {
                $c2 = new CDbCriteria();
                $c2->with = array('task.objective');
                $c2->select = array('t.id_user');
                $c2->distinct = true;
                $c2->group = 't.id_user';
                $c2->together = true;
                $c2->addCondition('objective.id_objective = :obj');
                $c2->params = array(':obj' => $obj->id_objective);

                $users = TaskUser::model()->findAll($c2);
                foreach($users as $user)
                {
                    //L_FAILTASKDAILY
                    Log::model()->logTaskFail($obj,$user->id_user);
                    echo "{$obj->name} - {$user->user->person->fullname}({$user->id_user}) not done {$freq->name}<br/>";
                    
                    foreach($user->user->person->friends as $friend)
                    {
                        echo "{$obj->name} - {$friend->fullname}({$friend->user->id_user}) friend did not help to get done {$freq->name}<br/>";
                        Log::model()->logTaskFailFriend($obj,$friend->user->id_user);
                    }
                }


            }
            $j=0;
            foreach($logs as $log)
            {
                echo "$j:{$log->task->objective->name}->{$log->task->name} found ({$log->task->objective->frequency->name})<br/>";
                $j++;
            }
        }
    }

    public function actionCron()
    {
        //Log::model()->deleteAll();
        
        //locate incomplete daily tasks
        //log incomplete tasks        
        $this->checkFailures(1,strtotime('-1 day'),time());
        
        
        //on sundays,
        $dw = date( "w" );
        if($dw == 0)
        {
            $this->checkFailures(2,strtotime('-1 week'),time());
            //locate incomplete weekly tasks
            //log incomplet tasks
        }
        
        $d = date( "d" );
        if($d == 1)
        {
            //on first days of month
            //locate incomplete tasks for month
            //log incomplete tasks
        }

        //do scoring for all users
        
        /*
        const L_ADDFRIEND        = 1; //20130401
        const L_ACCEPTFRIEND     = 2; //20130401
        const L_ADDOBJECTIVE     = 3; //20130402
        const L_ADDTASK          = 4; //20130402
        const L_COMPLETETASK     = 5; //20130520
        const L_PARTIALCOMPLETE  = 6;
        const L_SHARETASK        = 7;
        const L_ACCEPTTASK       = 8;
        const L_INVITEUSER       = 9;
        const L_FAILTASKDAILY    = 10; //20130520
        const L_FAILTASKWEEKLY   = 11;
        const L_FAILTASKMONTHLY  = 12;
        const L_FAILTASKFRIEND   = 13;
        */
        
        
        
        
        $score[Log::L_COMPLETETASK] = 20;
        $score[Log::L_PARTIALCOMPLETE] = 17;
        
        $score[Log::L_INVITEUSER] = 10;
        $score[Log::L_ADDFRIEND] = 10;
        
        $score[Log::L_ACCEPTFRIEND] = 8;
        
        $score[Log::L_ADDOBJECTIVE] = 7;
        $score[Log::L_ADDTASK] = 7;
        
        $score[Log::L_SHARETASK] = 10;
        $score[Log::L_ACCEPTTASK] = 10;
        
        $score[Log::L_FAILTASKDAILY] = -3;
        $score[Log::L_FAILTASKWEEKLY] = -3;
        $score[Log::L_FAILTASKMONTHLY] = -3;
        
        $score[Log::L_FAILTASKFRIEND] = $score[Log::L_FAILTASKDAILY]+1;

        $userids = array();
        $userscore = array();
        
        foreach(User::model()->findAll() as $user)
        {
            $userids[] = $user->id_user;
            $userscore[$user->id_user] = 0;
        }
        
        
        foreach(Log::model()->logtypes as $logt)
        {
            foreach($userids as $userid)
            {
                $data=Yii::app()->db->createCommand()
                            ->select('logtype,count(*) as ctr')
                            ->from('alog')
                            ->where('id_user=? and logtype=?',array($userid,$logt))
                            ->group('logtype')->queryAll();
                if(!$data)
                    continue;
                   
                echo "User: $userid<br/>";
                print_r($data);
                foreach($data as $r)
                {                    
                    //echo "v = " . $score[$r['logtype']];
                    $userscore[$userid] += $score[$r['logtype']] * $r['ctr'];
                }
                   
            }
        }
        
        print_r($userscore); 
        //die;
        
        foreach($userscore as $uid => $s)
        {
            //echo "uid: $uid\n";
            $user = User::model()->findByPk($uid);
            if(!$user->person)
                continue;
            $person = $user->person;
            $person->score = $s;
            $person->update(array('score'));
        }
    }
}