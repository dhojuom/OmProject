<?php

class Migration_Add_table_field_member extends CI_Migration 
{

	public function up()
	{
		$add = array(
			'is_active'=> array(

				'type'=> 'int',

								),
			'is_delete'=> array(

				'type'=>'int',		)

			);
		
		$this->dbforge->add_column('member', $add);


	}

	public function down()
	{

		$this->dbforge->drop_column('member','is_active');
		$this->dbforge->drop_column('member','is_delete');
	}
}