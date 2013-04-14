<?php

class m130407_042449_new_frequency extends CDbMigration
{
	public function up()
	{
	    $this->execute("CREATE TABLE IF NOT EXISTS `frequency` (
                          `id_frequency` int(11) NOT NULL AUTO_INCREMENT,
                          `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                          `days_in_frequency` int(11) NOT NULL,
                          PRIMARY KEY (`id_frequency`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  ;");

	    $this->execute("INSERT INTO `frequency` (`id_frequency`, `name`, `days_in_frequency`) VALUES
                            (1, 'Daily', 1),
                            (2, 'Weekly', 7);");
	}

	public function down()
	{
		$this->execute("drop table frequency");
		
	}

}