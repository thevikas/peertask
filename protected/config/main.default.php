<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
        'import'=>array(                                                #ok
                'application.models.*',
                'application.components.*',
                'application.extensions.yiimail.*',
                //'application.extensions.recaptcha.*',
                //'application.extensions.cleditor.*',
                //'application.extensions.CJuiDateTimePicker.*',
           		//'application.extensions.ECSVExport.*',
                //'application.components.linkedin.*',
                //'application.components.oauth.*',
        ),
        
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'kl19',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
	        'class' => 'WebUser',
    	),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'mail'=>array(
		        'class'=>'ext.yiimail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
		                'host'=>'smtp.gmail.com',
		                'username'=>'xyz',
		                // or email@googleappsdomain.com
		                'password'=>'xyz',
		                'port'=>'465',
		                'encryption'=>'ssl',
		        ),
		        'viewPath' => 'application.views.mail',
		        'logging' => true,
		        'dryRun' => false
		),
		
		
		// uncomment the following to use a MySQL database

		'db'=>array(                                                                                        #ok
			'connectionString' => 'mysql:host=127.0.0.1;dbname=peertask',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),  
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);