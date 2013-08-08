<?php

class Migration_Add_table_members extends CI_Migration 
{

	public function up()
	{
		$parents= array(
			'id'=> array(
				'type'=>'int',
				'constraint'=>3,
				'auto_increment'=>TRUE
				),

			'first_name'=> array(

				'type'=> 'varchar',
				'constraint'=>250


				),
			'last_name'=> array(

				'type'=> 'varchar',
				'constraint'=>20
				),			

			'address'=> array(
				'type'=>'varchar',
				'constraint'=>100
				
				),

			'email'=> array(
				'type'=>'varchar',
				'constraint'=>50
				
				),

			'phone_no'=> array(
				'type'=>'varchar',
				'constraint'=>50,
				
				),
					
			'user_name'=> array(
				'type'=> 'varchar',
				'constraint'=>250
				),

			'password'=> array(

				'type'=> 'varchar',
				'constraint'=>250
				)
					
				);
		

		$this->dbforge->add_field($parents);
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('members');





	}


	public function down()
	
	{
		$this->dbforge->drop_table('members');
	}

}

?>