<?php

class Migration_Add_Column_Organization extends CI_Migration
{
	public function up()
	{
		$fields = array(
			'member_count'=>array(
				'type'=>'int',
				),
			'org_enrollment_count'=>array(
				'type'=>'int',
				
				)
			);

		$this->dbforge->add_column('organization',$fields);

	}

	public function down()
	{
		$this->dbforge->drop_column('organization','member_count');
		$this->dbforge->drop_column('organization','org_enrollment_count');
	}
}

?>