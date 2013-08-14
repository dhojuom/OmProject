<?php

	class Migration_Add_Table_Organization_Enrollment extends CI_Migration
	{
		public function up()
		{
			$enrollment= array(
			'id'=>array(
				'type'=>'int',
				'auto_increment'=>TRUE
				),

			'organization_id'=>array(
				'type'=>'int',			
				),

			'course_id'=>array(
				'type'=>'int',
				),
			'is_active'=>array(
				'type'=>'boolean'
				),

			'is_deleted'=>array(
				'type'=>'boolean'
				),
			'created_at'=>array(
				'type'=>'datetime'
				),
			'updated_at'=>array(
				'type'=>'datetime'
				),
			);

			$this->dbforge->add_field($enrollment);
			$this->dbforge->add_key('id',TRUE);
			$this->dbforge->create_table('organization_enrollment');

		}

		public function down()
		{
			$this->dbforge->drop_table('organization_enrollment');
		}
	}

?>