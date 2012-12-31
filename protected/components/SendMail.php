<?php
/**
 * The class means to be the center of all email traffic that will be generated in the system.
 */
class SendMail
{
	/**
	 * Sends email to admins about new store subscriber
	 * This is admins only.
	 * @param integer $id
	 *
	 * @return void
	 */
	public function afterSubscriber(Subscription $model)
	{
		if(Yii::app()->params['runmode'] == 'test')
			return;

                # removed admin rejection since this email is for admins only.

		$message = new YiiMailMessage();
		$message->view = 'new-subscriber';

		//userModel is passed to the view
		$message->setBody(array('model'=>$model), 'text/html');


		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Subscription Registration';
		#201206061620:vikas:#13:added conditional second mailbox
		$message->addTo(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addTo($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}

	/**
	 * Sends email to admins about new newsletter subscriber
	 * This is admins only.
	 * @param integer $id
	 *
	 * @return void
	 */
	public function afterNewsreader($id)
	{
		if(Yii::app()->params['runmode'] == 'test')
			return;

		# can't reject emails if admin logs since this email is for admins only.

		$message = new YiiMailMessage();
		$message->view = 'new-newsreader';


		$model = Participant::model()->findByPk($id);

		//userModel is passed to the view
		$message->setBody(array('model'=>$model), 'text/html');


		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Newsletter Subscriber Registration';
		#201206061620:vikas:#13:added conditional second mailbox
		$message->addTo(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addTo($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}

	/**
	 * Sends email to admins about new participant registration
	 *
	 * @param integer $id
	 * This is admins only
         *
	 * @return void
	 */
	public function afterRegister($id)
	{
		if(Yii::app()->params['runmode'] == 'test')
			return;

		#no rejections for admin only emails

                $message = new YiiMailMessage();
		$message->view = 'new-participant';


		$model = Participant::model()->findByPk($id);

		//userModel is passed to the view
		$message->setBody(array('model'=>$model), 'text/html');


		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Delegate Registration';
		#201206061620:vikas:#13:added conditional second mailbox
		$message->addTo(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addTo($pp['adminEmail2']);
		}

		if(isset($pp['adminEventEmails']))
		{
			foreach($pp['adminEventEmails'] as $email1)
        		$message->addTo($email1);
		}

		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}

	/**
	 * Sends email to verify email address
	 *
	 * @param Person $person Person Record
	 *
	 * @return void
	 */
	public function verifyEmail(Person $person)
	{
		$message = new YiiMailMessage();
		$message->view = 'verifyemail';

		//userModel is passed to the view
		$message->setBody(array('model'=>$person), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Inside Investor email confirmation';

		$message->addTo($person->email);
		$message->addBcc(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addBcc($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Yii::app()->mail->send($message);
	}

	/**
	 * Sends new user his login password
	 *
	 * @param Person $person Person record
	 *
	 * @return void
	 */
	public function toUser(Person $person)
	{

		if(!Yii::app()->user->getIsGuest())
			return;

                $adminactive = Yii::app()->user->getId() == 1;
                if($adminactive)
                        return;

                $message =Controller::$dic->create('YiiMailMessage');

		$message->view = 'newusermail';

		//userModel is passed to the view
		$message->setBody(array('model'=>$person), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Welcome to Inside Investor';
		#201206061620:vikas:#13:added conditional second mailbox

		$message->addTo($person->email);
		$message->addBcc(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addBcc($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}

	/**
	 * Sends welcome email to new store subscriber
	 *
	 * @param Person $person Person record
	 *
	 * @return void
	 */
	public function welcomeSubscriber(Person $person,$force=false,$sub=false)
	{

		if(!Yii::app()->user->getIsGuest())
			return;

               $adminactive = Yii::app()->user->getId() == 1;
	       if($adminactive)
                        return;

		$message =Controller::$dic->create('YiiMailMessage');

		$message->view = 'welcome-subscriber';

		//userModel is passed to the view
		$message->setBody(array('model'=>$person,'sub' => $sub), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Welcome Subscriber';
		#201206061620:vikas:#13:added conditional second mailbox

		$message->addTo($person->email);
		$message->addBcc(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addBcc($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}

	/**
	 * Sends welcome info to new event delegate
	 *
	 * @param Person Person info
	 *
	 * @return void
	 */
	public function welcomeDelegate(Participant $participant)
	{

		$person = $participant->person;
		$event = $participant->event;

		if(!Yii::app()->user->getIsGuest())
			return;

               $adminactive = Yii::app()->user->getId() == 1;
	       if($adminactive)
                        return;

		$message =Controller::$dic->create('YiiMailMessage');

		$message->view = 'welcome-delegate';

		//userModel is passed to the view
		$message->setBody(array('person'=>$person,'event' => $event,'participant' => $participant), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Welcome Delegate';
		#201206061620:vikas:#13:added conditional second mailbox

		$message->addTo($person->email);
		$message->addBcc(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addBcc($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}

	/**
	 * Send welcome email to the new newsletter subscriber
	 *
	 * @param Person $person Person record
	 *
	 * @return void
	 */
	public function welcomeNewsreader(Person $person)
	{

		if(!Yii::app()->user->getIsGuest())
			return;

               $adminactive = Yii::app()->user->getId() == 1;
               if($adminactive)
                        return;

		$message =Controller::$dic->create('YiiMailMessage');

		$message->view = 'welcome-newsreader';

		//userModel is passed to the view
		$message->setBody(array('model'=>$person), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Welcome News reader';
		#201206061620:vikas:#13:added conditional second mailbox

		$message->addTo($person->email);
		$message->addBcc(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addBcc($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}
	
	public function sendMailUsingViewfile(Person $person,$subject,$viewfile)
	{
	
		if(!Yii::app()->user->getIsGuest())
			return;
	
		$adminactive = Yii::app()->user->getId() == 1;
		if($adminactive)
			return;
	
		$message =Controller::$dic->create('YiiMailMessage');
	
		$message->view = $viewfile;
	
		//userModel is passed to the view
		$message->setBody(array('person'=>$person), 'text/html');
	
		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = $subject;
		#201206061620:vikas:#13:added conditional second mailbox
	
		$message->addTo($person->email);
		$message->addBcc(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addBcc($pp['adminEmail2']);
		}
	
		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}

	/**
         * This email is sent to admins only.
	 * @totest
	 * @param Payment $pay
	 */
	function afterEventPayment(Payment $pay)
	{
		$person = $pay->person;
		$message =Controller::$dic->create('YiiMailMessage');

		$message->view = 'after-event-payment';

		//userModel is passed to the view
		$message->setBody(array('model'=>$person,'pay' => $pay), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'Event Payment Received';
		#201206061620:vikas:#13:added conditional second mailbox

		$message->addTo(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addTo($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}

	/**
         * admins only email.
	 * @totest
	 * @param Payment $pay
	 */
	function afterPaylink(Payment $pay)
	{
		$person = $pay->person;
		$message =Controller::$dic->create('YiiMailMessage');

		$message->view = 'after-making-paylink';

		//userModel is passed to the view
		$message->setBody(array('model'=>$person,'pay' => $pay), 'text/html');

		$pp = Yii::app()->params;

		$message->subject = 'Event Payment Link is Ready';
		#201206061620:vikas:#13:added conditional second mailbox

		$message->addTo(Yii::app()->params['adminEmail']);
		if(isset($pp['adminEmail2']))
		{
			$message->addTo($pp['adminEmail2']);
		}

		$message->from = Yii::app()->params['senderEmail'];
		Controller::$dic->get('yiiMail')->send($message);
	}

	function eventMail($emails,$template,$subject)
	{
		$ctr = 1;
		$ctrall = count($emails);
		foreach($emails as $email => $info)
		{
			//201210311329:vikas:#added info array instead of just name
			$name = $info['fullname'];
			set_time_limit(300);
			Yii::log("sending $ctr/$ctrall email to " . $to1);
			$person = $pay->person;
			$message = new YiiMailMessage();// Controller::$dic->create('YiiMailMessage');

			//201210311329:vikas:#added template from params
			$message->view = $template;

			$fullname = $name;
			//userModel is passed to the view
			//201210311329:vikas:#added info from caller itself
			$message->setBody($info, 'text/html');

			$pp = Yii::app()->params;
			//$message->addTo('miguel@investvine.com');
			//201210311329:vikas:#added subject from params
			$message->subject = $subject;
			#201206061620:vikas:#13:added conditional second mailbox

			/*$fpath = realpath( dirname(__FILE__) . "/../views/mail/" . 'Event-brochure-IIAF-2012.pdf');
			$message->attach(Swift_Attachment::fromPath($fpath));*/

			$message->addTo($to1 = $email);

			$message->from = Yii::app()->params['senderEmail'];
			sleep(5);
			$log = new Log();
			$log->logtype = 7;
			$log->params = "mailing ($template) $to1 $ctr/$ctrall ";
			$log->save();


			Controller::$dic->get('yiiMail')->send($message);
			$ctr++;
		}

		$log = new Log();
		$log->logtype = 8;
		$log->params = "all mailing ($template) complete";
		$log->save();

		Yii::log("sending completed for $ctr/$ctrall emails");
	}

	/**
	 * Send the details of the form to site admin when one uses contact us form
	 * Admins only.
	 * @param Contact $model Contact details
	 *
	 * @return void
	 */
	public function afterContact($model)
	{
	    $message = new YiiMailMessage();
	    $message->view = 'contactus';


	    //userModel is passed to the view
	    $message->setBody(array('model'=>$model), 'text/html');


	    $pp = Yii::app()->params;
	    //$message->addTo('miguel@investvine.com');
	    $message->subject = 'InsideInvestor Contacted';
	    #201206061620:vikas:#13:added conditional second mailbox
	    $message->addTo(Yii::app()->params['contactEmail']);
	    if(isset($pp['contactEmail2']))
	    {
	        $message->addTo($pp['contactEmail2']);
	    }

	    $message->from = Yii::app()->params['adminEmail'];
	    Yii::app()->mail->send($message);
	}

	/**
	 * Send the details of the form to site admin when one uses contact us form
	 * send to admins only.
         *
	 * @param Contact $model Contact details
	 *
	 * @return void
	 */
	public function afterJobApply($model)
	{
		$message = new YiiMailMessage();
		$message->view = 'jobapply';


		//userModel is passed to the view
		$message->setBody(array('model'=>$model), 'text/html');

		$pp = Yii::app()->params;
		//$message->addTo('miguel@investvine.com');
		$message->subject = 'InsideInvestor Job Application';
		#201206061620:vikas:#13:added conditional second mailbox
		$message->addTo(Yii::app()->params['contactEmail']);
		if(isset($pp['contactEmail2']))
		{
			$message->addTo($pp['contactEmail2']);
		}

		$fpath = $model->filepath;

		if(strlen($fpath)>5)
			$message->attach(Swift_Attachment::fromPath($fpath));

		$message->from = Yii::app()->params['adminEmail'];
		Yii::app()->mail->send($message);
	}

	/**
	 * Sends welcome info to new event delegate
	 *
	 * @param Person Person info
	 *
	 * @return void
	 */
	public function welcomeMagazineReader(Person $person)
	{

	    if(!Yii::app()->user->getIsGuest())
	        return;

	    $adminactive = Yii::app()->user->getId() == 1;
	    if($adminactive)
	        return;

	    $message =Controller::$dic->create('YiiMailMessage');

	    $message->view = 'welcome-magazine-reader';

	    //userModel is passed to the view
	    $message->setBody(array('model'=>$person), 'text/html');

	    $pp = Yii::app()->params;
	    //$message->addTo('miguel@investvine.com');
	    $message->subject = 'The New Inside Investor Magazine';
	    #201206061620:vikas:#13:added conditional second mailbox

	    $message->addTo($person->email);
	    $message->addBcc(Yii::app()->params['adminEmail']);
	    if(isset($pp['adminEmail2']))
	    {
	        $message->addBcc($pp['adminEmail2']);
	    }

	    $message->from = Yii::app()->params['senderEmail'];
	    Controller::$dic->get('yiiMail')->send($message);
	}
}