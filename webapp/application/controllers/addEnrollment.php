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

					
                    $organization_enrollments= $this->member->organization->org_enrollments;
                    return $this->load->view('add_course',array("member"=>$this->member,"enrollments"=>$organization_enrollments)); 
				}
                
                    try
                    {
                        if(!array_key_exists('check_list',$_POST))
                        {
                            Enrollment::is_empty();
                        }

		              
				    foreach($_POST['check_list'] as $post)
                    {


                        $data['course']=Course::find_by_id($post);
                        $data['member']=$this->member;
                        $find = Enrollment::get($data);
                        $enrollment= Enrollment::create($data);                  
                        
                    
                    }
                    }

                        
                    catch(CourseBlankException $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->load->view('add_course',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$organization_enrollments));     
                    }

                    catch(CourseAlreadyEnrolled $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->load->view('add_course',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$organization_enrollments)); 
                    }


                    $member=$this->member;
                    return $this->load->view('course',array("enrollments"=>$member->enrollments,"member"=>$this->member));

        }  

        public function deactivate()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    $member=$this->member;
                    return $this->load->view('deactivate_courses',array("enrollments"=>$member->enrollments,"member"=>$this->member));
                }

                    try
                    {
                        if(!array_key_exists('check_list',$_POST))
                        {
                            Enrollment::is_empty();
                        }

                      
                    foreach($_POST['check_list'] as $post)
                    {
                        
                        $member_id = $this->member->id;
                        
                        
                        $enrollment = Enrollment::find_by_course_id_and_member_id_and_is_active($post,$member_id,TRUE);
                        $enrollment->deactivate();
                    
                    }
                    }

                        
                    catch(CourseBlankException $e)
                    {   
                        $member= $this->member;
                        return $this->load->view('deactivate_courses',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$member->enrollments));     
                    }

                    catch(CourseAlreadyDeactivated $e)
                    {   
                        $member=$this->member;
                        return $this->load->view('deactivate_courses',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$member->enrollments));   
                    }


                    $member=$this->member;
                    return $this->load->view('course',array("enrollments"=>$member->enrollments,"member"=>$this->member));

                   			
    	}

        public function activate()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    $member=$this->member;
                    return $this->load->view('activate_courses',array("enrollments"=>$member->enrollments,"member"=>$this->member));
                }

                    try
                    {
                        if(!array_key_exists('check_list',$_POST))
                        {
                            Enrollment::is_empty();
                        }

                      
                    foreach($_POST['check_list'] as $post)
                    {
                        
                        $member_id = $this->member->id;
                        
                        
                        $enrollment = Enrollment::find_by_course_id_and_member_id_and_is_active($post,$member_id,FALSE);
                        $enrollment->activate();
                    
                    }
                    }

                        
                    catch(CourseBlankException $e)
                    {   
                        $member= $this->member;
                        return $this->load->view('deactivate_courses',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$member->enrollments));     
                    }

                    catch(CourseAlreadyactivated $e)
                    {   
                        $member=$this->member;
                        return $this->load->view('deactivate_courses',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$member->enrollments));   
                    }


                    $member=$this->member;
                    return $this->load->view('course',array("enrollments"=>$member->enrollments,"member"=>$this->member));

                            
        }


        public function delete_course()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    $member=$this->member;
                    return $this->load->view('unenroll_course',array("enrollments"=>$member->enrollments,"member"=>$this->member));
                }

                    try
                    {
                        if(!array_key_exists('check_list',$_POST))
                        {
                            Enrollment::is_empty();
                        }

                      
                    foreach($_POST['check_list'] as $post)
                    {
                        
                        $member_id = $this->member->id;
                        
                        
                        $enrollment = Enrollment::find_by_course_id_and_member_id_and_is_deleted($post,$member_id,FALSE);
                        $enrollment->delete_course();
                    
                    }
                    }

                        
                    catch(CourseBlankException $e)
                    {   
                        $member= $this->member;
                        return $this->load->view('deactivate_courses',array("message"=>$e->getMessage(),"member"=>$this->member,"enrollments"=>$member->enrollments));     
                    }

                    


                    $member=$this->member;
                    return $this->load->view('course',array("enrollments"=>$member->enrollments,"member"=>$this->member));

                            
        }



    }


?>