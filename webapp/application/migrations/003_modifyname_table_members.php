<?php

class Migration_Modifyname_table_members extends CI_Migration 
{

	public function up()
	{

		$this->dbforge->rename_table('members', 'member');

	}

	public function down()
	{

		$this->dbforge->rename_table('member', 'members');

	}

}