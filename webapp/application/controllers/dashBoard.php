<?php 
session_start();
	
	class DashBoard extends CI_Controller
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

    	}

		public function submit()
		{	
			$this->load->view('dashboard',array("member"=>$this->member));
		}

		
	}	
?>