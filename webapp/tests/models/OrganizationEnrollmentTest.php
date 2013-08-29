<?php

class OrganizationEnrollmentTest extends CIUnit_TestCase
{
	protected $tables = array(
		'organization_enrollment'=>'organization_enrollment',
		'organization'=>'organization',
		'course'=>'course',
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

	private function create_course()
	{
		$course = Course::create(array(
							'name'=>'java',
							'course_code'=>001,
							'category'=>'science',
							'hours'=>50,
							)
						);

		$course->save();
		return $course;
	}

	public function test_set_course()
	{
		$org_enrollment = new OrganizationEnrollment();
		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$org_enrollment->course = $course;
		$this->assertEquals($org_enrollment->course_id,$course->id);
	}


	public function test_set_course_exception()
	{
		$org_enrollment = new OrganizationEnrollment();
		$course_id = $this->course_fixt['3']['id'];
		$course = Course::find_by_id($course_id);
		$this->setExpectedException('InvalidModelException');
		$org_enrollment->course = $course;

	}

	public function test_set_organization()
	{
		$org_enrollment = new OrganizationEnrollment();
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$org_enrollment->organization = $organization;
		$this->assertEquals($org_enrollment->organization_id,$organization->id);
	
	}



	public function test_create()
	{
		$course_id = $this->course_fixt['2']['id'];
		$course = Course::find_by_id($course_id);
		$organization_id = $this->organization_fixt['4']['id'];
		$organization = Organization::find_by_id($organization_id);
		
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization,
		 				 		
		 			)
				);

		$org_enrollment->save();
		$this->assertEquals($org_enrollment->course_id,$course->id);
		$this->assertEquals($org_enrollment->organization_id,$organization->id);
		$this->assertEquals($org_enrollment->is_active,1);
		$this->assertEquals($org_enrollment->is_deleted,0);
	}


	public function test_create_exception()
	{

		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$this->setExpectedException("InvalidOrganizationEnrollmentException");
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization, 		
		 			)
				);	
	}
	public function test_create_inactive_exception()
	{
		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$organization_id = $this->organization_fixt['4']['id'];
		$organization = Organization::find_by_id($organization_id);
		$this->setExpectedException("InvalidOrganizationEnrollmentException");
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization, 		
		 			)
				);	

	}


	public function test_create_deleted_enrollment()
	{
		$course_id = $this->course_fixt['2']['id'];
		$course = Course::find_by_id($course_id);
		$organization_id = $this->organization_fixt['2']['id'];
		$organization = Organization::find_by_id($organization_id);
		$org_enrollment = OrganizationEnrollment::create(array(
		 			'course'=>$course,
		 			'organization'=>$organization, 		
		 			)
				);	
		
	}


}
?>
	
	