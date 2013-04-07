<?php

class m130407_050554_create_tlog extends CDbMigration
{
	public function up()
	{
	    $this->execute("CREATE TABLE IF NOT EXISTS `tlog` (
                          `id_tlog` int(11) NOT NULL AUTO_INCREMENT,
                          `id_task` int(11) NOT NULL,
                          `id_objective` int(11) NOT NULL,
                          `dated` datetime NOT NULL,
                          `id_user` int(11) NOT NULL,
                          PRIMARY KEY (`id_tlog`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	}

	public function down()
	{
		$this->execute("drop table tlog");
	}

}