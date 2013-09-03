<?php 
class BookTest extends CIUnit_Testcase
{
	protected $tables = array(

			'books'=>'books',
			'organization_books'=>'organization_books',
			'member_books'=>'member_books',
			
	);

	public function __construct($name = NULL, array $data = array(), $dataName = '') 
	{
		parent::__construct($name, $data, $dataName);
	}
	
	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function test_set_name_Exception()
	{
		$book = new Book();
		$this->setExpectedException('NameBlankException');
		$book->name = '';

	}

	public function test_set_name()
	{
		$book = new Book();
		$book->name= 'Codeigniter';
		$this->assertEquals($book->name,'Codeigniter');
	}

	public function test_set_author_Exception()
	{
		$book = new Book();
		$this->setExpectedException('AuthorBlankException');
		$book->author = '';
	}

	public function test_set_author()
	{
		$book = new Book();
		$book->author = 'Om';
		$this->assertEquals($book->author,'Om');
	}

	public function test_set_Edition()
	{
		$book = new Book();
		$book->edition = 'second';
		$this->assertEquals($book->edition,'second');
	}

	public function test_create()
	{
		$book = Book::create(array(
		 			'name'=> 'Media',
		 			'author'=>'Om',
		 			'edition'=>'second',	 		
		 			)
				);

		$this->assertEquals($book->name,'Media');
		$this->assertEquals($book->author,'Om');
		$this->assertEquals($book->edition,'second');
	}


}

?>