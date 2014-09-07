<?php
class Promotionsmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insertPromotion($data){
		$this->db->insert("promotions", $data);
	}

	function getRecentPromotion($limit){
		$this->db->order_by("posted_on", "desc"); 
		return $query = $this->db->get('promotions', $limit)->result();
	}

	function deletePromotion($tumblrDomain){
		$this->db->where('tumblr_domain', $tumblrDomain);
		$this->db->delete('promotions');	
	}
	
	function getLatestPromotion($tumblrDomain){
		$this->db->where('tumblr_domain', $tumblrDomain);
		$this->db->order_by("posted_on", "desc"); 
		return $this->db->get('promotions')->result();	
	}
	
}

?>