<?php

class  SessionController extends CI_Controller
{
	public function __construct()
    	{	
    		parent::__construct();
    		


    		$this->data = array();

        	// Call the Model constructor
        	

        	$member_id = $this->session->userdata('member_id');
			$this->member = Member::find_by_id($member_id);
			$this->data['current_member'] = $this->member;
			$this->data['current_organization'] = $this->member->organization;

			if(!$member_id)
        		{

        			$this->session->set_flashdata('error', 'Please Login to go to dashboard');

        			redirect('loginValidation');
        		}


        		if (!$this->member)
        		{
        			$this->session->set_flashdata('error', 'Member not found');
        			redirect('loginValidation');
        		}
    	}

    


	public function view_page($path,$data=array())
		{

			/*$data['current_member'] = $this->member;
			$data['current_org'] = $this->member->organisation;*/
			//$this->data['course'] = $data['courses'];
			$this->data['message']= array_key_exists('message', $data) ? $data['message']:null;
			$this->data['enrollments']= array_key_exists('enrollments', $data) ? $data['enrollments'] : null;

			return $this->load->view($path,$this->data);
		}

}


class NonSessionController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_session()
	{
		if ($this->session->userdata('member_id'))
    	{
    		$this->session->set_flashdata('logout', 'You are logged in....Please LOGOUT to signup');
    		redirect('dashBoard/submit');
    	}
	}

	public function view_page()
	{

	}



}
?>
