<?php

class Migration_Update_Course_Table extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'is_active'=>array(
				'type'=>'boolean',
				),
			'is_deleted'=>array(
				'type'=>'boolean',
				
				)
			);

		$this->dbforge->add_column('course',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('course','is_active');
		$this->dbforge->drop_column('course','is_deleted');
	}
}

?>