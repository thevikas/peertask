<?php

class m130414_134245_friend_status extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `friend` ADD  `status` 
	            ENUM(  'Pending',  'Accepted',  'Refused' ) NOT NULL DEFAULT 'Pending',
                ADD INDEX (  `status` )");
	    $this->execute("ALTER TABLE  `friend` CHANGE  `accepted_date`  `responded_date` TIMESTAMP NOT NULL DEFAULT  '0000-00-00 00:00:00'");
	}

	public function down()
	{
	    $this->execute("ALTER TABLE  `friend` CHANGE  `responded_date`  `accepted_date` TIMESTAMP NOT NULL DEFAULT  '0000-00-00 00:00:00'");
		$this->execute("ALTER TABLE  `friend` DROP  `status`");
	}
}