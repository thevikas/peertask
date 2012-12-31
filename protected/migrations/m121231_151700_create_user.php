<?php

class m121231_151700_create_user extends CDbMigration
{
	public function up()
	{
		$this->execute("
						CREATE TABLE IF NOT EXISTS `user` (
						  `id_user` int(11) NOT NULL AUTO_INCREMENT,
						  `id_person` int(11) NOT NULL,
						  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
						  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
						  `created` datetime NOT NULL,
						  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (`id_user`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1");
	}

	public function down()
	{
		$this->execute("drop table user");
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