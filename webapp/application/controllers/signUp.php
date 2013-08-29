<?php

	class SignUp extends NonSessionController
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
			return $this->load->view('signup',array("organizations"=>$organizations));
			}
			
			$data['first_name'] = $_POST['first_name'];
			$data['last_name'] = $_POST['last_name'];
			$data_user['user_name'] = $_POST['user_name'];
			$data_user['password'] = $_POST['password'];
			$data['email'] = $_POST['email'];
			$data['phone_number'] = $_POST['phone_number'];
			$data['address']= $_POST['address'];
			$data['organization_id']= $_POST['organization'];
			$data['organization']=Organization::find_by_id($data['organization_id']);
			



			try
			{
			$member = Member::create($data);
			$user = User::create($data_user);
			$member->save();
			//$member->organization->save_member_count();
			$user->member = $member;
			$user->save();
			}

			catch(UserNameBlankException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch(FirstNameBlankException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch(LastNameBlankException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}			

			catch(EmailBlankException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch(UnknownClassInstanceException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch(UserNameBlankException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch(PasswordBlankException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch (UserNameExistException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}

			catch (InactiveException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}
			catch (InvalidModelException $e)
			{
				return $this->load->view('signup',array("message"=>$e->getMessage(),"organizations"=>$organizations));
			}
			
			$this->session->set_userdata( array('member_id'=>$member->id,));


		
			redirect('dashBoard/submit');
		

		}


	}
?>