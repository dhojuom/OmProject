<?php
class Member_Books extends BaseModel
{
    static $table_name = 'member_books';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'member',
            'class_name'=>'Member',
            'foreign_key'=>'member_id'),
        array(
            'organization_book',
            'class_name'=>'Organization_Books',
            'foreign_key'=>'organization_book_id'),
    );

    public function set_member($member)
    {
        if (!$member instanceof Member) 
        {
            throw new InvalidInstanceException("invalid organization type");
        }

        $member->check_is_valid();

        $this->assign_attribute ('member_id',$member->id);
    }

    public function set_organization_book($organization_book)
    {
        if (!$organization_book instanceof Organization_Books) 
        {
            throw new InvalidInstanceException("invalid book type");
        }

        
        
        
        $this->assign_attribute ('organization_book_id',$organization_book->id);

    }



    public static function create($data)
    {
        $member_book = new Member_Books();
        $member_book->member = $data['member'];
        $member_book->organization_book = $data['organization_book'];
        

        if(!self::get($data))
        {
            throw new Member_BooksAlreadyExistsException("Member_Books Already Exists");    
        }
        
        $member_book->save();
        return $member_book;
    }

 

    public static function  get($data)
    {
        $member_id= $data['member']->id;
        $organization_book_id= $data['organization_book']->id;
        $result= self::find_by_member_id_and_organization_book_id_and_is_expired($member_id,$organization_book_id,0);
        
        if($result)
        {     
            return false;
        }


        $data['organization_book']->issue_book_to_member();

        return true;    
    }

    public  function return_book()
    {
        $this->is_expired = TRUE;
        $this->organization_book->return_book_by_member();
        return;
    }


}

?>