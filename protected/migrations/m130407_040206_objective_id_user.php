<?php

class m130407_040206_objective_id_user extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `objective` ADD  `id_user` INT NOT NULL AFTER  `id_objective`");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `objective` DROP  `id_user`");
	}

}