<?php

class m130414_140522_task_user_data_migrate extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `task_user` CHANGE  `rel`  `rel` ENUM(  'Owner',  'SharedOwner',  'Sent' ) NOT NULL");
	    $this->execute("truncate table task_user");
	    $this->execute("insert into task_user(id_user,id_task,dated,rel,id_from_user)
                        SELECT id_user,id_task,now() as `dated`,'Owner' as `rel`,id_user as `id_from_user` FROM `task` t
	                        join objective o on o.id_objective = t.id_objective");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `task_user` CHANGE  `rel`  `rel` ENUM(  'Owner',  'SharedOwner',  'Sent' ) NOT NULL");
		$this->execute("truncate table task_user");
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