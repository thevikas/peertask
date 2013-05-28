<?php

/**
 * This is the model class for table "alog".
 *
 * The followings are the available columns in table 'alog':
 * @property integer $logtype
 * @property string $dated
 * @property integer $id_user
 * @property string $params
 * @property integer $id_alog
 */
class Log extends CActiveRecord
{
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
    const L_UPDATEDSCORE     = 14;
    
    
    var $logtypes = array(
                self::L_ADDFRIEND,
                self::L_ACCEPTFRIEND,
                self::L_ADDOBJECTIVE,
                self::L_ADDTASK,
                self::L_COMPLETETASK,
                self::L_PARTIALCOMPLETE,
                self::L_SHARETASK,
                self::L_ACCEPTTASK,
                self::L_INVITEUSER,
                self::L_FAILTASKDAILY,
                self::L_FAILTASKWEEKLY,
                self::L_FAILTASKMONTHLY,
                self::L_FAILTASKFRIEND,
                self::L_UPDATEDSCORE,
            );
    
    
    public function logthis($logtype,$id_user,$params)
    {
        $log = new Log();
        $log->logtype = $logtype;
        $log->id_user = $id_user;
        $log->params = serialize($params);
        $log->dated = Controller::getDatestring();
        
        if(isset($params['id_task']))
            $log->id_task = $params['id_task'];
        
        $rt = $log->save();
        if(!$rt)
            Yii::log("error while saving log:" . var_export($log->getErrors(),true));
        return $rt;
    }
    
    public function logUpdateScore(Person $person)
    {
        $params = array('score' => $person->score);
        $this->logthis(self::L_UPDATEDSCORE,$person->user->id_user,$params);                
    }
    
    public function logAddFriend($friend)
    {
        $params = array('id_friend' => $friend->id_friend);
        $this->logthis(self::L_ADDFRIEND,$friend->person1->user->id_user,$params);                
    }
    
	public function logAcceptFriend(Friend $friend)
    {
        $params = array('id_friend' => $friend->id_friend,
                        'id_person1' => $friend->person1->user->id_user);
        $this->logthis(self::L_ACCEPTFRIEND,$friend->person1->user->id_user,$params);
        
        $params = array('id_friend' => $friend->id_friend,
                        'id_person2' => $friend->person2->user->id_user);
        
        $this->logthis(self::L_ACCEPTFRIEND,$friend->person2->user->id_user,$params);
    }
    
	public function logAddObjective(Objective $obj)
    {
        $params = array('id_objective' => $obj->id_objective);
        return $this->logthis(self::L_ADDOBJECTIVE,Yii::app()->user->id,$params);
    }
    
    public function logAddTask(Task $task)
    {
        $params = array('id_task' => $task->id_task);
        return $this->logthis(self::L_ADDTASK,Yii::app()->user->id,$params);
    }
    
    public function logCompleteTask(TaskLog $tasklog)
    {
        $params = array('id_task' => $tasklog->id_task);
        return $this->logthis(self::L_COMPLETETASK,Yii::app()->user->id,$params);
    }
    
    public function logPartialCompleteTask($id_task)
    {
        $params = array('id_task' => $id_task);
        return $this->logthis(self::L_PARTIALCOMPLETE,Yii::app()->user->id,$params);
    }
    
    public function logTaskFail(Objective $obj,$id_user)
    {
        $params = array('id_objective' => $obj->id_objective);
        return $this->logthis(self::L_FAILTASKDAILY,$id_user,$params);
    }
    
    public function logTaskFailFriend(Objective $obj,$id_user)
    {
        $params = array('id_objective' => $obj->id_objective);
        return $this->logthis(self::L_FAILTASKFRIEND,$id_user,$params);
    }
    
    public function logShareTask(TaskUser $tu)
    {
        $params = array('id_task' => $tu->id_task);
        return $this->logthis(self::L_SHARETASK,Yii::app()->user->id,$params);        
    }
    
    public function logAcceptTask(TaskUser $tu)
    {
        $params = array('id_task' => $tu->id_task);
        return $this->logthis(self::L_ACCEPTTASK,Yii::app()->user->id,$params);
    }
    
    public function logInviteUser($id_friend)
    {
        $params = array('id_friend' => $id_friend);
        return $this->logthis(self::L_INVITEUSER,Yii::app()->user->id,$params);        
    }
    
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Log the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('logtype, dated, id_user, params', 'required'),
			array('logtype, id_user, id_task', 'numerical', 'integerOnly'=>true),
			array('params', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('logtype, dated, id_user, params, id_alog', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		        'user' => array(self::BELONGS_TO,'User','id_user'),
		        'task' => array(self::BELONGS_TO,'Task','id_task'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'logtype' => 'Logtype',
			'dated' => 'Dated',
			'id_user' => 'Id User',
			'params' => 'Params',
			'id_alog' => 'Id Alog',
		    'id_task' => 'Task ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('logtype',$this->logtype);
		$criteria->compare('dated',$this->dated,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('params',$this->params,true);
		$criteria->compare('id_alog',$this->id_alog);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}