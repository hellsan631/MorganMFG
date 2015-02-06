<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Turnskey_model extends CI_Model {

	private $table_name	= 'users';
		
	function login($email=null, $password, $user_role=null) {	
		$this->db->where('email', $email);		

		$this->db->where('password', sha1($password));
		$this->db->where('role', $user_role);
		$query=$this->db->from($this->table_name);			
		$query=$this->db->get();

		if ($query->num_rows() > 0) {				
			
			$user_info = $this->db->get_where('users_profile', array('user_id' => $query->row()->id));

			$row = array(
				'id'			=>$query->row()->id,						
				'email'			=>$query->row()->email,
				'fname'			=>$user_info->row()->fname,
				'lname'			=>$user_info->row()->lname,
				'role'			=>$query->row()->role,
				'status'		=>$query->row()->status,
				'last_ip'		=>$query->row()->last_ip,
				'last_login'	=>$query->row()->last_login,				
				'logged_in'		=>TRUE
			);						

			if($query->row()->role == 1)
				$this->session->set_userdata('AdminInfo',$row);
				
			$this->update_login_info($query->row()->id, $record_ip=TRUE, $record_time=TRUE);

			return TRUE;			
		}else{
			$this->session->set_flashdata('error_msg','Invalid username or password.');		
			return FALSE;
		}
	}

	function is_email_available($email)	{
		$this->db->select('1', FALSE);
		$this->db->where('LOWER(email)=', strtolower($email));
		$this->db->or_where('LOWER(new_email)=', strtolower($email));
		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 0;
	}

	function create_user($data, $activated = TRUE) {
		$data['created'] = date('Y-m-d H:i:s');
		$data['activated'] = $activated ? 1 : 0;
		if ($this->db->insert($this->table_name, $data)) {
			$user_id = $this->db->insert_id();
			if ($activated)	$this->create_profile($user_id);
			return array('user_id' => $user_id);
		}
		return NULL;
	}

	function activate_user($user_id, $activation_key, $activate_by_email){
		$this->db->select('1', FALSE);
		$this->db->where('ID', $user_id);
		if ($activate_by_email) {
			$this->db->where('new_email_key', $activation_key);
		} else {
			$this->db->where('new_password_key', $activation_key);
		}
		$this->db->where('activated', 0);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) {
			$this->db->set('activated', 1);
			$this->db->set('new_email_key', NULL);
			$this->db->where('ID', $user_id);
			$this->db->update($this->table_name);

			$this->create_profile($user_id);			
			return TRUE;
		}
		return FALSE;
	}

	function update_login_info($user_id, $record_ip, $record_time) {
		if ($record_ip)		$this->db->set('last_ip', $this->input->ip_address());
		if ($record_time)	$this->db->set('last_login', date('Y-m-d H:i:s'));
		$this->db->where('id', $user_id);
		$this->db->update($this->table_name);
	}

	function ban_user($user_id, $reason = NULL) {
		$this->db->where('ID', $user_id);
		$this->db->update($this->table_name, array(
			'banned'		=> 1,
			'ban_reason'	=> $reason,
		));
	}

	function unban_user($user_id) {
		$this->db->where('ID', $user_id);
		$this->db->update('users', array(
			'banned'		=> 0,
			'ban_reason'	=> NULL,
		));
	}

	function set_password_key($user_id, $new_pass_key) {
		$this->db->set('new_password_key', $new_pass_key);
		$this->db->set('new_password_requested', date('Y-m-d H:i:s'));
		$this->db->where('ID', $user_id);
		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function can_reset_password($user_id, $new_pass_key, $expire_period = 900) {
		$this->db->select('1', FALSE);
		$this->db->where('ID', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >', time() - $expire_period);
		$query = $this->db->get($this->table_name);
		return $query->num_rows() == 1;
	}

	function reset_password($user_id, $new_pass, $new_pass_key, $expire_period = 900) {
		$this->db->set('password', $new_pass);
		$this->db->set('new_password_key', NULL);
		$this->db->set('new_password_requested', NULL);
		$this->db->where('ID', $user_id);
		$this->db->where('new_password_key', $new_pass_key);
		$this->db->where('UNIX_TIMESTAMP(new_password_requested) >=', time() - $expire_period);
		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function change_password($user_id, $new_pass) {
		$this->db->set('password', $new_pass);
		$this->db->where('ID', $user_id);
		$this->db->update($this->table_name);
		return $this->db->affected_rows() > 0;
	}

	function delete_user($user_id) {
		$this->db->where('ID', $user_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) {
			$this->delete_profile($user_id);
			return TRUE;
		}
		return FALSE;
	}
}