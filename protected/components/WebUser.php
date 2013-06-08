<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

    // Store model to not repeat query.
    private $_model;
    

    // Return first name.
    // access it by Yii::app()->user->first_name
    function getFullname()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        if(isset($user->person->fullname))
            return $user->person->fullname;
        else
            return 'Anonymous';
    }
    
    function getid_person()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->id_person;
    }
    
    // Return first name.
    // access it by Yii::app()->user->first_name
    function getPerson()
    {
        if(Yii::app()->user->id)
        {
            $user = $this->loadUser(Yii::app()->user->id);
            if($user)
                return $user->person;
        }
        return new Person();   
    }

    // Return first name.
    // access it by Yii::app()->user->first_name
    function getFriends()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->person->friends;
    }
    
    // This is a function that checks the field 'role'
    // in the User model to be equal to 1, that means it's admin
    // access it by Yii::app()->user->isAdmin()
    function isAdmin()
    {
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->role) == 1;
    }

    // Load user model.
    protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=User::model()->findByPk($id);
        }
        return $this->_model;
    }
}