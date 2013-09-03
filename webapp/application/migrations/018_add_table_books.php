<?php 
class Migration_Add_Table_Books extends CI_Migration
{

public function up()
	{
		$books = array(
			'id'=> array(
				'type'=>'int',
				'auto_increment'=>TRUE
				),

			'name'=> array(

				'type'=> 'varchar',
				'constraint'=>100


				),
			'author'=> array(

				'type'=> 'varchar',
				'constraint'=>100
				),			

			'Edition'=> array(
				'type'=>'varchar',
				'constraint'=>100
				
				),

			
					
				);
		

		$this->dbforge->add_field($books);
		$this->dbforge->add_key('id',TRUE);
		$this->dbforge->create_table('books');





	}


	public function down()
	
	{
		$this->dbforge->drop_table('books');
	}

}
?>