<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller{
	
	/**
	 * Constructor
	 */
    public function __construct(){
    	parent::__construct();
        $this->load->library('session');
        $this->load->helper('email_helper');
        $this->load->model('usermodel');
        $this->load->model('creditsmodel');
        $this->load->model('promotionsmodel');
        $this->load->library('creditslib');
        $this->load->library('tumblrlib');
        $this->load->library('userlib');
    }
	
	public function index(){
		$reqToken = $this->tumblrlib->getRequestToken();
		$this->session->set_userdata('request_token', $reqToken["request_token"]);
		$this->session->set_userdata('request_token_secret', $reqToken["request_token_secret"]);
		redirect($reqToken["redirect_url"]);
	}
    
	public function success(){
		$requestToken = $this->session->userdata('request_token');
		$requestTokenSecret = $this->session->userdata('request_token_secret');
		$this->tumblrlib->setRequestToken($requestToken,$requestTokenSecret);
		$access_token = $this->tumblrlib->getAccessToken($_GET['oauth_verifier']);
		$this->session->set_userdata('oauth_token', $access_token["oauth_token"]);
		$this->session->set_userdata('oauth_token_secret', $access_token["oauth_token_secret"]);

		$this->tumblrlib->setRequestToken($access_token["oauth_token"],$access_token["oauth_token_secret"]);				
		$tumbRes = $this->tumblrlib->get("http://api.tumblr.com/v2/user/info");
		$userName = $tumbRes->response->user->name;		
		$account  = $this->usermodel->getAccountByUsername($userName,1);
		if($account){
			$this->session->set_userdata('accid', $account[0]->id);
			$this->session->set_userdata('tumblrdomain', $account[0]->primary_domain);
			redirect("dashboard");
		}else{
			redirect("signup/done");
		}
	}	
    
	function done(){
		$oauthToken = $this->session->userdata('oauth_token');
		$oauthTokenSecret = $this->session->userdata('oauth_token_secret');
		if(!$oauthToken && !$oauthTokenSecret){
			redirect("/");
		}
		
		$data['email'] = "";
		$data['password'] = "";
		
		if(isset($_POST["email"]) || isset($_POST["password"])){
			$email = isset($_POST["email"])?$_POST["email"]:"";
			$password = isset($_POST["password"])?$_POST["password"]:"";
			$data['email'] = $email;
			$data['password'] = $password;
			$isError = false;
			if(!isset($email) || trim($email) == ""){
				$data['sign_up_email_error'] = "The email address is required and can't be empty";
				$isError = true;
			}else if(!valid_email($email)){
				$data['sign_up_email_error'] = "The email address should be valid one";
				$isError = true;
			}
			
			
			if(!isset($password) || trim($password) == ""){
				$data['sign_up_password_error'] = "The password is required and can't be empty";
				$isError = true;
			}else if(strlen($password) < 8){
				$data['sign_up_password_error'] = "The password should be atleast 8 char long";
				$isError = true;
			}
			$data['password'] = $password;			
			
			if(!$isError){
				$this->tumblrlib->setRequestToken($oauthToken,$oauthTokenSecret);				
				$tumbRes = $this->tumblrlib->get("http://api.tumblr.com/v2/user/info");
				
				$userName = $tumbRes->response->user->name;
				$primaryDomain =  null;
				if(isset($tumbRes->response->user->blogs[0])){
					$primaryDomain = $tumbRes->response->user->blogs[0]->url;
					$primaryDomain = str_ireplace("http://", "", $primaryDomain);
					$primaryDomain = str_ireplace("/", "", $primaryDomain);
				}
				$user_id = $this->userlib->create($userName, $email, $password,$oauthToken,$oauthTokenSecret,$primaryDomain);
				$this->session->set_userdata('accid', $user_id);
				$this->session->set_userdata('tumblrdomain', $primaryDomain);
				$this->creditslib->earnCredits($user_id,$primaryDomain,50,true);
				redirect("dashboard");
				//echo $user_id;
			}
	
		}else{
			
		}
		
		$this->load->view('updateemail', isset($data) ? $data : NULL);
	}
	

	private function getFollowers(){
		$oauthToken = $this->session->userdata('oauth_token');
		$oauthTokenSecret = $this->session->userdata('oauth_token_secret');		
		$this->tumblrlib->setRequestToken($oauthToken,$oauthTokenSecret);				
		$tumbRes = $this->tumblrlib->get("http://api.tumblr.com/v2/blog/india.tumblr.com/followers");	
		var_dump($tumbRes);
	}
	
	
	private function username_check($username)
	{
		return $this->user->get_by_username($username) ? TRUE : FALSE;
	}
	
	private function email_check($email){
		return $this->user->get_by_email($email) ? TRUE : FALSE;
	}
}
