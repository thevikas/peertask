<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $id_person
 * @property string $created
 * @property string $updated
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $dob
 * @property integer $gender
 * @property string $source
 */
class Person extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Person the static model class
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
		return 'person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created, updated, first_name, last_name, email, dob, gender, source', 'required'),
			array('gender', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email, source', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_person, created, updated, first_name, last_name, email, dob, gender, source', 'safe', 'on'=>'search'),
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
			'id_person' => 'Id Person',
			'created' => 'Created',
			'updated' => 'Updated',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'dob' => 'Dob',
			'gender' => 'Gender',
			'source' => 'Source',
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

		$criteria->compare('id_person',$this->id_person);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('source',$this->source,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}