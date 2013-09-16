<?php

class OrganizationSignup extends CI_Controller
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
			return $this->load->view('organization_form');
		}		
	
		$data['name']= $_POST['name'];
		$data['email']= $_POST['email'];
		$data['location']=$_POST['location'];
		$data['phone_number']=$_POST['phone_number'];
		$data['registration_number']=$_POST['registration_number'];
	
	try
	{
			
		$organization = Organization::create($data);
			
	}

	catch(NameBlankException $e)
	{
		return $this->load->view('Organization_form',array("message"=>$e->getMessage()));

	}

	catch(EmailBlankException $e)
	{
		return $this->load->view('Organization_form',array("message"=>$e->getMessage()));

	}
	catch(PhoneNumberBlankException $e)
	{
		return $this->load->view('Organization_form',array("message"=>$e->getMessage()));

	}
	catch(LocationBlankException $e)
	{
		return $this->load->view('Organization_form',array("message"=>$e->getMessage()));

	}
	catch(RegistrationBlankException $e)
	{
		return $this->load->view('Organization_form',array("message"=>$e->getMessage()));

	}

	
	

	if(!$organization)
	{
		$this->session->set_flashdata('create_problem','Organization creation is unsuccessfull');
		redirect('OrganizationSignup');
	}

	$organizations= Organization::all();

	return $this->load->view('organization',array('organizations'=>$organizations,'organization'=>$organization));
	}


	public function view_members($organization_id)
	{
		//$members= Member::find('all',array('conditions'=>array('organization_id = ?',$organization_id)));
		$organization= Organization::find_by_id($organization_id);
		return $this->load->view('members',array('organization'=>$organization));
		
		/*foreach ($organization->members as $member)
		{
			echo $member->first_name." ".$member->last_name;
			echo "\n";
		}*/
	}

	public function view_organizations()
	{
		$organizations = Organization::all();
		return $this->load->view('organization',array('organizations'=>$organizations));
	}

	
}

?>