<?php

	class AddEnrollment extends CI_Controller
	{


		public function __construct()
    	{
        	// Call the Model constructor
       	 parent::__construct();
         if(!$member_id=$this->session->userdata('member_id'))
                {

                    $this->session->set_flashdata('error', 'Please Login to go to dashboard');

                    redirect('loginValidation');
                }

                $this->member = Member::find_by_id($member_id);

                if (!$this->member)
                {
                    $this->session->set_flashdata('error', 'Member not found');
                    redirect('loginValidation');
                }


    	}

    	public function index()
    	{
    		

    		if($_SERVER['REQUEST_METHOD'] !== 'POST')
				{

					$courses= Course::all();
                    return $this->load->view('add_course',array("member"=>$this->member,"courses"=>$courses));
				}
                

		              
				    foreach($_POST['check_list'] as $post)
                    {

                        $data['course_id']=Course::find_by_id($post);
                        $data['member_id']=$this->member;
                        $enrollment= Enrollment::create($data);
                    }

                    $enrollment= Enrollment::all(array('conditions' =>array('member_id==?', $this->member->id)));

                    //redirect('dashBoard/view_enrollments');


        public function view_member_enrollments($course_id)
        {
            $enrollment= Enrollment::find_by_id($course_id);
        
        foreach ($enrollment->member as $member)
        {
            echo $member->first_name." ".$member->last_name;
        }

        }


                  

                   
            
			
    	}


    }