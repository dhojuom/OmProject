<?php

class Migration_Add_Table_Course extends CI_Migration
{

	public function up()
	{
		$course= array(
			'id'=> array(
				'type'=>'int',
				'auto_increment'=>TRUE
				),
			'name'=> array(
				'type'=>'varchar',
				'constraint'=>200,
				),
			'course_code'=>array(
				'type'=>'varchar',
				'constraint'=>50,
				),
			'category'=>array(
				'type'=>'varchar',
				'constraint'=>100,
				),
			'duration_hours'=>array(
				'type'=>'int'

				),

			'created_at'=>array(
				'type'=>'datetime',

				),
			'updated_at'=>array(
				'type'=>'datetime',
				),

			);

		

		$this->dbforge->add_field($course);
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('course');	

		
		


			
	}

	public function down()
	{

		$this->dbforge->drop_table('course');
		
	}

}

?>