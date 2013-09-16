<?php

class OrganizationTest extends CIUnit_TestCase
{
	protected $tables = array(
		'organization'=>'organization',
		'course'=>'course',
		'member'=>'member',
		'organization_enrollment'=>'organization_enrollment',
		);

	public function __construct()
	{
		parent::__construct();
	}

	public function setUp()
	{
		parent::setUp();
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	public function test_set_name()
	{
		$organization = new Organization();
		$organization->name = "Olive Media";
		$this->assertEquals($organization->name,"Olive Media");
	}

	public function test_set_location()
	{
		$organization = new Organization();
		$organization->location = "chabahil";
		$this->assertEquals($organization->location,"chabahil");
	}

	public function test_set_registration_number()
	{
		$organization = new Organization();
		$organization->registration_number = 12;
		$this->assertEquals($organization->registration_number,12);
	}

	public function test_set_phone_number()
	{
		$organization = new Organization();
		$organization->phone_number = 123456;
		$this->assertEquals($organization->phone_number,123456);
	}


	public function test_set_email()
	{
		$organization = new Organization();
		$organization->email = "olivemedia@mail.com";
		$this->assertEquals($organization->email,"olivemedia@mail.com");
	}

	public function test_name_blank_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('NameBlankException');
		$organization->name = "";
	}

	public function test_location_blank_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('LocationBlankException');
		$organization->location = "";
	}
	public function test_registration_number_blank_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('RegistrationBlankException');
		$organization->registration_number = "";
	}

	public function test_phone_number_blank_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('PhoneNumberBlankException');
		$organization->phone_number = "";
	}

	public function test_email_blank_exception()
	{
		$organization = new Organization();
		$this->setExpectedException('EmailBlankException');
		$organization->email = "";
	}

	
	public function test_create()
	{
		$organization = Organization::create(array(
		 			'name'=> 'Olive Media',
		 			'location'=>'chabahil',
		 			'phone_number'=>123456,
		 			'email'=>'olivemedia@mail.com',
		 			'registration_number'=>001,		 		
		 			)
				);

		$this->assertEquals($organization->name,'Olive Media');
		$this->assertEquals($organization->location,'chabahil');
		$this->assertEquals($organization->phone_number,123456);
		$this->assertEquals($organization->email,'olivemedia@mail.com');
		$this->assertEquals($organization->registration_number,001);

	}

	public function test_enroll_members_rollback_exception()
	{
		$organization_enrollment = OrganizationEnrollment::find_by_id($this->organization_enrollment_fixt['4']['id']);
		$organization = Organization::find_by_id($this->organization_fixt['5']['id']);
		$this->setExpectedException("InvalidModelException");
		$organization->enroll_members(array($organization_enrollment->course));

		foreach($organization->members as $member)
		{
			$enrollment = Enrollment::find_by_member_id_and_course_id($member->id,$organization_enrollment->course_id);
			$this->assertNull($enrollment);
		}
		
	}



	public function test_enroll_members()
	{
		$organization_enrollment = OrganizationEnrollment::find_by_id($this->organization_enrollment_fixt['6']['id']);
		$organization = Organization::find_by_id($this->organization_fixt['4']['id']);
		$organization->enroll_members(array($organization_enrollment->course));

		foreach($organization->members as $member)
		{
			$enrollment = Enrollment::find_by_member_id_and_course_id($member->id,$organization_enrollment->course_id);
			$this->assertEquals($enrollment->member_id,$member->id);
			$this->assertEquals($enrollment->course_id,$organization_enrollment->course_id);
		}

	}

	
	public function test_save_member_count_and_org_enrollment_count()
	{
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		
        $this->assertEquals($organization->member_count,0);
		$this->assertEquals($organization->org_enrollment_count,0);

		$organization->save_member_count_and_org_enrollment_count();

		$this->assertEquals($organization->member_count,3);
		$this->assertEquals($organization->org_enrollment_count,3);

	}

	public function test_count_members()
	{
		$reflection_class= new ReflectionClass("Organization");
		$method = $reflection_class->getMethod("count_members");
		$method->setAccessible(true);
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$this->assertEquals($method->invoke($organization),3);
	}

	public function test_count_org_enrollments()
	{
		$reflection_class = new ReflectionClass("Organization");
		$method = $reflection_class->getMethod("count_organization_enrollments");
		$method->setAccessible(true);
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$this->assertEquals($method->invoke($organization),3);

	}

	/*public function test_enroll_members()
	{
		$organization_id = $this->organization_fixt['2']['id'];
	}*/

}