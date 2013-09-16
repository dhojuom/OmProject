<?php 

class LoginValidation extends NonSessionController
{
	
	public function __construct()
    	{
        // Call the Model constructor
       		parent::__construct();
    	}

	public function index()
		{
    		$this->check_session();

    		
			$organizations = Organization::finder();

			if($_SERVER['REQUEST_METHOD'] !== 'POST')
				{
					
					/*return $this->load_view('signup',array("organizations"=>$organizations));*/
					redirect('signup');
				}
		
				$data['user_name'] = $_POST['user_name'];
				$data['password'] = $_POST['password'];
			
			
				try
				{
					$user = User::check_login($data);
				
				}


				catch(UsersInvalidException $e)
 				{
  				
  					return $this->load_view('formsuccess',array("message"=>$e->getMessage()));
  	
  				}

				catch(UsersPasswordInvalidException $e)
 				{
  				
  					return $this->load_view('formsuccess',array("message"=>$e->getMessage()));

  				}


    			$this->session->set_userdata( array(
            		'member_id'=>$user->member->id,
            		
        			)
		    	);

		    	/*echo $this->input->cookie('user_organization');
		    	echo $user->member->organization->name;
		    	exit();*/
				
    			if(!$this->input->cookie('user_organization') || $user->member->organization->name != $this->input->cookie('user_organization'))
    			{
    				$cookie = array(
    					'name'   => 'user_organization',
    					'value'  => $user->member->organization->name,
    					'expire' => '0',
						);
  					$this->input->set_cookie($cookie);
  					$this->session->set_flashdata('success', 'Have a nice time .............');
  				}

  				else {

  					$organization_name = $this->input->cookie('user_organization');
  					$this->session->set_flashdata('success','welcome to '. $organization_name);
  				}

  				


    			
        		

				redirect('dashBoard');


		}

	public function log_out()
		{			
			$this->session->sess_destroy();
			redirect('../signup');
		}
			
}


?>