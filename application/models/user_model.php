<?php
class User_model extends CI_Model {
	function __construct() {
		// Call the Model constructor
		parent::__construct ();
		$this->load->helper ( 'url' );
		$this->load->helper ( array (
				'form',
				'url' 
		) );
		$this->load->database ();
	}
	function insert_user($data) {
		$data = array (
				'email' => $this->input->post ( 'email' ),
				'password' => $this->input->post ( 'password' ) ,
				'ufile'=>$data['upload_data']['file_name']
				
		);
		
		$this->db->insert( 'users', $data );
	}
	function login_user() {
		$this->db->select ( 'email,password' );
		$this->db->where ( 'email', ( string ) $this->input->post ( 'email' ) );
		$this->db->where ( 'password', ( string ) $this->input->post ( 'password' ) );
		$str = $this->db->get ( 'users' );
		
		return $str->num_rows ();
	}
	function fetch_res() {
		$rows = array();
		$query = $this->db->get ( 'users' );
		
		foreach ( $query->result() as $row ) {
			$rows[] = $row;
		
		}
		
		return $rows;
	}
	function delete_user_by_id($user_id) {
		$this->db->query('DELETE FROM users WHERE id = "'.$user_id.'"');
		
	}
	function get_user_info($user_id) {
		$query = $this->db->query('SELECT * FROM users WHERE id = '.$user_id);
		
		foreach ($query->result_array() as $row)
		{
			
		}
		
		return $row;
	}
	function update_user($email, $password, $user_id,$data) {
		$this->db->query('UPDATE users set email = "'.$email.'", password = "'.$password.'",ufile="'.$data['upload_data']['file_name'].'" WHERE id = "'.$user_id.'"');
	}
	
}
?>