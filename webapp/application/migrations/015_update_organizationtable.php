<?php

class Migration_Update_OrganizationTable extends CI_Migration
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

		$this->dbforge->add_column('organization',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('organization','is_active');
		$this->dbforge->drop_column('organization','is_deleted');
	}
}