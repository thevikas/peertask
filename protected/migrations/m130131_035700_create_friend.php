<?php

class m130131_035700_create_friend extends CDbMigration
{
	public function up()
	{    
	    $this->execute('CREATE TABLE IF NOT EXISTS `friend` (
                          `id_friend` int(11) NOT NULL AUTO_INCREMENT,
                          `id_person1` int(11) NOT NULL,
                          `id_person2` int(11) NOT NULL,
                          PRIMARY KEY (`id_friend`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;');
	}

	public function down()
	{
		$this->execute('drop table friend');
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