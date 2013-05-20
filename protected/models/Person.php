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
 * @property integet $score
 */
class Person extends CActiveRecord
{
	
	function save($rv = true,$a = null)
	{
	    $connection=Yii::app()->db;
	    $transaction=$connection->beginTransaction();
	    
	    $u = User::model()->find('username=?',array($this->email));
	    echo "checking " . $this->email;
	    if($u)
	    {
	        $this->addError('email', 'The email address is already registered. Please login instead.');
		    $transaction->rollback();
	        return false;    
	    }
	    
		$rt = parent::save($rv,$a);
		if(!$rt)
		{
		    $transaction->rollback();
			return $rt;
		}
		
		$u = new User;
		$u->username = $this->email;
		$u->id_person = $this->id_person;
		$u->password = '123456';
		$u->created = $u->updated = $this->created;
		//@todo not able to generate error due to unique of username.
		//now ignoring
		$rt = $u->save();
		if(1 || $rt)
		{
		    $transaction->commit();
		    return true;
		}
		/*9else
		{
		    $this->addErrors($u->getErrors());
		    $transaction->rollback();
		    return false;
		}	*/	
	}
	
	public function getFullname()
	{
	    //return (strlen($this->title)>0 ? $this->title . '. ' : '') . $this->first_name . ' ' . $this->last_name;
	    return $this->first_name . ' ' . $this->last_name;
	}
	
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
			array('created, updated, first_name, last_name, email, dob, gender', 'required'),
			array('gender,score', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email, source', 'length', 'max'=>50),
			array('email', 'email'),
			array('email', 'unique','message' => 'The email address is already registered. Please login instead.'),
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
            'user'   => array(self::HAS_ONE,   'User','id_person'),
	        //'friends'   => array(self::HAS_MANY,   'Friend','id_person1','condition' => 'id_person2 > 0'),
	        'friends' => array(self::MANY_MANY, 'Person','friend(id_person1,id_person2)','condition' => 'id_person2 > 0'),
		    'pending_friend_requests' => array(self::HAS_MANY,   'Friend',array('person2email' => 'email'),'condition' => 'id_person2 = 0'),
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
	        'score' => 'Score',
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