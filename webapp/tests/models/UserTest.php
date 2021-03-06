<?php

class UserTest extends CIUnit_TestCase
{
	protected $tables = array(
			'users'=>'users',
			'member'=>'member',
			'organization'=>'organization'
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

	private function create_organization()
	{
		$organization= Organization::create(array(
			'name'=> 'kanpur',
			'registration_number'=>001,
			'location'=>'chabahil',
			'phone_number'=>9804574548,
			'email'=>'pokhara',
			'is_active'=>TRUE,
			'is_deleted'=>FALSE,
			));

		$organization->save();
		return $organization;
	}


	private function create_member()
	{
		$organization= self::create_organization();

		$member = Member::create(array(
			'first_name'=> 'om',
			'last_name'=>'dhoju',
			'email'=>'nineom_09',
			'phone_number'=>9804574548,
			'address'=>'pokhara',
			'organization'=>$organization,
			'is_active'=>TRUE,
			'is_deleted'=>FALSE,
			
			));

		$member->save();
		return $member;
	}
	public function test_user_name_blank_exception()
	{
		$user=new User();
		$this->setExpectedException('UserNameBlankException');
		$user->user_name='';
	}

	public function test_set_edit_user_name()
	{

			$user=new User();
			$user->user_name='ram';
			$user->save();
			$user->user_name= 'ram';
			$this->assertEquals($user->user_name,'ram');
			
	}

	public function test_set_edit_user_name_exception()
	{
		$user= new User();
		$user->user_name = 'om';
		$user->save();

		$user1=new User();
		$user1->user_name = 'rabin';
		$user1->save();
		$this->setExpectedException('UserNameExistException');
		$user->user_name = 'rabin';

	}

	
	public function test_set_new_user_name_exception()
	{	
		$user1= new User();
		$user1->user_name = 'om';
		$user1->save();
		$user2= new User();
		$this->setExpectedException('UserNameExistException');
		$user2->user_name= 'om';
		
	} 



	public function test_set_password()
	{
		$user=new User();
		$user->password = 'dhoju';
		$this->assertEquals($user->password,sha1('dhoju'));
	}

	public function test_set_password_exception()
	{
		$user= new User();
		$this->setExpectedException("PasswordBlankException");
		$user->password = '';
	}

	public function test_set_member()
	{
		$member_id = $this->member_fixt['1']['id'];
		$member = Member::find_by_id($member_id);
		$user = new User();
		$user->member = $member;

		$this->assertEquals($user->member->id,$member->id);
	}

	public function test_edit_password()
	{
		$user= new User();
		$user->password = 'dhoju';
		$this->assertEquals($user->password,sha1('dhoju'));
		$user->save();
		$user->password = 'karma';
		$user->save();
		$this->assertEquals($user->password,sha1('karma'));
	}

	public function test_create()
	{		
		
		$user= User::create(array('user_name'=>'pen','password'=>'copy'));

		$this->assertEquals($user->user_name,'pen');
		$this->assertEquals($user->password,sha1('copy'));
		
	}

	public function test_check_login()
	{
		$user = User::check_login(array('user_name'=>'omie','password'=>'dhoju'));
		$this->assertInstanceOf('User',$user);
	}

	public function test_check_login_username_exception()
	{
		$this->setExpectedException("UsersInvalidException");
		$user = User::check_login(array('user_name'=>'omi','password'=>'dhoju'));	
	}

	public function test_check_login_password_invalid_exception()
	{
		$this->setExpectedException("UsersPasswordInvalidException");
		$user = User::check_login(array('user_name'=>'omie','password'=>'dhoj'));	
	}

}
?>