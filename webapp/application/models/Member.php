
<?php


class Member extends BaseModel
{
    static $has_one= array(
        array(
        'user',
        'class_name'=>'User',
        'foreign_key'=>'member_id',

        ));

    static $belongs_to= array(
        array(
            'organization',
            'class_name'=>'Organization',
            'foreign_key'=>'Organization_id',
            )

        );
    static $has_many= array(
        array(
            'enrollments',
            'class_name'=>'Enrollment',
            'foreign_key'=>'member_id'
            )
        );


    static $table_name = 'member';
    static $primary_key = 'id';

	
	

    public function  set_first_name($first_name)
    {
        if($first_name=='')
        {
            throw new FirstNameBlankException(" First name required");
        }
    	
        $this->assign_attribute ('first_name',$first_name);
        

    }
     public function set_last_name($last_name)
    {
        if($last_name =='')
        {
            throw new LastNameBlankException(" Lastname required");
        }
        $this->assign_attribute ('last_name',$last_name);
        
    }
     
    public function set_email($email)
    {
        if ($email == '')
        {
            throw new EmailBlankException("Email should be filled");
            
        }
        $this->assign_attribute ('email',$email);
    }

    public function set_address($address)
    {

    	$this->assign_attribute ('address',$address);
    }
    
    public function set_organization($organization)
    {
        
        if (!$organization instanceof Organization) 
        {
            throw new UnknownClassInstanceException("invalid organization type");
        }

        $organization->check_is_valid();


        $this->assign_attribute ('organization_id',$organization->id);
    }
    


    public function set_phone_number($phone_number)

    {

       $this->assign_attribute ('phone_no',$phone_number);
    }


   

    public function get_first_name()
    {

        return $this->read_attribute('first_name');
    }

    public function get_last_name()
    {

        return $this->read_attribute('last_name');
    }

    public function get_address()
    {

        return $this->read_attribute('address');
    }

    public function get_phone_number()
    {

        return $this->read_attribute('phone_no');

    }

    public function get_email()
    {
        return $this->read_attribute('email');
    }

    
    



    public static function create($form_data)
    {

    	$member= new Member();
    	$member->first_name = $form_data['first_name'];
    	$member->last_name = $form_data['last_name'];
    	$member->email=$form_data['email'];
    	$member->phone_number = $form_data['phone_number'];
    	$member->address=$form_data['address'];
        $member->organization=$form_data['organization'];
        $member->is_active=TRUE;
        $member->is_deleted=FALSE;
    	return $member;
    }
} 