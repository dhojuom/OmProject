<?php

class  SessionController extends CI_Controller
{
	public function __construct()
    	{	
    		parent::__construct();
    		


    		$this->data = array();
        	$member_id = $this->session->userdata('member_id');
        	if(!$member_id)
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

        	$this->data['current_member'] = $this->member;
			$this->data['current_organization'] = $this->member->organization;
    	}

    	public function check_my_session() {
	
			if (!$this->session->userdata('member_id'))
	    	{
	    		$this->session->set_flashdata('logout', 'You are logged in....Please LOGOUT ');
	    		redirect('loginValidation');
	    	}
		}  


	public function view_page($path,$data=array())
		{

			$this->data['message']= array_key_exists('message', $data) ? $data['message']:null;
			$this->data['enrollments']= array_key_exists('enrollments', $data) ? $data['enrollments'] : null;

			$this->load->view($path,$this->data);
		}

}


class NonSessionController extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->data= array();
	}

	public function check_session()
	{
		if ($this->session->userdata('member_id'))
    	{
    		$this->session->set_flashdata('logout', 'You are logged in....Please LOGOUT ');
    		redirect('dashBoard');
    	}
    	return;
	}

	public function load_view($path,$data=array())
		{

			$this->data['message']= array_key_exists('message', $data) ? $data['message']:null;
			$this->load->view($path,$this->data);
		}



}
?>
