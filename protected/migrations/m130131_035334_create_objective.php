<?php

class m130131_035334_create_objective extends CDbMigration
{
	public function up()
	{    
	    $this->execute('CREATE TABLE  `objective` (
                      `id_objective` int(11) NOT NULL AUTO_INCREMENT,
                      `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                      PRIMARY KEY (`id_objective`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;');
	}

	public function down()
	{
		$this->execute('drop table objective');
	}

}