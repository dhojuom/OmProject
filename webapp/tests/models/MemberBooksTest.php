<?php
class Member_BooksTest extends CIUnit_TestCase
{
	protected $tables = array(
			'member_books'=>'member_books',
			'books'=>'books',
			'organization'=>'organization',
			'member'=>'member',	
			'organization_books'=>'organization_books'
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

	public function test_set_member()
	{
		$member_id = $this->member_fixt['2']['id'];
		$member = Member::find_by_id($member_id);

		$member_book = new Member_Books();
		$member_book->member = $member;
		$this->assertEquals($member_book->member_id,$member->id);
	}

	public function test_set_member_blank_exception()
	{
		$member_book = new Member_Books();
		$this->setExpectedException("InvalidInstanceException");
		$member_book->member = '';
	}

	public function test_set_member_invalid_instance_exception()
	{
		$organization_id = $this->organization_fixt['1']['id'];
		$organization = Organization::find_by_id($organization_id);
		$member_book = new Member_Books();
		$this->setExpectedException("InvalidInstanceException");
		$member_book->member = $organization;
	}

	public function test_set_invalid_member_exception()
	{
		$member_id = $this->member_fixt['4']['id'];
		$member = Member::find_by_id($member_id);

		$member_book= new Member_Books();
		$this->setExpectedException("InvalidModelException");
		$member_book->member = $member;
	}

	public function test_set_book()
	{
		$book_id = $this->books_fixt['1']['id'];
		$book = Book::find_by_id($book_id);

		$member_book = new Member_Books();
		$member_book->book = $book;

		$this->assertEquals($member_book->book_id,$book->id);
	}

	public function test_set_book_exception()
	{
		$member_id= $this->member_fixt['1']['id'];
		$member = Member::find_by_id($member_id);
		$member_book= new Member_Books();
		$this->setExpectedException("InvalidInstanceException");
		$member_book->book = $member;

	}

	public function test_set_book_blank_exception()
	{
		$member_book= new Member_Books();
		$this->setExpectedException("InvalidInstanceException");
		$member_book->book = '';
	}

	public function test_create()
	{
		$organization_books_id = $this->organization_books_fixt['1']['id'];
		$organization_books = Organization_Books::find_by_id($organization_books_id);
		$used_quantity= $organization_books->used_quantity;
		$available_quantity = $organization_books->available_quantity;
		$member_id = $this->member_fixt['2']['id'];
		$member = Member::find_by_id($member_id);
		$book_id = $this->books_fixt['1']['id'];
		$book = Book::find_by_id($book_id);

		$member_book = Member_Books::create(array(
							'member'=>$member,
							'book'=> $book,
							));

		$organization_books->reload();

		$this->assertEquals($member_book->member_id,$member->id);
		$this->assertEquals($member_book->book_id,$book->id);
		$this->assertEquals($organization_books->used_quantity,$used_quantity+1);
		$this->assertEquals($organization_books->available_quantity,$available_quantity-1);

	}

	public function test_create_no_books_in_organization_exception()
	{
		$member_id = $this->member_fixt['5']['id'];
		$member = Member::find_by_id($member_id);
		$book_id = $this->books_fixt['1']['id'];
		$book = Book::find_by_id($book_id);

		$this->setExpectedException("BooksUnavailableException");
		$member_book = Member_Books::create(array(
							'member'=> $member,
							'book'=> $book,
							));
	}

	public function test_create_books_unavailable_exception()
	{
		$member_id = $this->member_fixt['6']['id'];
		$member = Member::find_by_id($member_id);
		$book_id= $this->books_fixt['3']['id'];
		$book= Book::find_by_id($book_id);

		$this->setExpectedException("BooksUnavailableException");
		$member_book = Member_Books::create(array(
							'member'=> $member,
							'book'=> $book,
							));
	}

	public function test_create_exception()
	{
		$member_id = $this->member_fixt['1']['id'];
		$member = Member::find_by_id($member_id);
		$book_id= $this->books_fixt['2']['id'];
		$book= Book::find_by_id($book_id);

		$this->setExpectedException("Member_BooksAlreadyExistsException");
		$member_book = Member_Books::create(array(
							'member'=> $member,
							'book'=> $book,
							));
	}

}

?>