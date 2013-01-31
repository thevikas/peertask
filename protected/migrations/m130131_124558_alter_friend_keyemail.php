<?php
class m130131_124558_alter_friend_keyemail extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `friend` ADD  `person2email` VARCHAR( 255 ) NOT NULL,
	                                          ADD  `person2key` CHAR( 15 ) NOT NULL, 
	                                          ADD  `requested_date` TIMESTAMP NOT NULL ,
                                              ADD  `accepted_date` TIMESTAMP NOT NULL;");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `friend` DROP  `person2email`,DROP  `person2key`, DROP requested_date, DROP accepted_date;");
	}
}