<?php

class EnrollmentTest extends CIUnit_TestCase
{
	protected $tables = array(
		'enrollment'=>'enrollment',
		'course'=>'course',
		'member'=>'member',
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


	public function test_set_course()
	{
		$enrollment = new Enrollment();
		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$enrollment->course = $course;
		$this->assertEquals($enrollment->course_id,$course->id);
	}
	public function test_set_course_exception()
	{
		$enrollment = new Enrollment();
		$course_id = $this->course_fixt['3']['id'];
		$course = Course::find_by_id($course_id);
		$this->setExpectedException('InvalidModelException');
		$enrollment->course = $course;

	}

	public function test_set_course_blank_exception()
	{
		$enrollment = new Enrollment();
		$this->setExpectedException("CourseBlankException");
		$enrollment->course='';
	}

	public function test_set_member()
	{
		$enrollment = new Enrollment();
		$member_id = $this->member_fixt['1']['id'];
		$member = Member::find_by_id($member_id);
		$enrollment->member = $member;
		$this->assertEquals($enrollment->member_id,$member->id);
	}

	public function test_create()
	{
		$course_id = $this->course_fixt['2']['id'];
		$member_id = $this->member_fixt['2']['id'];
		$course = Course::find_by_id($course_id);
		$member = Member::find_by_id($member_id);
		
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member,
		 				 		
		 			)
				);

		$this->assertEquals($enrollment->course_id,$course->id);
		$this->assertEquals($enrollment->member_id,$member->id);
		$this->assertEquals($enrollment->is_active,1);
		$this->assertEquals($enrollment->is_deleted,0);
	}

	public function test_create_exception()
	{
		$course_id = $this->course_fixt['1']['id'];
		$member_id = $this->member_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$member = Member::find_by_id($member_id);
		$this->setExpectedException("InvalidEnrollmentException");
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member,
		 				 		
		 			)
				);

	}

	public function test_create_inactive_exception()
	{
		$course_id = $this->course_fixt['1']['id'];
		$member_id = $this->member_fixt['2']['id'];
		$course = Course::find_by_id($course_id);
		$member = Member::find_by_id($member_id);
		$this->setExpectedException("InvalidEnrollmentException");
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member,
		 				 		
		 			)
				);

	}

	public function test_create_if_is_deleted()
	{

		$course_id = $this->course_fixt['1']['id'];
		$member_id = $this->member_fixt['3']['id'];
		$course = Course::find_by_id($course_id);
		$member = Member::find_by_id($member_id);
		
		
		$enrollment = Enrollment::create(array(
		 			'course'=>$course,
		 			'member'=>$member,
		 				 		
		 			)
				);
		$this->assertEquals($enrollment->course_id,$course->id);
		$this->assertEquals($enrollment->member_id,$member->id);
		$this->assertEquals($enrollment->is_active,1);
		$this->assertEquals($enrollment->is_deleted,0);

	}

	public function test_is_empty()
	{
		$this->setExpectedException("CourseBlankException");
		Enrollment::is_empty();
	}

	public function test_deactivate()
	{
		$enrollment = Enrollment::find_by_id($this->enrollment_fixt['1']['id']);
		$enrollment->deactivate();
		$this->assertEquals($enrollment->is_active,0);
	}

	public function test_activate()
	{
		$enrollment = Enrollment::find_by_id($this->enrollment_fixt['2']['id']);
		$enrollment->activate();
		$this->assertEquals($enrollment->is_active,1);	
	}

	public function test_delete_course()
	{
		$enrollment = Enrollment::find_by_id($this->enrollment_fixt['1']['id']);
		$enrollment->delete_course();
		$this->assertEquals($enrollment->is_deleted,1);	
	}
	

}
?>
	
	