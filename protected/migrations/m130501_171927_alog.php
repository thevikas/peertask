<?php

class m130501_171927_alog extends CDbMigration
{
	public function up()
	{
	    $this->execute('CREATE TABLE IF NOT EXISTS `alog` (
                          `logtype` int(11) NOT NULL,
                          `dated` datetime NOT NULL,
                          `id_user` int(11) NOT NULL,
                          `params` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
                          `id_alog` int(11) NOT NULL AUTO_INCREMENT,
	                      `id_task` int(11) NOT NULL,
	            
                          PRIMARY KEY (`id_alog`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;');
	}

	public function down()
	{
		$this->execute('DROP TABLE alog');
	}
}