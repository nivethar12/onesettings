<?php
class Usermodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function create($username, $primaryDomain){
		$this->db->insert('accounts', array(
			'username' => $username, 
			'primary_domain' => $primaryDomain,
			'primary_domain' => $primaryDomain,  
			'signup_date' => date("Y-m-d H:i:s", time()),  
   			'last_login'  => date('Y-m-d H:i:s',time()), 
			'createdip' => $_SERVER['REMOTE_ADDR'],
		));
		return $this->db->insert_id();
	}		

	function getAccountByUsername($username,$limit){
		$this->db->where('username', $username);
		return $this->db->get("accounts",$limit)->result();
	}

	function getAccountByPrimaryDomain($tumblrdomain,$limit){
		$this->db->where('primary_domain', $tumblrdomain);
		return $this->db->get("accounts",$limit)->result();
	}	
	
	function getAccountById($id){
		$this->db->where('id', $id);
		return $this->db->get("accounts")->result();
	}
	
	function updateAccount($tumblrDomain,$data){
		$this->db->where('primary_domain', $tumblrDomain);
		$this->db->update('accounts', $data);	
	}
	
}

?>