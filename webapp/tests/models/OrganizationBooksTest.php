<?php

class Organization_BooksTest extends CIUnit_TestCase
{
	protected $tables = array(
			'organization_books'=>'organization_books',
			'books'=>'books',
			'organization'=>'organization',
			'member'=>'member',	
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


	public function test_set_organization()
	{
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);

		$organization_books = new Organization_Books();
		$organization_books->organization = $organization;

		$this->assertEquals($organization_books->organization_id,$organization->id);
	}

	public function test_set_invalid_organization_Exception()
	{
		$organization_id = $this->organization_fixt['1']['id'];
		$organization = Organization::find_by_id($organization_id);
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidModelException");
		$organization_books->organization = $organization;
	}

	public function test_set_organization_invalidinstance_Exception()
	{
		$member_id = $this->member_fixt['2']['id'];
		$member = Member::find_by_id($member_id);
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidInstanceException");
		$organization_books->organization = $member;
	}

	public function test_set_organization_blank_Exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidInstanceException");
		$organization_books->organization= '';
	}

	

	public function test_set_book()
	{
		$book_id = $this->books_fixt['1']['id'];
		$book = Book::find_by_id($book_id);

		$organization_books = new Organization_Books();
		$organization_books->book = $book;

		$this->assertEquals($organization_books->book_id,$book->id);

	}

	public function test_set_book_exception()
	{
		$member_id= $this->member_fixt['1']['id'];
		$member = Member::find_by_id($member_id);
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidInstanceException");
		$organization_books->book = $member;

	}

	public function test_set_book_blank_exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidInstanceException");
		$organization_books->book = '';

	}

	public function test_set_quantity()
	{
		$organization_books = new Organization_Books();
		$organization_books->quantity = 20;
		$this->assertEquals($organization_books->quantity,20);
	}

	public function test_set_quantity_zero_exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidQuantityException");
		$organization_books->quantity = 0 ;
	}

	public function test_set_quantity_negative_exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidQuantityException");
		$organization_books->quantity = -1 ;
	}

	public function test_set_lessthan_used_quantity()
	{
		$organization_books = new Organization_Books();
		$organization_books->quantity = 20;
		$organization_books->used_quantity = 10;
		$this->setExpectedException("InvalidQuantityException");
		$organization_books->quantity = 5;
	}

	public function test_set_used_quantity_exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidQuantityException");
		$organization_books->used_quantity = 10;	
	}

	public function test_set_available_quantity_exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidQuantityException");
		$organization_books->available_quantity = 10;	

	}

	public function test_set_quantity_floatvalue_exception()
	{
		$organization_books = new Organization_Books();
		$this->setExpectedException("InvalidQuantityException");
		$organization_books->quantity = 0.5 ;
	}

	public function test_create()
	{

		$organization_id = $this->organization_fixt['4']['id'];
		$organization = Organization::find_by_id($organization_id);
		$book_id = $this->books_fixt['1']['id'];
		$book = Book::find_by_id($book_id);

		$organization_book = Organization_Books::create(array(
		 			'organization'=>$organization,
		 			'book'=>$book,
		 			'quantity'=>20,
		 			));

		$this->assertEquals($organization_book->organization_id,$organization->id);
		$this->assertEquals($organization_book->book_id,$book->id);
		$this->assertEquals($organization_book->quantity,20);
		$this->assertEquals($organization_book->used_quantity,0);
		$this->assertEquals($organization_book->available_quantity,20);

	}

	public function test_create_exception()
	{

		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$book_id = $this->books_fixt['1']['id'];
		$book = Book::find_by_id($book_id);
		$this->setExpectedException("Organization_BooksAlreadyExistsException");
		$organization_book = Organization_Books::create(array(
		 			'organization'=>$organization,
		 			'book'=>$book,
		 			'quantity'=>10,
		 			'used_quantity'=>0,
		 			'available_quantity'=>10,
		 			));

	}

	public function test_book_issued_to_member()
	{
		$organization_book_id = $this->organization_books_fixt['1']['id'];
		$organization_book = Organization_Books::find_by_id($organization_book_id);
		$quantity = $organization_book->quantity;
		$used_quantity = $organization_book->used_quantity;
		$available_quantity = $organization_book->available_quantity;

		$organization_book->issue_book_to_member();

		$this->assertEquals($organization_book->used_quantity,$used_quantity+1);
		$this->assertEquals($organization_book->available_quantity,$available_quantity-1);

	}

	public function test_book_issued_to_member_belowzero_exception()
	{
		$organization_book_id = $this->organization_books_fixt['2']['id'];
		$organization_book = Organization_Books::find_by_id($organization_book_id);
		$this->setExpectedException("BooksUnavailableException");
		$organization_book->issue_book_to_member();

	}

	public function test_book_returned_by_member()
	{
		$organization_book_id = $this->organization_books_fixt['1']['id'];
		$organization_book = Organization_Books::find_by_id($organization_book_id);
		$quantity = $organization_book->quantity;
		$used_quantity = $organization_book->used_quantity;
		$available_quantity = $organization_book->available_quantity;

		$organization_book->return_book_by_member();

		$this->assertEquals($organization_book->used_quantity,$used_quantity-1);
		$this->assertEquals($organization_book->available_quantity,$available_quantity+1);

	}

	public function test_book_returned_by_member_exception()
	{
		$organization_book_id = $this->organization_books_fixt['3']['id'];
		$organization_book = Organization_Books::find_by_id($organization_book_id);
		$this->setExpectedException("BooksUnavailableException");
		$organization_book->return_book_by_member();

	}







}

?>