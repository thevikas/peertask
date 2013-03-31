<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public static $dic;
    
    public function isLoggedIn()
    {
    	return !Yii::app()->user->getIsGuest();
    }

    /**
     * Returns new SendMail object
     * @return SendMail
     */
    public function getSendMail()
    {
    	return self::$dic->get('SendMail');
    }

    public function __construct($id,$module=null)
    {
        parent::__construct($id,$module);
        if(!is_object(self::$dic))
        {
            Controller::$dic = new Bucket();
            Controller::$dic->set(Yii::app()->mail,'yiiMail');
        }
    }

    function render($view,$data=null,$return=false)
    {
        $out = parent::render($view,$data,true);

        if(isset(Yii::app()->params['runmode']) && Yii::app()->params['runmode'] == 'test')
        {
            global $render_output;
            return $render_output = $out;
        }

        if($return)
            return $out;
        else
            echo $out;
    }
    
    public function sendHeader($str)
    {
        if(isset(Yii::app()->params['runmode']) && Yii::app()->params['runmode'] == 'test')
        {
            //do nothing
            return;
        }
        else
        {
            header($str);
        }
    }
}

class CExceptionEOF extends CException {}
class CExceptionBadValue extends CException {}
class CExceptionLogError extends CException {}