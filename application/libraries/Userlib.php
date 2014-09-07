<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

//require_once('libs/phpass-0.2/PasswordHash.php');


class Userlib{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('oauth');
        $this->CI->load->helper('string');
        
		$this->CI->load->model('usermodel');
        $this->CI->load->model('promotionsmodel');
    }

	function create($username,$primaryDomain){
		$account_insert_id = $this->CI->usermodel->create($username,$primaryDomain);		
		return $account_insert_id;
	}	

	function verifyTracker($primaryDomain,$isSuccess){
		$update =  array();
		$update["tra_verified_on"] = date("Y-m-d H:i:s", time());
		if($isSuccess){
			$update["tra_verified"] = "y";		
		}else{
			$update["tra_verified"] = "n";
		}
		$this->CI->usermodel->updateAccount($primaryDomain,$update);		
	}	
	
}