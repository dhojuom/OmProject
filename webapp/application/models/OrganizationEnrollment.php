<?php
class CourseEnrolled extends Exception{}
class BlankException extends Exception{}

class OrganizationEnrollment extends ActiveRecord\Model
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
        $this->assign_attribute('course_id',$course->id);
    }

    public function set_organization($organization)
	{
    	$this->assign_attribute('organization_id',$organization->id);
    }
    public function set_is_active()
    {
        $this->assign_attribute('is_active',TRUE);
    }

    public function set_is_deleted()
    {
        $this->assign_attribute('is_deleted',FALSE);
    }

    public static function create($data)
    {
    	$enrollment = new OrganizationEnrollment();
    	$enrollment->course = $data['course'];
        $enrollment->organization= $data['organization']; 
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
        $results= self::find('all',array('conditions'=> array('course_id=? AND organization_id=?',$course_id,$organization_id)));
        foreach ($results as $result)
        {
             if($result->is_active==TRUE)
        {
            throw new CourseEnrolled("you are currently enrolled to the course");
        }

        }
        
        return;
    }

    public static function is_empty()
    {
       throw new BlankException("Select the course first"); 
    }


    


}