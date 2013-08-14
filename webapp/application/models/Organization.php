<?php
class NameBlankException extends Exception{}
//class EmailBlankException extends Exception{}
class LocationBlankException extends Exception{}
class PhoneNumberBlankException extends Exception{}
class RegistrationBlankException extends Exception{}


class Organization extends ActiveRecord\Model
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

    public function finder()
    {
    	$organizations = Organization::find('all');
    	return $organizations;
    }

	public static  function create($form_data)
	{

		$organization= new Organization();
		$organization->name= $form_data['name'];
		$organization->registration_number= $form_data['registration_number'];
		$organization->location= $form_data['location'];
		$organization->phone_number= $form_data['phone_number'];
		$organization->email= $form_data['email'];


		$organization->save();
		return $organization;



	}
}
?>