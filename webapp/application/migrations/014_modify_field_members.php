<?php

	class Migration_Modify_field_members extends CI_Migration
	{

		public function up()
		{
			$modify= array('is_delete'=> array('name'=>'is_deleted','type'=>'boolean') );

			$this->dbforge->modify_column('member', $modify);

		}

		public function down()
		{
			$modify= array(
							'is_deleted'=> array('name'=>'is_delete', 'type'=>'int'), 
							 
							);

			$this->dbforge->modify_column('member', $modify);

		}
	}

?>