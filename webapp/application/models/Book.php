<?php
class Book extends BaseModel
{
	static $has_many= array(
        array(
        'organization_books',
        'class_name'=>'Organization_books',
        'foreign_key'=>'book_id',
            ),
        array(
            'member_books',
            'class_name'=>'Member_books',
            'foreign_key'=>'book_id',
            ),
        );

    
    static $table_name = 'books';
    static $primary_key = 'id';


    public function set_name($name)
    {
    	if ($name == '')
    	{
    		throw new NameBlankException("Name cannot be blank");
    	}

    	$this->assign_attribute('name',$name);
    }

    public function set_author($author)
    {
    	if ($author == '')
    	{
    		throw new AuthorBlankException("Input the Authors name ");
    		
    	}

    	$this->assign_attribute('author',$author);
    }

    public function set_edition($edition)
    {
    	$this->assign_attribute('edition',$edition);
    }


    public function get_name()
    {
    	return $this->read_attribute('name');
    }

    public function get_author()
    {
    	return $this->read_attribute('author');
    }

    public function get_edition()
    {
    	return $this->read_attribute('edition');
    }


    public static function create($data)
    {

    	$book = new Book();
    	$book->name = $data['name'];
    	$book->author = $data['author'];
    	$book->edition = $data['edition'];
    	$book->save();
    	return $book;
    
    }


}

?>