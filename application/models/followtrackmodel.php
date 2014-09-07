<?php
class Followtrackmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function insertTrack($data){
		$this->db->insert("follow_track", $data);
	}

	function getTrack($code){
		$this->db->where('code', $code);
		$res = $this->db->get("follow_track")->result();
		if($res){
			return $res[0];
		}else{
			return false;
		}
	}

	function deleteTrack($code){
		$this->db->where('code', $code);
		$this->db->delete("follow_track");
	}
	
	function updateTrack($code,$data){
		$this->db->where('code', $code);
		$this->db->update('follow_track', $data);
	}
}

?>