<?php

/**
 * This is the model class for table "task".
 *
 * The followings are the available columns in table 'task':
 * @property integer $id_task
 * @property string $name
 * @property integer $id_objective
 */
class Task extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Task the static model class
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
		return 'task';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('id_objective', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_task, name, id_objective', 'safe', 'on'=>'search'),
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
		        'tasklogs'=>array(self::HAS_MANY, 'TaskLog', 'id_task'),
		        'mytask'=>array(self::HAS_ONE, 'TaskUser', 'id_task','condition' => 'mytask.id_user = ' . Yii::app()->user->id),
		        'objective'=>array(self::BELONGS_TO, 'Objective', 'id_objective'),
		        //'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_task' => 'Id Task',
			'name' => 'Name',
			'id_objective' => 'Id Objective',
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

		$criteria->compare('id_task',$this->id_task);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('id_objective',$this->id_objective);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}