<?php
	class Migration_Add_Field_Member extends CI_Migration
	{

		public function up()
		{
			$member = array(

				'organization_id'=>array(

					'type'=>'int',

					),

				);

			$this->dbforge->add_column('member',$member);
		}

		public function down()
		{
			$this->dbforge->drop_column('member','organization_id');
		}
	}

?>