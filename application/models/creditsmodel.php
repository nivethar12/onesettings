<?php
class Creditsmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insertCredits($data){
		$this->db->insert("credits", $data);
	}

	function getCredits($accountId){
		$this->db->where('account_id', $accountId);
		return $this->db->get("credits")->result();
	}

	function updateCredits($accountId,$data){
		$this->db->where('account_id', $accountId);
		$this->db->update('credits', $data);
	}

	function getTopUsersDaily($limit){
		$this->db->order_by("today", "desc");		
		return $this->db->get("credits",$limit)->result();
	}

	function getTopUsersWeekly($limit){
		$this->db->order_by("week", "desc");		
		return $this->db->get("credits",$limit)->result();
	}
	

}

?>