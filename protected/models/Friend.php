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
    const STATUS_ACCEPTED = 'Accepted';
    const STATUS_REFUSED = 'Refused';
    const STATUS_PENDING = 'Pending';
    
    public function byuser($id_person)
    {
        echo "searching for friends if id_person1=$id_person";
        
        $this->getDbCriteria()->mergeWith(array(
                'condition'=>':personid in (id_person1)',
                'params' => array(':personid' => $id_person),
        ));
        return $this;
    }

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
        $user = User::model()->findByPk($id_user);
        $m = new Friend();
        $m->person2email = $email;
        $m->person2key = "key1";
        $m->requested_date = date('Y-m-d H:i:s');
        $m->id_person1 = $user->id_person;
        $m->id_person2 = 0;
        $m->status = self::STATUS_PENDING;
        if(!($rt = $m->save()))
        {
            echo "here:";
            print_r($m->getErrors());
            Yii::log("could not save request","error");
            return false;
        }
        return $m;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'friend';
    }

    public function getFullname()
    {
        if($this->person2)
        {
            return $this->person2->fullname;
        }
        return $this->person2email;
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
                'person2'=>array(self::BELONGS_TO, 'Person', 'id_person2'),
                'person1'=>array(self::BELONGS_TO, 'Person', 'id_person1'),
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