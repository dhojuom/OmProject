<?php

class MemberTest extends CIUnit_TestCase
{
	protected $tables = array(
			'member'=>'member',
			'users' => 'users',
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
	
	public function test_set_first_name()
	{
		$member= new Member();

		$member->first_name = 'om';
		$this->assertEquals($member->first_name,'om');
	}

	public function test_set_last_name()
	{
		$member= new Member();

		$member->last_name = 'dhoju';
		$this->assertEquals($member->last_name,'dhoju');
	}

	public function test_set_email()
	{
		$member= new Member();
		$member->email='nineom_09@hotmail.com';
		$this->assertEquals($member->email,'nineom_09@hotmail.com');
	}


	public function test_set_mock_organization()
	{
		$member= new Member();
		$organization= $this->getMockBuilder('Organization')
							->disableOriginalConstructor()
							->getMock();
		/*$organization->expect($this->any())
						->method('get_name')
             			->will($this->returnValue('om'));*/

		//$organization = self::create_organization();
		$member->organization = $organization;
		//$this->assertEquals($member->organization_id,$organization->id);
		$this->assertNull($member->organization_id,$organization->id);
        //$this->assertEquals($organization->get_name,'om');
	}
	public function test_set_organization()
	{
		$member= new Member();
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$member->organization = $organization;
	}

	public function test_set_inactive_organization()
	{
		$member= new Member();
		$inactive_organization_id= $this->organization_fixt['1']['id'];
		$organization = Organization::find_by_id($inactive_organization_id);
		$this->setExpectedException('InvalidModelException');
		$member->organization = $organization;

	}

	public function test_set_deleted_organization()
	{
		$member= new Member();
		$deleted_organization_id= $this->organization_fixt['3']['id'];
		$organization = Organization::find_by_id($deleted_organization_id);
		$this->setExpectedException('InvalidModelException');
		$member->organization = $organization;

	}


	public function test_is_valid_organization_exception()
	{
		$member = new Member();
		$this->setExpectedException('UnknownClassInstanceException');
		$member->organization='';

	}
	public function test_is_organization_instance_exception()
	{	

		$member= new Member();
		$this->setExpectedException('UnknownClassInstanceException');
		$member->organization= $member;
	}

	/*public function test_set_inactive_organization()
	{
		$member = new Member;
		$organization=self::create_organization();
		$organization->is_active=FALSE;
		$organization->save();
		$this->setExpectedException('InvalidModelException');
		$member->organization = $organization;
	}*/
		
		


	public function test_first_name_exception()
	{
		$member= new Member();

		$this->setExpectedException('FirstNameBlankException');

		$member->first_name='';
	}

	
		

	public function test_last_name_exception()
	{
		$member= new Member();

		$this->setExpectedException('LastNameBlankException');		
		$member->last_name='';
		
	}

	public function test_email_exception()
	{
		$member= new Member();
		
		$this->setExpectedException('EmailBlankException');

		$member->email='';
	}

	public function test_create()
	{	

		//$organization = $this->create_organization();
		$organization_id= $this->organization_fixt['2']['id'];
		$organization= Organization::find_by_id($organization_id);
		

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


		$this->assertEquals($member->first_name,'om');
		$this->assertEquals($member->last_name,'dhoju');
		$this->assertEquals($member->email,'nineom_09');
		$this->assertEquals($member->phone_number,9804574548);
		$this->assertEquals($member->address,'pokhara');
		$this->assertEquals($member->is_active,TRUE);
		$this->assertEquals($member->is_deleted,FALSE);
		$this->assertEquals($member->organization_id,$organization->id);
		

	}   
}

?>
