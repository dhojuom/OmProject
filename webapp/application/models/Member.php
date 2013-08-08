<?php


class FirstNameBlankException extends Exception { }
class LastNameBlankException extends Exception { }
class EmailBlankException extends Exception { }
class UserNameBlankException extends Exception { }
class PasswordBlankException extends Exception { }




class Member extends ActiveRecord\Model
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

    static $table_name = 'member';
    static $primary_key = 'id';

	
	

    public function  set_first_name($first_name)
    {
        if($first_name=='')
        {
            throw new FirstNameBlankException(" First name required");
        }
    	
        $this->assign_attribute ('first_name',$first_name);
        //$this->first_name = $first_name;

    }
     public function set_last_name($last_name)
    {
        if($last_name =='')
        {
            throw new LastNameBlankException(" Lastname required");
        }
        $this->assign_attribute ('last_name',$last_name);
        //$this->last_name = $last_name;
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
    public function set_organization_id($organization)
    {

        $this->assign_attribute ('organization_id',$organization->id);
    }


     public function set_phone_number($phone_number)

    {

       $this->assign_attribute ('phone_no',$phone_number);
    }

    public function set_is_active()
    {

        //$this->is_active=1;
    }

    public function set_is_delete()
    {
        //$this->assign_attribute('is_delete')
    }

   

    public function get_first_name()
    {

        return $this->read_attribute('first_name');
    }

    public function get_last_name()
    {

        return $this->read_attribute('last_name');
    }

    public function get_password()
    {

        return $this->read_attribute('password');
    }

    public function get_address()
    {

        return $this->read_attribute('address');
    }

    public function get_phone_number()
    {

        return $this->read_attribute('phone_number');

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
    	$member->phone_no = $form_data['phone_number'];
    	$member->address=$form_data['address'];
        $member->organization_id=$form_data['organization'];

        $user = User::create(array(
            'user_name'=>$form_data['user_name'],
            'password'=>$form_data['password'],
            'member'=>$member,
            )
        );
        $member->save();
        $user->member= $member;
        $user->save();


        
        
    	return $member;
    }





} 