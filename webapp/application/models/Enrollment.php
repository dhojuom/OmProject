<?php
class CourseAlreadyEnrolled extends Exception{}
class CourseBlankException extends Exception{}
class CourseAlreadyDeactivated extends Exception{}
class Enrollment extends ActiveRecord\Model
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

        $this->assign_attribute('course_id',$course->id);
    }

    public function set_member($member)
	{
    	$this->assign_attribute('member_id',$member->id);
    }
    public function set_is_active($bool)
    {
        $this->assign_attribute('is_active',$bool);
    }

    public function set_is_deleted($bool)
    {
        $this->assign_attribute('is_deleted',$bool);
    }

    public static function create($data)
    {
    	$enrollment = new Enrollment();
    	$enrollment->course = $data['course'];
        $enrollment->member= $data['member']; 
        $enrollment->is_active=TRUE;
        $enrollment->is_deleted=FALSE;
        $enrollment->save();
        return $enrollment;
    }

    public static function  get($data)
    {
        static $flag= 0;
        $member_id= $data['member']->id;
        $course_id= $data['course']->id;
        $results= self::find('all',array('conditions'=> array('course_id=? AND member_id=?',$course_id,$member_id)));
        foreach ($results as $result)
        {
             if($result->is_active==TRUE)
        {
            throw new CourseAlreadyEnrolled("you are currently enrolled to the course");
        }

        }
        
        return;
        
        
    }

    public static function is_empty()
    {
       throw new CourseBlankException("Select the course first"); 
    }


    public function deactivate()
    {
        $this->is_active=FALSE;
        $this->save();

        
    }

    public function activate()
    {
        
            $this->is_active=TRUE;
            $this->save();

    }

    public function delete_course()
    {
        $this->is_deleted=TRUE;
        $this->is_active=FALSE;
        $this->save();
    }
        
          
    
    


}