<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// application components
	'components'=>array(
		// uncomment the following to use a MySQL database
		'testdb'=>array(
			 'connectionString' => 'mysql:host=127.0.0.1;dbname=peertask_testing',
            'emulatePrepare' => true,
            'username' => '',
            'password' => '',
            'charset' => 'utf8',             
		    'class' => 'CDbConnection',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),
);