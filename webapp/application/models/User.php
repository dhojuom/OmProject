<?php 

include_once('Exceptions.php');



class User extends ActiveRecord\Model
{
	static $belongs_to = array(
		array(
			'member',
			'class_name'=>'Member',
			'foreign_key'=>'member_id'

				));

	static $table_name ='users';
	static $primary_key = 'id';

	public function is_user_name_available($user_name)
	{
		if ($this->is_new_record()) 
		{
			$flag= User::exists(array('user_name'=>$user_name));
			if($flag)
			{
				throw new UserNameExistException("Username already exist");
			}

			
		}

		else {

			$flag= User::exists(array('conditions'=>array('user_name = ? and id != ?',$user_name, $this->id )));
			if($flag)
			{
				throw new UserNameExistException("Username already exist");
			}

			
		}

		return;

	}
	

	public function set_user_name($user_name)
	{

		if ($user_name=='')
		{
			throw new UserNameBlankException("User name should be filled");
		}

		$this->is_user_name_available($user_name);
		$this->assign_attribute('user_name',$user_name);

		
	}

	public static function find($user_name)
	{
		//$user = User::find_by_user_name($user_name);
		 $user = User::find(array('conditions'=>array(
		 'user_name'=>$user_name,
			/*'id'=>static::$primary_key, */
			)));
		return $user;
	}

	public function set_password($password)
	{
		if ($password=='')
		{
			throw new PasswordBlankException("password should be entered");
		}

		$this->assign_attribute ('password', sha1($password));

	}

	public function set_member($member)
	{
		$this->assign_attribute('member_id',$member->id);
	}


	public function get_user_name()
	{
		return $this->read_attribute('user_name');
	}

	public function get_password()
	{
		return $this->read_attribute('password');
	}

	

	public static function create($form_data)
    {
    	$user= new User();
    	$user->user_name = $form_data['user_name'];
    	$user->password = $form_data['password'];  
        return $user;
    }

    public static function check_login($data)
    {
    	$password=$data['password'];
    	$user = User::find_by_user_name($data['user_name']);

    	
		if (!$user)
		{
			
			throw new UsersInvalidException("No Users of the name");
			
		}

		
			
		if ($user->password==sha1($password))
		{
					return $user;
		}
		
		throw new UsersPasswordInvalidException("Your Password is not correct");		
    }

}
