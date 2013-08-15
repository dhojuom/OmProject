<?php 
//session_start();
	
	class DashBoard extends SessionController
	{
		public function __construct()
    	{
        	// Call the Model constructor
        		parent::__construct();

        		

    		    

    	}

    	public function index()
    	{
            //return $this->load->view('dashboard',array("member"=>$this->member));
            $this->view_page('dashboard');

    	}

		public function submit()
		{	
			//return $this->load->view('dashboard',array("member"=>$this->member));
            $this->view_page('dashboard');
		}

        public function add_courses()
        {
            

            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {  
                    $organization_enrollments= $this->member->organization->org_enrollments;
                    return $this->view_page('add_course',array("enrollments"=>$organization_enrollments)); 
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
                        //$find = Enrollment::get($data);
                        $enrollment= Enrollment::create($data);                  
                        
                    
                    }
                    }

                        
                    catch(CourseBlankException $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->view_page('add_course',array("message"=>$e->getMessage(),"enrollments"=>$organization_enrollments));     
                    }

                    catch(CourseAlreadyEnrolled $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->view_page('add_course',array("message"=>$e->getMessage(),"enrollments"=>$organization_enrollments)); 
                    }


                    
                    return $this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));

        }  

        public function deactivate()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    
                    return $this->view_page('deactivate_courses',array("enrollments"=>$this->data['current_member']->enrollments));
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
                        
                        return $this->view_page('deactivate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));     
                    }

                    catch(CourseAlreadyDeactivated $e)
                    {   
                        $member=$this->member;
                        return $this->view_page('deactivate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));   
                    }


                
                    $this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));

                            
        }

        public function activate()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    $member=$this->member;
                    return $this->view_page('activate_courses',array("enrollments"=>$this->data['current_member']->enrollments));
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
                        $this->view_page('activate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));     
                    }

                    catch(CourseAlreadyactivated $e)
                    {   
                        $member=$this->member;
                        $this->load->view('activate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));   
                    }


                
                    $this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));
                    //$this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));

                            
        }


        public function delete_course()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    $member=$this->member;
                    return $this->view_page('unenroll_course',array("enrollments"=>$this->data['current_member']->enrollments));
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