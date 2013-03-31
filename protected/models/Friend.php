<?php

/**
 * This is the model class for table "friend".
 *
 * The followings are the available columns in table 'friend':
 * @property integer $id_friend
 * @property integer $id_person1
 * @property integer $id_person2
 * @property string $person2email
 * @property string $person2key
 * @property string $requested_date
 * @property string $accepted_date
 */
class Friend extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Friend the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function sendRequest($id_user,$email)
	{
	    $m = $this->model(); 
	    $m->person2email = $email;
	    $m->person2key = "key1";
	    $m->id_person1 = $id_user;
	    if(!$rt = $m->save())
	    {
	        Yii::log("could not save request","error");
	    }
	    return $rt;
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'friend';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('person2email, person2key, requested_date', 'required'),
			array('id_person1, id_person2', 'numerical', 'integerOnly'=>true),
			array('person2email', 'length', 'max'=>255),
	        array('person2email', 'email'),
			array('person2key', 'length', 'max'=>15),
			array('accepted_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_friend, id_person1, id_person2, person2email, person2key, requested_date, accepted_date', 'safe', 'on'=>'search'),
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
			'id_friend' => 'Id Friend PK',
			'id_person1' => 'Requesting Person ID',
			'id_person2' => 'Requested Friend Person ID',
			'person2email' => 'Friend Email Address',
			'person2key' => 'Security Verify Key',
			'requested_date' => 'Requested Date',
			'accepted_date' => 'Accepted Date',
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

		$criteria->compare('id_friend',$this->id_friend);
		$criteria->compare('id_person1',$this->id_person1);
		$criteria->compare('id_person2',$this->id_person2);
		$criteria->compare('person2email',$this->person2email,true);
		$criteria->compare('person2key',$this->person2key,true);
		$criteria->compare('requested_date',$this->requested_date,true);
		$criteria->compare('accepted_date',$this->accepted_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}