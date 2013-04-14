<?php

class m130131_035100_create_task extends CDbMigration
{
	public function up()
	{    
	    $this->execute('CREATE TABLE  `task` (
                          `id_task` int(11) NOT NULL AUTO_INCREMENT,
                          `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                          `id_objective` int(11) DEFAULT NULL,
                          PRIMARY KEY (`id_task`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;');
	}

	public function down()
	{
		$this->execute('drop table task');
	}

}