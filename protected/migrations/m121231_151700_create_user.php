<?php

class m121231_151700_create_user extends CDbMigration
{
	public function up()
	{
		$this->execute("
						CREATE TABLE `user` (
						  `id_user` int(11) NOT NULL AUTO_INCREMENT,
						  `id_person` int(11) DEFAULT NULL,
						  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
						  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
						  `created` datetime NOT NULL,
						  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  PRIMARY KEY (`id_user`),
						  UNIQUE KEY `username` (`username`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
	}

	public function down()
	{
		$this->execute("drop table user");
	}

}