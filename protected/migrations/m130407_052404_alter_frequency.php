<?php

class m130407_052404_alter_frequency extends CDbMigration
{
	public function up()
	{
	    $this->execute("ALTER TABLE  `frequency` 
	                ADD  `repeated` BOOLEAN NOT NULL AFTER  `days_in_frequency` ,
                    ADD  `phpstrtotime` VARCHAR( 15 ) NOT NULL AFTER  `repeated`");
	    
	    $this->execute("INSERT INTO  `peertask`.`frequency` (
                        `id_frequency` ,
                        `name` ,
                        `days_in_frequency` ,
                        `repeated` ,
                        `phpstrtotime`
                        )
                        VALUES (
                        NULL ,  'One time',  '0',  '0',  ''
                        );");
	}

	public function down()
	{
		$this->execute*("ALTER TABLE  `frequency` 
	                DROP  `repeated`,
                    DROP  `phpstrtotime`");
	}

}