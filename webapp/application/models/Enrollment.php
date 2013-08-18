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

        $this->assign_attribute('course_id',$course->id);
    }

    public function set_member($member)
	{
    	$this->assign_attribute('member_id',$member->id);
    }
    

    public static function create($data)
    {
    	$enrollment = new Enrollment();
    	$enrollment->course = $data['course'];
        $enrollment->member= $data['member']; 
        if(!self::get($data)){

            return;
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
        $result= self::find_by_course_id_and_member_id($course_id,$member_id);
        
        
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

    


    public function deactivate()
    {
        
        $this->check_is_inactive();
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