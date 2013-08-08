<?php 

session_start();
class LoginValidation extends CI_Controller
{
	
	public function __construct()
    	{
        // Call the Model constructor
        		parent::__construct();
    	}

	public function index()
		{
    		if ($this->session->userdata('member_id'))
    		{
    			$this->session->set_flashdata('logout', 'You are logged in....Please LOGOUT ');
    			redirect('dashBoard/submit');
    		}

			if($_SERVER['REQUEST_METHOD'] !== 'POST')
				{

					return $this->load->view('formsuccess');
				}
		
				$data['user_name'] = $_POST['user_name'];
				$data['password'] = $_POST['password'];
			
			
				try
				{
					$user = User::check_login($data);
				
				}


				catch(UsersInvalidException $e)
 				{
  				
  					return $this->load->view('formsuccess',array("message"=>$e->getMessage()));
  	
  				}

				catch(UsersPasswordInvalidException $e)
 				{
  				
  					return $this->load->view('formsuccess',array("message"=>$e->getMessage()));

  				}
				
    
    			$this->session->set_userdata( array(
            		'member_id'=>$user->member->id,
            		
        			)
		    	);

        		$this->session->set_flashdata('success', 'Have a nice time .............');

				redirect('dashBoard/submit');
			

			

		}

	public function log_out()
		{
			
			$this->session->sess_destroy();
			redirect('../LoginValidation');
		}
			
}


?>