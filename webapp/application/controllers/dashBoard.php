<?php 

	
	class DashBoard extends SessionController
	{
		public function __construct()
    	{
        	// Call the Model constructor
        		parent::__construct();

    	}

    	public function index()
    	{
            $this->check_my_session();
            
            return $this->view_page('dashboard');

    	}

		public function submit()
		{	
			$this->check_my_session();

            return $this->view_page('dashboard');
		}

        public function add_courses()
        {
            
            $this->check_my_session();
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
                        $data['organization']= $this->member->organization->id;
                        $check = OrganizationEnrollment:: find_valid_by_organization_id_and_course_id($data['organization'],$post);
                        $enrollment= Enrollment::create($data);                  

                          
                    }
                    }

                    catch (InvalidEnrollmentException $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->view_page('add_course',array("message"=>$e->getMessage(),"enrollments"=>$organization_enrollments));   
                    }

                    catch (InvalidModelException $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->view_page('add_course',array("message"=>$e->getMessage(),"enrollments"=>$organization_enrollments));   
                    }

                    catch (InactiveException $e)
                    {
                        $organization_enrollments= $this->member->organization->org_enrollments;
                        return $this->view_page('add_course',array("message"=>$e->getMessage(),"enrollments"=>$organization_enrollments));   
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


                    
                    catch (ModelDeletedException $e)
                    {
                        return $this->view_page('deactivate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));
                    }

                    catch(CourseBlankException $e)
                    {   
                        
                        return $this->view_page('deactivate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));     
                    }

                    catch(CourseAlreadyDeactivated $e)
                    {   
                        
                        return $this->view_page('deactivate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));   
                    }


                
                    return $this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));

                            
        }

        public function activate()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    
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

                    catch (ModelDeletedException $e)
                    {
                        return $this->view_page('deactivate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));
                    }

                    catch(CourseBlankException $e)
                    {   
                        
                        return $this->view_page('activate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));     
                    }

                    catch(CourseAlreadyactivated $e)
                    {   
                        
                        return $this->load->view('activate_courses',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));   
                    }


                
                    return $this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));
                    

                            
        }


        public function delete_course()
        {
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    
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

                    catch (ModelDeletedException $e)
                    {
                        return $this->view_page('unenroll_course',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));
                    }

                        
                    catch(CourseBlankException $e)
                    {   
                        
                        return $this->view_page('unenroll_course',array("message"=>$e->getMessage(),"enrollments"=>$this->data['current_member']->enrollments));     
                    }

                    


                    return $this->view_page('course',array("enrollments"=>$this->data['current_member']->enrollments));

                            
        }

        
		
	}	
?>