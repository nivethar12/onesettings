<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tracker extends CI_Controller {

	public function verify()
	{
		$tumblrdomain = $_POST["tumblrdomain"];
		if(!isset($tumblrdomain)){
			echo  "unverified";
			exit();
		}
		$this->load->library('curl');
		$res = $this->curl->simple_get("http://$tumblrdomain/");
		if (strpos($res,'http://t.followersfactory.com/tracker.js') !== false) {
    		$this->userlib->verifyTracker($tumblrdomain,true);
			echo 'verified';
		}else{
    		$this->userlib->verifyTracker($tumblrdomain,false);
			echo 'unverified';
		}
	}
	
}



