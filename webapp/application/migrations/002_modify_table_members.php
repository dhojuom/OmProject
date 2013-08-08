<?php

class Migration_Modify_table_members extends CI_Migration 
{

	public function up()
	{
		$fields = array(

			'created_on'=> array(

				'type'=>'date',
				
				),

			'updated_on'=> array(

				'type'=>'date',
				)

			);

		$this->dbforge->drop_column('members','user_name');
		$this->dbforge->drop_column('members','password');
		$this->dbforge->add_column('members', $fields);



	}


	public function down()
	{
		
		$deleted = array('user_name'=> array(

				'type'=> 'varchar',
				'constraint'=>250
				),

			'password'=> array(

				'type'=> 'varchar',
				'constraint'=>250)

			);


		$this->dbforge->drop_column('members', 'created_on');
		$this->dbforge->drop_column('members', 'updated_on');
		$this->dbforge->add_column('members',$deleted);
		
		


	}

}

?>