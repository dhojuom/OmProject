<?php

class Migration_Add_field_users extends CI_Migration
{

	public function up()
	{
		$field = array(
			'member_id'=> array(

				'type'=> 'int',
					   )
		
			);
		
		$this->dbforge->add_column('users', $field);


	}

	public function down()
	{

		$this->dbforge->drop_column('users','member_id');
		
	}
}