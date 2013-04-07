<?php

/**
 * This is the model class for table "frequency".
 *
 * The followings are the available columns in table 'frequency':
 * @property integer $id_frequency
 * @property string $name
 * @property integer $days_in_frequency
 */
class Frequency extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Frequency the static model class
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
		return 'frequency';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, days_in_frequency', 'required'),
			array('days_in_frequency', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_frequency, name, days_in_frequency', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_frequency' => 'Id Frequency',
			'name' => 'Name',
			'days_in_frequency' => 'Days In Frequency',
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

		$criteria->compare('id_frequency',$this->id_frequency);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('days_in_frequency',$this->days_in_frequency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}