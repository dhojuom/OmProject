<?php 
class Migration_Add_Field_Organization extends CI_Migration
{
	public function up()
		{
			$member = array(

				'created_at'=>array(

					'type'=>'date',

					),
				'updated_at'=>array(
					'type'=>'date',
					)

				);

			$this->dbforge->add_column('organization',$member);
		}

		public function down()
		{
			$this->dbforge->drop_column('organization','created_at');
			$this->dbforge->drop_column('organization','updated_at');

		}

}

?>