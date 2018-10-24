<?php if ( ! defined('BASEPATH')) 
     exit('No direct script access allowed');

class Usernew extends CI_Controller {

   function __construct() {
	   
	   parent::__construct ();
	   $this->load->library ( 'session' );
	   $this->load->library ( 'form_validation' );
	    $this->load->library('upload');
		$this->load->model ( 'User_model' );
		$this->load->helper('url');
		$this->load->helper ( array (
				'form',
				'url' 
		) );
		
   }
	public function index()
	{
	              
		if ($this->session->userdata ( 'email' ) != "") {
			$data ['us'] = $this->User_model->fetch_res ();
			
			$this->load->view ( 'disp', $data );
		} else {
			
			$this->load->view ( 'headlinks' );
		}
		
	}
	public function registration(){
		$data  = array();
		echo base_url();
		
		if (isset ( $_POST ['registration'] ) && $_POST ['registration'] == "Submit") {
			
			//echo $_SERVER['DOCUMENT_ROOT']."/newcode/upload/";
			$config=array();
			$this->form_validation->set_rules ( 'email', 'email', 'required' );
			$this->form_validation->set_rules ( 'password', 'password', 'required' );
			$this->form_validation->set_rules('ufile','ufile');
			$config['upload_path'] = UPLOADS;
            $config['allowed_types'] = 'gif|jpeg|jpg|png';
			$config['file_name']    = base64_encode("" . mt_rand());
            $config['max_size']	= '10000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
			$this->upload->initialize($config);
			                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('ufile'))
                {
                        $data = array('error' => $this->upload->display_errors());
						
                        
                }
                else
                {
					
                        $data = array('upload_data' => $this->upload->data());
                        print_r($data);
                }

			/*
            $this->upload->initialize($config);
            $this->upload->do_upload($config['upload_path']);*/
			$this->User_model->insert_user($data);
			
		}
		
		$this->load->view ( 'registration', $data);
		
		
		}
	public function disp() {
	        if ($this->session->userdata ( 'email' ) != "") 
			{
		         $data ['us'] = $this->User_model->fetch_res ();
		          $this->load->view ( 'disp', $data );
                     $this->User_model->fetch_res();
	
	   		}
			else{
				
				redirect ( 'usernew/login', 'refresh' );
				
				
				}
	}
	
	public function edit_user($user_id) {
	    $row = $this->User_model->get_user_info($user_id);
		
		//echo $_SERVER['DOCUMENT_ROOT']."/newcode/uploads/";
		if($this->input->post( 'submit' ) == "update")
		{
			$email = $this->input->post ( 'email' );
			$password = $this->input->post ( 'password' );
			$this->form_validation->set_rules('ufile','ufile');
		 
			$config['upload_path'] = UPLOADS;
            $config['allowed_types'] = 'gif|jpeg|jpg|png';
			$config['file_name']    = base64_encode("" . mt_rand());
            $config['max_size']	= '10000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
			$this->upload->initialize($config);
			
			$this->load->library('upload', $config);
			$upload_status = $this->upload->do_upload('ufile');
			if ( !$upload_status )
            {
                $data = array('error' => $this->upload->display_errors());
            }
				
				if($upload_status) {
					   
                        $data = array('upload_data' => $this->upload->data());
                       if($data['upload_data']['file_name'] != "" && $row['ufile'] != "") {
						  unlink(dirname(BASEPATH) . "/application/uploads/".$row['ufile']);
						}
					   
                }
          
	    	  $this->User_model->update_user($email, $password,$user_id,$data);
		
              redirect ( 'usernew/disp', 'refresh' );
	                         
		}
													  
													  
						$this->load->view('edit_user', $row);
	                   
					   }
	public function delete_user($user_id){
		 if(file_exists($user_id)){
            
        }
		$this->User_model->delete_user_by_id($user_id);
		unlink(base_url('./application/uploads/)'.$ufile));
		redirect ( 'usernew/disp', 'refresh' );
		
		}
	public function login() {
		$data = array ();
		if ($this->input->post ( 'email' ) != "" && $this->input->post ( 'password' ) != "") {
			
			if ($this->User_model->login_user () > 0) {
				$email = '';
				$password = '';
				
				if (isset ( $_POST ['email'] )) {
					
					$email = $_POST ['email'];
				}
				if (isset ( $_POST ['password'] )) {
					
					$password = $_POST ['password'];
				}
				$newdata = array (
						'email' => $email,
						'logged_in' => TRUE 
				);
				
				
				$this->session->set_userdata ( $newdata );
				
				redirect ( 'usernew/disp', 'refresh' );
			} else {
				$data ['error_message'] = "Login Failed";
			}
		}
		
		$this->load->view ( 'login',$data);
	}
	
	public function logout() {
		$this->session->sess_destroy ();
		redirect ( 'usernew/login', 'refresh' );
	}
		
	
}

