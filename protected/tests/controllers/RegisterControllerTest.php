<?php
/**
 * Test class for ParticipantController.
 * Generated by PHPUnit on 2012-06-29 at 13:09:10.
 * Test passed on 20121214
 */
class RegisterControllerTest extends UnitTestCase
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

	/**
	 * @group register
	 * to test that the form that comes on cases of differenr registration is as expected, full or basic
	 */
	public function testSiteRegisterForm()
	{
	    Yii::app()->runController('register');
		
		$this->assertXpathExists('//form//input[@name="Person[email]"]');
		$this->assertXpathExists('//form//input[@name="Person[first_name]"]');
		$this->assertXpathExists('//form//input[@name="Person[last_name]"]');
		$this->assertXpathExists('//form//input[@name="Person[dob]"]');
		$this->assertXpathExists('//form//input[@name="Person[gender]"]');
		//echo $this->getOutput();
	}

	public function dataregisterform1()
	{
		$ctr=0;
		$p['first_name'] = 'test 1';
		$p['last_name'] = 'last name1';
		$p['email'] = 'good@email.com';
		$p5['Person']  = $p0['Person'] = $p;
		$p5['Person']['dob'] = '1950-10-10';
		$p5['Person']['gender'] = '1';
		
		$p10['Person']  =  $p5['Person'];
		//email duplicate in person
		$p10['Person']['email'] = 'duplicate1@email.com';
		
		$p15['Person']  =  $p5['Person'];
		//email duplicate in user
		$p15['Person']['email'] = 'duplicate2@email.com';
		
		return array(
				//all these are using anonymous user, where the form will appear
				array(0,$p0,'//ul[li="Dob cannot be blank."]'),
			    array(5,$p5),
		        //duplicate email in person table
			    array(10,$p10,'//ul[li="The email address is already registered. Please login instead."]'),
		        //duplicate email in user table
		        array(15,$p15,'//ul[li="The email address is already registered. Please login instead."]'),
		);
	}

    /**
	 * @dataProvider dataregisterform1
	 * @group register
	 * to test that the form that comes on cases of differenr registration is as expected, full or basic
	 */
	public function testSiteRegisterPost($ctr,$p,$error = false)
	{	    
	    //if($ctr != 15) 
	    //    return;
	    $this->getFixtureManager()->load(array(
	            'Person',
	            'User',
	    ));
	     
	    $_POST = $p;
        Yii::app()->runController('register');

		if(!$error)
		    $this->assertOutputContains('Please check you mailbox for login password');
		else
		{
		    $this->assertXpathExists($error);
		}
	}

}