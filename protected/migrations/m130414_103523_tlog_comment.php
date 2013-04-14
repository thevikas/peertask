<?php

class m130414_103523_tlog_comment extends CDbMigration
{
	public function up()
	{
	    $this->execute('ALTER TABLE  `tlog` ADD  `comment` VARCHAR( 255 ) NOT NULL');
	}

	public function down()
	{
		$this->execute('ALTER TABLE  `tlog` DROP  `comment` VARCHAR( 255 ) NOT NULL');
	}

}