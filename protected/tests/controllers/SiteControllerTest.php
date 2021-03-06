<?php
/**
 * Test class for ParticipantController.
 * Generated by PHPUnit on 2012-06-29 at 13:09:10.
 * Test passed on 20121214
 */
class SiteControllerTest extends UnitTestCase
{
	public $fixturesOff=array(
			'user' => 'User',
			'person' => 'Person',
	);

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	*/
	protected function setUp()
	{
		$_SERVER=array(
				'SERVER_NAME'=>'testing.local', // the other fields should follow
				'SCRIPT_FILENAME'=> realpath("../../index.php"), // the other fields should follow
				'SCRIPT_NAME'=>'index.php', // the other fields should follow
				'REQUEST_URI' => 'participant/register',
				'PHP_SELF'=>'', // the other fields should follow
		);
		//$wpdb->dbh = Yii::app()->db;
		parent::setup();
	}


	function passTestdata()
	{
		return array(
				array(true),
				array(false),
		);
	}

	/**
	 * @group login
	 */
	public function testLogin1()
	{
		Yii::app()->runController('site/login');
		libxml_use_internal_errors(true);
		$this->assertXpathExists("//input[@name='LoginForm[password]']");
		libxml_use_internal_errors(true);
		$this->assertXpathExists("//input[@name='LoginForm[username]']");
	}

	/**
	 * @group login
	 */
	public function testLogout()
	{
		Yii::app()->runController('site/logout');
	}

	public function testHomePage()
	{
		Yii::app()->runController('/');
	}

	/**
	 * @group login
	 */
	public function testLoginFull()
	{
		$this->getFixtureManager()->load(array(
				'user'=>'User',
				'Person',
		));
		 
		$mockSession = $this->getMock('CHttpSession', array('regenerateID'));
		Yii::app()->setComponent('session', $mockSession);
		 

		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_POST['LoginForm']['username'] = 'testuser1@testing.com';
		$_POST['LoginForm']['password'] = 'pass1';
		Yii::app()->runController('site/login');
		global $redirect_url,$redirect_status;

		$this->assertEquals('index.php',$redirect_url);
	}

	/*public function testLoginFull2()
	 {
	$_SERVER['REQUEST_METHOD'] = 'POST';
	$_POST['LoginForm']['username'] = 'frisk@testing.com';
	$_POST['LoginForm']['password'] = 'frisk33@';
	$_POST['ajax']='login-form';
	Yii::app()->runController('site/login');
	$this->assertXpathExists("//input[@name='LoginForm[password]']");
	$this->assertXpathExists("//input[@name='LoginForm[username]']");
	}*/


	/**
	 *
	 * 201212212000:vikas:#202:testing site contactus
	 */
	public function testForgotloginPost1()
	{
		$_POST['email'] = 'vikas@vikas.com';
		Yii::app()->runController('site/forgotlogin');
		$this->assertXpathExists('//p/strong[text()="Your login details have been sent to your mailbox."]');
		//$this->assertOutputContains('Subscription Status: Inactive');
	}

	/**
	 * friskU6P6@testing.com
	 * 201212212000:vikas:#202:testing site contactus
	 */
	public function testForgotloginPost2()
	{
		$_POST['email'] = 'forgottest@investvine.com';
		Yii::app()->runController('site/forgotlogin');
		$this->assertXpathExists('//p/strong[text()="Your login details have been sent to your mailbox."]');
		//$this->assertOutputContains('Subscription Status: Inactive');
	}

	/**
	 * 201212212000:vikas:#202:testing site contactus
	 */
	public function testForgotlogin()
	{
		Yii::app()->runController('site/forgotlogin');
		$this->assertXpathExists('//form/input[@name="email"]');
		//$this->assertOutputContains('Subscription Status: Inactive');
	}

}
