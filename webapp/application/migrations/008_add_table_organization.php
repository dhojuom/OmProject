<?php 

class Migration_Add_table_organization extends CI_Migration
{


	public function up()
	{

	$organization =array(

			'id'=> array(
				'type'=>'int',
				'auto_increment'=>TRUE
				),
			'name'=>array(
				'type'=>'varchar',
				'constraint'=>200),

			'registration_number'=>array(
				'type'=>'varchar',
				'constraint'=>100),
			'location'=>array(
				'type'=>'varchar',
				'constraint'=>200
				),
			'phone_number'=>array(
				'type'=>'int',
				),
			'email'=>array(
				'type'=>'varchar',
				'constraint'=>200,
				),

			
			 );


	$this->dbforge->add_field($organization);
	$this->dbforge->add_key('id',TRUE);
	$this->dbforge->create_table('organization');
	
	}

	public function down()
	{
		$this->dbforge->drop_table('organization');
	}


}

?>