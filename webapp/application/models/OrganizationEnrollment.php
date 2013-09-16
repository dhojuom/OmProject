<?php
include_once('Exceptions.php');

class OrganizationEnrollment extends BaseModel
{

    static $table_name = 'organization_enrollment';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'organization',
            'class_name'=>'Organization',
            'foreign_key'=>'organization_id'),
        array(
            'course',
            'class_name'=>'Course',
            'foreign_key'=>'course_id')
    );

    public function set_course($course)
    { 
        $course->check_is_valid();

        $this->assign_attribute('course_id',$course->id);
    }

    public function set_organization($organization)
	{
        $organization->check_is_valid();
    	$this->assign_attribute('organization_id',$organization->id);
    }

    
    public static function create($data)
    {
    	$enrollment = new OrganizationEnrollment();
    	$enrollment->course = $data['course'];
        $enrollment->organization= $data['organization'];
        if(!self::get($data)){

            throw new InvalidOrganizationEnrollmentException("Courses already subscribed");
            
        } 
        
        $enrollment->is_active=TRUE;
        $enrollment->is_deleted=FALSE;
        $enrollment->save();
        return $enrollment;
    }

    public static function courses_subscribed($organization)
    {
        $org_id= $organization->id;
        $courses=self::find('all',array('conditions'=>array('organization_id=?',$org_id)));
        return $courses;
    }

    public static function  get($data)
    {
        $organization_id=$data['organization']->id;
        $course_id= $data['course']->id;
        //$result= self::find('all',array('conditions'=> array('course_id=? AND organization_id=?',$course_id,$organization_id)));
        $result= self::find_by_organization_id_and_course_id($organization_id,$course_id);
        if($result && !$result->is_deleted)
        {     
            return false;
        }
        
        return true;
    }

    public static function is_empty()
        {
            throw new CourseBlankException("Select the course first"); 
        }

    


    


}