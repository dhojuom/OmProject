<?php
class Organization_Books extends BaseModel
{
	static $table_name = 'organization_books';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'organization',
            'class_name'=>'Organization',
            'foreign_key'=>'organization_id'),
        array(
            'book',
            'class_name'=>'Book',
            'foreign_key'=>'book_id'),
    );


    public function set_organization($organization)
    {
    	if (!$organization instanceof Organization) 
        {
            throw new InvalidInstanceException("invalid organization type");
        }

        $organization->check_is_valid();

        $this->assign_attribute ('organization_id',$organization->id);
    }

    public function set_book($book)
    {
    	if (!$book instanceof Book) 
        {
            throw new InvalidInstanceException("invalid book type");
        }

        $this->assign_attribute ('book_id',$book->id);
    }

    public function set_quantity($quantity)
    {
        if ($quantity === '' || $quantity<= 0 || is_float($quantity)|| $quantity < $this->used_quantity)
        {
            throw new InvalidQuantityException("Invalid Quantity Given");    
        }

        $this->assign_attribute('quantity',$quantity);

    }

    public function set_used_quantity($quantity)
    {

       if ($quantity<0 || $quantity==='' || is_float($quantity)|| $quantity > $this->quantity)
       {
            throw new InvalidQuantityException("Invalid Quantity Given");         
       }
       
       $this->assign_attribute('used_quantity',$quantity);
    }

    public function set_available_quantity($quantity)
    {
        if ($quantity=='' || $quantity<0 || is_float($quantity))
       {
            throw new InvalidQuantityException("Invalid Quantity Given");         
       }
       
       $this->assign_attribute('available_quantity',$quantity);
    }

    public function issue_book_to_member()
    {
        if ($this->available_quantity == 0)
        {
          throw new BooksUnavailableException("Invalid Quantity Given");  
        }

        $this->used_quantity += 1;
        $this->available_quantity -= 1;
        $this->save();
    }

    public function return_book_by_member()
    {
        if($this->used_quantity==0)
        {
           throw new BooksUnavailableException("invalid transaction");
        }

        $this->used_quantity -=1 ;
        $this->available_quantity +=1;
        $this->save();
    }

    public static function create($data)
    {
        $organization_book = new Organization_Books();
        $organization_book->organization = $data['organization'];
        $organization_book->book = $data['book'];
        if(!self::get($data))
        {

            throw new Organization_BooksAlreadyExistsException("Organization_Books Already Exists");
            
        }
        $organization_book->quantity = $data['quantity'];
        $organization_book->used_quantity=0;
        $organization_book->available_quantity= $data['quantity'];
        $organization_book->save();
        return $organization_book;
    }

    public static function  get($data)
    {
        $organization_id= $data['organization']->id;
        $book_id= $data['book']->id;
        $result= self::find_by_organization_id_and_book_id($organization_id,$book_id);
        
        if($result)
        {     
            return false;
        }

        return true;    
    }

}
?>