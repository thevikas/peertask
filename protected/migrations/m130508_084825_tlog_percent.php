<?php

class m130508_084825_tlog_percent extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `tlog` ADD  `percent` TINYINT NOT NULL COMMENT  'percentage completed'");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `tlog` DROP `percent`");
	}

	}