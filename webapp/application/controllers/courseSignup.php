<?php 
//session_start();
	
	class CourseSignup extends CI_Controller
	{
		public function __construct()
    	{
        	// Call the Model constructor
        		parent::__construct();	    
    	}

    	public function index()
    	{
            if($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            return $this->load->view('course_form');
        }       
    
        $data['name']= $_POST['name'];
        $data['course_code']= $_POST['course_code'];
        $data['category']=$_POST['category'];
        $data['hours']=$_POST['hours'];
        
    
        try
        {
            
            $course = Course::create($data);
            
        }

        catch(NameBlankException $e)
        {
            return $this->load->view('course_form',array("message"=>$e->getMessage()));

        }

        catch(CourseCodeBlankException $e)
        {
            return $this->load->view('course_form',array("message"=>$e->getMessage()));

        }
        catch(CategoryBlankException $e)
        {
            return $this->load->view('course_form',array("message"=>$e->getMessage()));

        }
        catch(DurationBlankException $e)
        {
            return $this->load->view('course_form',array("message"=>$e->getMessage()));

        }
    
    

        if(!$course)
        {
            $this->session->set_flashdata('create_problem','Course creation is unsuccessfull');
            redirect('courseSignup');
        }

        $courses= Course::all();

        return $this->load->view('course',array('courses'=>$courses));
        }


        public function view_members($course_id)
        {   
        //$members= Member::find('all',array('conditions'=>array('organization_id = ?',$organization_id)));
            $course= Course::find_by_id($course_id);
        
            foreach ($course->members as $member)
            {
                echo $member->first_name." ".$member->last_name;
            }


        }
    }

    	
?>