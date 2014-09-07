<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class track extends CI_Controller {
	
    public function __construct()
    {
    	parent::__construct();
        $this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->model('followtrackmodel');
    }		
	
	public function index()
	{
		if(!isset($_GET["blog"])){
			exit();
		}
		$blog = $_GET["blog"];
		$accountDetails = $this->usermodel->getAccountByPrimaryDomain($blog,1);
		if($accountDetails){
			$usernm = $this->session->userdata('usernm');
			$toFollow = $accountDetails[0]->username;
			$key = md5($usernm ."_randhack_" . $toFollow);
			$this->followtrackmodel->deleteTrack($key);
			$this->followtrackmodel->insertTrack(array(
						"code"=>$key,
						"from"=>$usernm,
						"domain"=>$toFollow,
						"status"=>"p",
						"updated_on"=>date('Y-m-d H:i:s',time()) 
					));
			$cookie = array(
	    		'name'   => "fof_" . $key,
	    		'value'  => $toFollow,
	    		'expire' => '60'
			);
			$this->input->set_cookie($cookie);
			redirect("http://www.tumblr.com/follow/". $toFollow);
		}else{
			echo "Blog Not Found In accounts";
		}
	}
	
	public function confirm()
	{
		if(isset($_GET["domain"]) && isset($_GET["domain"])){
			$code  = $_GET["code"];
			$domain =  $_GET["domain"];
			$this->followtrackmodel->updateTrack($code, array(
						"status"=>"s",
						"updated_on"=>date('Y-m-d H:i:s',time()) 
			));	
		}
		header('Content-Type: image/gif');
		echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
	}
}
