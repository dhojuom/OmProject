<?php

class CourseTest extends CIUnit_TestCase
{
	protected $tables = array(

			'course'=>'course',
			'enrollment'=>'enrollment',
			'organization_enrollment'=>'organization_enrollment',
			
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

	public function test_set_name()
	{
		$course = new Course();
		$course->name= 'Java';
		$this->assertEquals($course->name,'Java');

	}

	public function test_set_name_blank_exception()
	{
		$course = new Course();
		$this->setExpectedException("NameBlankException");
		$course->name='';
	}

	public function test_set_course_code()
	{
		$course = new Course;
		$course->course_code= 001;
		$this->assertEquals($course->course_code,001);

	}

	public function test_coursecode_exception()
	{
		$course = new Course();
		$this->setExpectedException('CourseCodeBlankException');
		$course->course_code='';
	}

	public function test_set_category()
	{
		$course= new Course;
		$course->category = "science";
		$this->assertEquals($course->category,"science");
	}

	public function test_category_exception()
	{
		$course= new Course();
		$this->setExpectedException('CategoryBlankException');
		$course->category='';
	}

	public function test_set_duration_hours()
	{
		$course = new Course;
		$course->duration_hours=80;
		$this->assertEquals($course->duration_hours,80);
	}	

	
	public function test_duration_hours_exception()
	{
		$course= new Course();
		$this->setExpectedException('DurationBlankException');
		$course->duration_hours='';
	}

	public function test_create()
	{
		$course= new Course();
		$course->name='java';
		$course->course_code=001;
		$course->category="science";
		$course->duration_hours=80;
		$course->save();

		$this->assertEquals($course->name,'java');
		$this->assertEquals($course->course_code,001);
		$this->assertEquals($course->category,'science');
		$this->assertEquals($course->duration_hours,80);


	}

	public function get_config_array()
	{
		$config['hostname'] = 'mickeymouse.com';
        $config['username'] = 'om';
        $config['password'] = 'om';
        $config['port']     = 21;
        $config['passive']  = FALSE;
        $config['debug']    = TRUE;

        return $config;
	}


	public function create_mock_upload_true()
	{
		$config = $this->get_config_array();
		$ftp_mock = $this->getMockBuilder('CI_FTP')
							->disableOriginalConstructor()
							->getMock();
		


		$ftp_mock->expects($this->any())
                 	->method('connect')
                 	->with($this->equalTo($config))
    				->will($this->returnValue(TRUE));

    	$ftp_mock->expects($this->any())
    				->method('upload')
    				->with('C:\Users\admin\Documents\GitHub\OmProject\webapp\system\courses_for_upload\B6TG3nw1Ja.docx','/www/uploads/myfolder/')
    				->will($this->returnValue(TRUE));
    							
    	return $ftp_mock;
	}

	public function create_mock_upload_false()
	{
		$config = $this->get_config_array();
		$ftp_mock = $this->getMockBuilder('CI_FTP')
							->disableOriginalConstructor()
							->getMock();
		


		$ftp_mock->expects($this->once())
                 	->method('connect')
                 	->with($this->equalTo($config))
    				->will($this->returnValue(TRUE));

    	$ftp_mock->expects($this->once())
    				->method('upload')
    				->with('C:\Users\admin\Documents\GitHub\OmProject\webapp\system\courses_for_upload\B6TG3nw1Ja.docx','/www/uploads/myfolder/')
    				->will($this->returnValue(FALSE));
    							
    	return $ftp_mock;
	}

	public function create_mock_connect_false()
	{
		$config = $this->get_config_array();
		$ftp_mock = $this->getMockBuilder('CI_FTP')
							->disableOriginalConstructor()
							->getMock();
		


		$ftp_mock->expects($this->any())
                 	->method('connect')
                 	->with($this->equalTo($config))
    				->will($this->returnValue(FALSE));

    	$ftp_mock->expects($this->any())
    				->method('upload')
    				->with('C:\Users\admin\Documents\GitHub\OmProject\webapp\system\courses_for_upload\B6TG3nw1Ja.docx','/www/uploads/myfolder/')
    				->will($this->returnValue(TRUE));
    							
    	return $ftp_mock;
	}




	
	public function test_upload_true()
	{
		$config = $this->get_config_array();	
		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$ftp_mock = $this->create_mock_upload_true();
    	$bool= $course->course_upload($ftp_mock,$config);
		$this->assertTrue($bool);
	}

	public function test_upload_false()
	{
		$config = $this->get_config_array();
		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$ftp_mock = $this->create_mock_upload_false();          	
    	$bool= $course->course_upload($ftp_mock,$config);
		$this->assertFalse($bool);
	}

	public function test_connect_false()
	{
		$config = $this->get_config_array();
		$course_id = $this->course_fixt['1']['id'];
		$course = Course::find_by_id($course_id);
		$ftp_mock = $this->create_mock_connect_false();
    	$bool= $course->course_upload($ftp_mock,$config);
		$this->assertFalse($bool);
	}

}
?>