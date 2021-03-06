<?php
include_once('Exceptions.php');
class Enrollment extends BaseModel
{

    static $table_name = 'enrollment';
    static $primary_key = 'id';

    static $belongs_to = array(
        array(
            'member',
            'class_name'=>'Member',
            'foreign_key'=>'member_id'),
        array(
            'course',
            'class_name'=>'Course',
            'foreign_key'=>'course_id')
    );

    public function set_course($course)
    {   
        
        if (!$course)
        { 
            throw new CourseBlankException("Select the course first");  
        }

        $course->check_is_valid();
        $this->assign_attribute('course_id',$course->id);
    }


    public function set_member($member)
	{
        $member->check_is_valid();
    	$this->assign_attribute('member_id',$member->id);
    }

    

    
    

    public static function create($data)
    {
    	$enrollment = new Enrollment();
    	$enrollment->course = $data['course'];
        $enrollment->member= $data['member']; 
        if(!self::get($data)){

            throw new InvalidEnrollmentException("Cannot select the enrollment");
            
        }
        $enrollment->is_active=TRUE;
        $enrollment->is_deleted=FALSE;
        $enrollment->save();
        return $enrollment;
    }

    public static function  get($data)
    {
        //static $flag= 0;
        $member_id= $data['member']->id;
        $course_id= $data['course']->id;
        $result= self::find_by_course_id_and_member_id_and_is_deleted($course_id,$member_id,FALSE);
        
        
        if($result)
        {     
            return false;
        }
        
        return true;    
    }

    public static function is_empty()
        {
            throw new CourseBlankException("Select the course first"); 
        }

    

    public function inactive_courses($member)
    {
        $inactive_courses = array();
        $enrollments = $member->enrollments;
        foreach ($enrollments as $enrollment)
        {
            if(!$enrollment->is_active && !$enrollment->is_deleted)
            {
                $inactive_courses[]= $enrollment->course;
            }
        }
        return $inactive_courses;
    }

    public function active_courses($member)
    {
        $active_courses = array();
        $enrollments = $member->enrollments;
        foreach ($enrollments as $enrollment)
        {
            if($enrollment->is_active && !$enrollment->is_deleted)
            {
                $active_courses[] = $enrollment->course;
            }
        }
        return $active_courses;
    }


    public function deactivate()
    {
        
        $this->check_is_active();
        $this->check_deleted();
        $this->is_active=FALSE;
        $this->save();
   
    }

    public function activate()
    {
            $this->check_deleted();
            $this->is_active=TRUE;
            $this->save();

    }

    public function delete_course()
    {   
        $this->check_deleted();
        $this->is_deleted=TRUE;
        $this->is_active=FALSE;
        $this->save();
    }
        
          
    
    


}