<?php

/**
 * This is the model class for table "tlog".
 *
 * The followings are the available columns in table 'tlog':
 * @property integer $id_task
 * @property integer $id_objective
 * @property string $dated
 * @property integer $id_user
 * @property integer $comment
 * @property integer $percent
 * @property integer $val
 */
class TaskLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TaskLog the static model class
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
		return 'tlog';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_task, id_objective, dated, id_user', 'required'),
			array('val, id_task, percent, id_objective, id_user', 'numerical', 'integerOnly'=>true),
		    array('comment','length','max' => 255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_task, comment,id_objective, dated, id_user', 'safe', 'on'=>'search'),
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
		        'objective'=>array(self::BELONGS_TO, 'Objective', 'id_objective'),
		        'user'=>array(self::BELONGS_TO, 'User', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_task' => 'Id Task',
			'id_objective' => 'Id Objective',
			'dated' => 'Dated',
			'id_user' => 'Id User',
		    'comment' => 'Comments',
		    'percent' => 'Percent Completed',
		    'val' => 'Value of progress',
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
		$criteria->compare('id_objective',$this->id_objective);
		$criteria->compare('dated',$this->dated,true);
		$criteria->compare('id_user',$this->id_user);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}