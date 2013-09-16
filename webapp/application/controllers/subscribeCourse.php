<?php

	class SubscribeCourse extends CI_Controller
	{


		public function __construct()
    	{
        	// Call the Model constructor
       	 parent::__construct();

    	}

        public function offer_all_members_courses($organization_id)
        {   
            $organization= Organization::find_by_id($organization_id);

            foreach ($organization->org_enrollments as $org_enrollment) 
            {
                $course= Course::find_by_id($org_enrollment->course_id);
                $courses[] = $course;
            }
            try
            {

            $organization->enroll_members($courses);

            }

            catch(Exception $e)
            {
                    echo "Sorry, Unable to complete the transaction";

            }


        }

        public function save_member_and_org_enrollment_count($organization_id)
        {
            $organization= Organization::find_by_id($organization_id);
            $organization->save_member_count_and_org_enrollment_count();
        }


        public function add_org_enrollment($organization_id)
        {
         
            if($_SERVER['REQUEST_METHOD'] !== 'POST')
                {
                    $organization= Organization::find_by_id($organization_id);

                    $courses= Course::all();
                    return $this->load->view('subscribe_course',array("organization"=>$organization,"courses"=>$courses)); 
                }
                

                try
                    {
                        if(!array_key_exists('check_list',$_POST))
                        {
                            OrganizationEnrollment::is_empty();
                        }

                      
                    foreach($_POST['check_list'] as $post)
                    {

                        $data['organization']= Organization::find_by_id($organization_id);
                        $data['course']=Course::find_by_id($post);
                        $enrollment= OrganizationEnrollment::create($data); 
                       
                                           
                    }
                    }



                catch(InvalidOrganizationEnrollmentException $e)
                {
                        $organization=Organization::find_by_id($organization_id);
                        $courses= Course::all();
                        return $this->load->view('subscribe_course',array("message"=>$e->getMessage(),"organization"=>$organization,"courses"=>$courses));   
                }

                catch(InvalidModelException $e)
                {
                        $organization=Organization::find_by_id($organization_id);
                        $courses= Course::all();
                        return $this->load->view('subscribe_course',array("message"=>$e->getMessage(),"organization"=>$organization,"courses"=>$courses));   
                }

                catch(BlankException $e)
                    {
                        $organization=Organization::find_by_id($organization_id);
                        $courses= Course::all();
                        return $this->load->view('subscribe_course',array("message"=>$e->getMessage(),"organization"=>$organization,"courses"=>$courses));
                    }

                catch(CourseEnrolled $e)
                    {
                        $courses= Course::all();
                        $organization=Organization::find_by_id($organization_id);
                        return $this->load->view('subscribe_course',array("message"=>$e->getMessage(),"organization"=>$organization,"courses"=>$courses));
                    }

                catch(Exception $e)
                {
                    $organization=Organization::find_by_id($organization_id);
                    $courses= Course::all();
                    return $this->load->view('subscribe_course',array("message"=>$e->getMessage(),"organization"=>$organization,"courses"=>$courses));

                }

                echo "courses successfully subscribed";
                  
        }      
                   			
    	
    }


?>