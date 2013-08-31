<?php

class Organization extends BaseModel
{

	static $has_many= array(
        array(
        'members',
        'class_name'=>'Member',
        'foreign_key'=>'organization_id',
            ),
        array(
            'org_enrollments',
            'class_name'=>'OrganizationEnrollment',
            'foreign_key'=>'organization_id'
            ),
        );

    
    static $table_name = 'organization';
    static $primary_key = 'id';

    
    private function count_members()
    {
        $count= count($this->members);
        return $count;

    }

    private function count_organization_enrollments()
    {
        $count = count($this->org_enrollments);
        return $count;

    }

    public function save_member_count_and_org_enrollment_count()
    {
        
        $member_count= $this->count_members();
        $org_enrollments_count= $this->count_organization_enrollments();
        $this->assign_attribute('member_count',$member_count);
        $this->assign_attribute('org_enrollment_count',$org_enrollments_count);
        $this->save();

    }
    
    public function set_name($name)
    {
    	if($name=='')
        {
            throw new NameBlankException("name required");
        }
    	
        $this->assign_attribute ('name',$name);
    }
    public function set_email($email)
    {
    	if($email=='')
        {
            throw new EmailBlankException(" Email required");
        }
    	
        $this->assign_attribute ('email',$email);

    }

    public function set_phone_number($phone_number)
    {
    	if($phone_number=='')
        {
            throw new PhoneNumberBlankException(" phone_number required");
        }
    	
        $this->assign_attribute ('phone_number',$phone_number);

    }

    public function set_location($location)
    {
    	if($location =='')
        {
            throw new LocationBlankException(" Location required");
        }
    	
        $this->assign_attribute ('location',$location);
    }
    public function set_registration_number($registration_number)
    {
    	if($registration_number=='')
        {
            throw new RegistrationBlankException(" Registration Number required");
        }
    	
        $this->assign_attribute ('registration_number',$registration_number);
    }

    public function get_name()
    {

        return $this->read_attribute('name');
    }

    public function get_location()
    {

        return $this->read_attribute('location');
    }


    public function get_registration_number()
    {

        return $this->read_attribute('registration_number');
    }

    public function get_id()
    {
        return $this->read_attribute('id');
    }

    public function get_phone_number()
    {

        return $this->read_attribute('phone_number');
    }

    public function finder()
    {
    	$organizations = Organization::find('all');
    	return $organizations;
    }

	public static function create($form_data)
	{

		$organization= new Organization();
		$organization->name= $form_data['name'];
		$organization->registration_number= $form_data['registration_number'];
		$organization->location= $form_data['location'];
		$organization->phone_number= $form_data['phone_number'];
		$organization->email= $form_data['email'];
        $organization->is_active=TRUE;
        $organization->is_deleted=FALSE;
		$organization->save();
		return $organization;



	}

    

    public function enroll_members($courses)
    {   
        $connection = Enrollment::connection();
        $connection->transaction();  
        foreach ($courses as $course) 
        {
          $course->check_is_valid(); 

        
        try
        {
        
        
        $members = $this->members;
        foreach ($members as $member)
        {
          $enrollment= Enrollment::find_by_member_id_and_course_id_and_is_active($member->id,$course->id,TRUE);
          if($enrollment)
          {
            $enrollment->is_deleted=TRUE;
          }

          $newEnrollment = Enrollment::create(array(
                                                'member'=>$member,
                                                'course'=>$course,
                                                    ));
        }


        
        }
        catch (Exception $e) 
        {
            $connection->rollback();
           
            throw $e;
        }

        }
     

        $connection->commit();
                         
    } 
    
}
?>