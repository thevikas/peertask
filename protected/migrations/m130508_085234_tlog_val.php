<?php

class m130508_085234_tlog_val extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `tlog` ADD  `val` DOUBLE NOT NULL COMMENT  'value of progress'");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `tlog` DROP  `val` DOUBLE NOT NULL COMMENT  'value of progress'");
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