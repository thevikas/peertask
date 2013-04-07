<?php

class m121231_151248_create_person extends CDbMigration
{
	public function up()
	{
		$this->execute("CREATE TABLE  `person` (
<<<<<<< HEAD
				`id_person` int(11) unsigned NOT NULL AUTO_INCREMENT,
	 		        `created` datetime NOT NULL,
=======
				`id_person` int(11) NOT NULL AUTO_INCREMENT,					  
		        `created` datetime NOT NULL,
>>>>>>> 8b74c6c2828a7de235fe07ac604a9287df1b02b0
				`updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				`first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
				`last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
				`email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email address',
				`dob` date NOT NULL COMMENT 'date of birth',
				`gender` bit(1) NOT NULL COMMENT '0-female;1-male',
				`source` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
				PRIMARY KEY (`id_person`),
				UNIQUE KEY `email` (`email`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
	}

	public function down()
	{
		$this->execute("drop table person");
	}

	/*
	 // Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}