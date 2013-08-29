<?php
class CourseCodeBlankException extends Exception{}
class CategoryBlankException extends Exception{}
class DurationBlankException extends Exception{}

class Course extends BaseModel
{
	static $has_many= array(
		array(
            'enrollments',
            'class_name'=>'Enrollment',
            'foreign_key'=>'course_id'),
        array(
        'org_enrollments',
            'class_name'=>'OrganizationEnrollment',
            'foreign_key'=>'course_id'),
        
        );
    
	  

    static $table_name = 'course';
    static $primary_key = 'id';

    public function  set_name($name)
    {
        if($name=='')
        {
            throw new NameBlankException("name required");
        }
    	
        $this->assign_attribute ('name',$name);
    }

    public function set_course_code($code)
    {
    	if($code=='')
    	{
    		throw new CourseCodeBlankException("course code is compulsary"); 		
    	}
    	$this->assign_attribute('course_code',$code);
    }

    public function set_category($category)
    {
    	if($category=='')
    	{
    		throw new CategoryBlankException("category is required"); 		
    	}
    	$this->assign_attribute('category',$category);
    }

    public function set_duration_hours($time)
    {
    	if($time=='')
    	{
    		throw new DurationBlankException("Duration is compulsary"); 		
    	}
    	$this->assign_attribute('duration_hours',$time);
    }

    public function get_name()
    {

        return $this->read_attribute('name');
    }

    public function get_course_code()
    {

        return $this->read_attribute('course_code');
    }

    public function get_category()
    {

        return $this->read_attribute('category');
    }

    public function get_duration_hours()
    {

        return $this->read_attribute('duration_hours');
    }

    public static function create($form_data)
    {
    	$course= new Course();
		$course->name= $form_data['name'];
		$course->course_code= $form_data['course_code'];
		$course->category= $form_data['category'];
		$course->duration_hours= $form_data['hours'];
		$course->save();
		return $course;
    }

    public function course_upload($ftp,$config)
    {
        try
        {
            if($ftp->connect($config)==TRUE)
            {
               $bool= $ftp->upload('C:\Users\admin\Documents\GitHub\OmProject\webapp\system\courses_for_upload\B6TG3nw1Ja.docx', '/www/uploads/myfolder/');               
               if($bool==TRUE)
               {
                $ftp->close();
                return TRUE;
               }
               else 
               {
                throw new Exception("Failed to upload the file");
                
               }
            }

            else
            {
                throw new Exception("Failed to connect");
            }
        }

        catch(Exception $e)
        {
            $ftp->close();
            return FALSE;
        }
        
        
    }




}

?>