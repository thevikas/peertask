<?php

class m130427_175446_taskuser_status extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `task_user` CHANGE  `status`  `status` ENUM(  'Active',  'Pending',  'Rejected' ) NOT NULL COMMENT  'status'");
	    $this->execute("update task_user set status='Active' where id_user=2;");
	    $this->execute("update task_user set status='Pending' where id_user=3;");
	}

	public function down()
	{
		$this->execute("ALTER TABLE  `task_user` CHANGE  `status`  `status` tinyint(4) NOT NULL COMMENT 'status, 1=active, 0=pending'");
	}
}