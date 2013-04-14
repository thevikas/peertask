<?php

class m130414_113634_task_user extends CDbMigration
{
	public function up()
	{
	    $this->execute("CREATE TABLE IF NOT EXISTS `task_user` (
                          `id_taskuser` int(11) NOT NULL AUTO_INCREMENT,
                          `id_task` int(11) NOT NULL,
                          `id_user` int(11) NOT NULL,
                          `dated` datetime NOT NULL,
                          `rel` tinyint(4) NOT NULL,
                          `status` tinyint(4) NOT NULL COMMENT 'status, 1=active, 0=pending',
                          `id_from_user` int(11) NOT NULL COMMENT 'which user can ',
                          PRIMARY KEY (`id_taskuser`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;");
	}

	public function down()
	{
		$this->execute('drop table task_user');
	}
}