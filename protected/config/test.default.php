<?php

return CMap::mergeArray(
        require(dirname(__FILE__).'/main.php'),
        array(
                 

                'preload'=>array('log','linkedin','TestLogger'),
                'params'=>array(
                        'runmode' => 'test',
                ),
                'components'=>array(
                        'fixture'=>array(
                                'class'=>'system.test.CDbFixtureManager',
                        ),
                        'db'=>array(
                                'connectionString' => 'mysql:host=127.0.0.1;dbname=peertask_testing',
                                'emulatePrepare' => true,
                                'username' => 'root',
                                'password' => '',
                                'charset' => 'utf8',
                        ),
                ),
        )
);
