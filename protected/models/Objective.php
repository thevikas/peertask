<?php

/**
 * This is the model class for table "objective".
 *
 * The followings are the available columns in table 'objective':
 * @property integer $id_objective
 * @property string $name
 * @property integer $id_user
 * @property integer $id_frequency
 */
class Objective extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Objective the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function byuser($id_user)
	{
        $this->getDbCriteria()->mergeWith(array(
                'condition'=>'id_user = :userid',
        		'params' => array(':userid' => $id_user),
        ));
        return $this;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'objective';
	}

	public function getFrequencyname()
	{
	    if($this->frequency)
		return $this->frequency->name;
	    else
		return 'n/a';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,id_user,id_frequency', 'required'),
			array('name', 'length', 'max'=>50),
		    array('id_user,id_frequency','numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_objective, name', 'safe', 'on'=>'search'),
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
	           'tasks'=>array(self::HAS_MANY, 'Task', 'id_objective'),
               'frequency'=>array(self::BELONGS_TO, 'Frequency', 'id_frequency'),
		       'tasklogs'=>array(self::HAS_MANY, 'TaskLog', 'id_objective','order' => 'id_tlog desc'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_objective' => 'Id Objective',
			'name' => 'Name',
		    'id_user' => 'User ID',
		    'id_frequency' => 'Frequency',
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

		$criteria->compare('id_objective',$this->id_objective);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}