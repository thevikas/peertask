<?php
class m130520_143706_person_score extends CDbMigration
{
	public function up()
	{
	    $this->execute('ALTER TABLE  `person` ADD  `score` SMALLINT NOT NULL');
	}

	public function down()
	{
		$this->execute('ALTER TABLE  `person` DROP `score` SMALLINT NOT NULL');
	}
}
