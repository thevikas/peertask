<?php

class m130407_042800_alter_objective_frequency extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `objective` ADD  `id_frequency` INT NOT NULL AFTER  `id_user`");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `objective` DROP  `id_frequency`");
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