<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id_user
 * @property integer $id_person
 * @property string $username
 * @property string $password
 * @property string $created
 * @property string $updated
 */
class User extends CActiveRecord
{
    public $password_str;
    
    public function validatePassword($str)
    {
    
        $passhash = $this->hashPassword($str);
        return $this->password == $passhash;
    }
    
    public function hashPassword($str)
    {
        //$srcstring = $this->id_user . $str;
        //$h = hash('sha256',$srcstring);
        //echo "made hash ($srcstring): " . $h . "<br/>";
        return $str;
    }
    
    public function setPassword($str)
    {
        $this->password = $this->hashPassword($str);
        return parent::update(array('password'));
    
    }
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_person, username, password, created, updated', 'required'),
			array('id_person', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>50),
			array('password', 'length', 'max'=>30),
			array('username', 'unique','message' => 'The username is already registered. Please login instead.'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_user, id_person, username, password, created, updated', 'safe', 'on'=>'search'),
		);
	}
	
	public function getFriends()
	{
	    return $this->person->friends;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		        'objectives' => array(self::HAS_MANY, 'Objective', 'id_user'),
		        'mytasks' => array(self::HAS_MANY, 'TaskUser', 'id_user'),
		        'person' => array(self::BELONGS_TO, 'Person', 'id_person'),
		        //'friends'    => array(self::HAS_MANY, 'Friend', 'condition' => 'id_user in (id_person1,id_person2)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'id_person' => 'Id Person',
			'username' => 'Username',
			'password' => 'Password',
			'created' => 'Created',
			'updated' => 'Updated',
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

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_person',$this->id_person);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}