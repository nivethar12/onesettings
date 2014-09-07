<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('usermodel');
        $this->load->model('creditsmodel');
        $this->load->model('promotionsmodel');
        $this->load->library('creditslib');
        $this->load->library('curl');
    }
    function index()
    {
    	$tumblrDomain = $_POST['tumblr'];
    	
    	if(startsWith($tumblrDomain,"http")){
    		$parse = parse_url($tumblrDomain);
			$tumblrDomain = $parse['host'];
    	}
    	
    	$account  = $this->usermodel->getAccountByPrimaryDomain($tumblrDomain,1);
		if($account){
			//Verify Tracker
			$this->session->set_userdata('accid', $account[0]->id);
			$this->session->set_userdata('tumblrdomain', $account[0]->primary_domain);
			$this->session->set_userdata('usernm', $account[0]->username);
			if($account[0]->tra_verified != "y"){
				$this->session->set_flashdata('showTrackerOnLoad', true);				
			}
    		$this->session->set_flashdata('signIn', true);
			
			redirect("dashboard");
		}else{
			$meta = get_meta_tags("http://$tumblrDomain");
    		if(isset($meta["twitter:site"]) && $meta["twitter:site"] == "tumblr"){
    			if(isset($meta["twitter:title"])){
    				$userName = $meta["twitter:title"];
    				$user_id = $this->userlib->create($userName,$tumblrDomain);
    				$this->creditslib->earnCredits($user_id,$tumblrDomain,50,true);
    				$this->session->set_userdata('accid', $user_id);		
    				$this->session->set_userdata('tumblrdomain', $tumblrDomain);
    				$this->session->set_userdata('usernm', $userName);
    				$this->session->set_flashdata('showTrackerOnLoad', true);
    				$this->session->set_flashdata('newSiteAdd', true);
    				$this->session->set_flashdata('signIn', true);
    				redirect("dashboard");
    			}
    		}else{
    			$data["iserror"] = true;
    			$this->load->view('home',$data);
    		}
		}
    }
}
