<?php

	class Migration_Modifyfields_members extends CI_Migration
	{

		public function up()
		{
			$modify= array(
							'created_on'=> array('name'=>'created_at','type'=>'date'),
							'updated_on'=>array('name'=>'updated_at','type'=>'date') 
							);

			$this->dbforge->modify_column('member', $modify);

		}

		public function down()
		{
			$modify= array(
							'created_at'=> array('name'=>'created_on', 'type'=>'date'), 
							'updated_at'=>array('name'=>'updated_on','type'=>'date') 
							);

			$this->dbforge->modify_column('member', $modify);

		}
	}

?>