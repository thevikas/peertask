<?php

/**
 * This is the model class for table "task_user".
 *
 * The followings are the available columns in table 'task_user':
 * @property integer $id_taskuser
 * @property integer $id_task
 * @property integer $id_user
 * @property string $dated
 * @property integer $rel
 * @property integer $status
 * @property integer $id_from_user
 */
class TaskUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TaskUser the static model class
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
		return 'task_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_task, id_user, dated, rel, status, id_from_user', 'required'),
			array('id_task, id_user, rel, status, id_from_user', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_taskuser, id_task, id_user, dated, rel, status, id_from_user', 'safe', 'on'=>'search'),
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
	        'task'=>array(self::BELONGS_TO, 'Task', 'id_task'),
	        'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
	        'fromuser'=>array(self::BELONGS_TO, 'User', 'id_from_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_taskuser' => 'Id Taskuser',
			'id_task' => 'Task',
			'id_user' => 'Friend',
			'dated' => 'Dated',
			'rel' => 'Relationship',
			'status' => 'Status',
			'id_from_user' => 'From User',
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

		$criteria->compare('id_taskuser',$this->id_taskuser);
		$criteria->compare('id_task',$this->id_task);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('dated',$this->dated,true);
		$criteria->compare('rel',$this->rel);
		$criteria->compare('status',$this->status);
		$criteria->compare('id_from_user',$this->id_from_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}