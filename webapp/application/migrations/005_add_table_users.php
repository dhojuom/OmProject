<?php 

class Migration_Add_table_users extends CI_Migration
{


	public function up()
	{

	$users=array(

			'id'=> array(
				'type'=>'int',
				'auto_increment'=>TRUE
				),
			'user_name'=>array(
				'type'=>'varchar',
				'constraint'=>100),

			'password'=>array(
				'type'=>'varchar',
				'constraint'=>100),
			
			 );

	$this->dbforge->add_field($users);
	$this->dbforge->add_key('id',TRUE);
	$this->dbforge->create_table('users');
	
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}


}

?>