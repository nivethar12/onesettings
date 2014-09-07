<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class follow extends CI_Controller {
	
    public function __construct()
    {
    	parent::__construct();
        $this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->model('followtrackmodel');
    }		
	
    private function getDateDiffFromNow($oldDateStr){
		$dateOld = new DateTime($oldDateStr);
		$date = new DateTime();
		$diff=date_diff($dateOld,$date);
		return ($diff->s * 1) + ($diff->i * 60) + ($diff->h * 60 * 60) + ($diff->d * 60 * 60 * 24) + ($diff->m  * 60 * 60 * 24 * 30);     
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
			$res = $this->followtrackmodel->getTrack($key);
			if($res && $res->status == "s"){
				$this->load->view('alreadyfollowing',$data);
			}else{
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
			}
		}else{
			echo "Blog Not Found In accounts";
		}
	}
	
	public function check(){
		if(!isset($_GET["blog"])){
			echo "NO";
			exit();
		}
		$blog = $_GET["blog"];
		$accountDetails = $this->usermodel->getAccountByPrimaryDomain($blog,1);
		if($accountDetails){
			$usernm = $this->session->userdata('usernm');
			$toFollow = $accountDetails[0]->username;
			$key = md5($usernm ."_randhack_" . $toFollow);
			$res = $this->followtrackmodel->getTrack($key);
			if($res){
				if($res->status == "s"){
					$timeDiff = $this->getDateDiffFromNow($res->updated_on);
    				$tumblrDomain = $this->session->userdata('tumblrdomain');
					$accId= $this->session->userdata('accid');
					$accId = intval($accId);	    	
    				$credits = $this->creditslib->earnCredits($accId,$tumblrDomain,3,true);
					echo "SUCCESS";
					exit();
				}else{
					echo "PROGRESS";
					exit();
				}		
			}
		}else{
			echo "NO";
			exit();
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
