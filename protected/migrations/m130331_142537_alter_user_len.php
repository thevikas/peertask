<?php

class m130331_142537_alter_user_len extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `user` CHANGE  `username`  `username` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL");
	}

	public function down()
	{
		echo "m130331_142537_alter_user_len does not support migration down.\n";
		return false;
	}

}