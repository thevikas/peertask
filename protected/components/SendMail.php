<?php
/**
 * The class means to be the center of all email traffic that will be generated in the system.
 */
class SendMail
{
	

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

}