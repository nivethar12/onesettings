<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller {
    public function __construct()
    {
    	parent::__construct();
    }
    	
    
	public function index()
	{
		$this->load->view('dashboard',$data);
		/*
		$accId= $this->session->userdata('accid');
		if(!$accId){
			redirect("/");
		}			
		echo "Hello World";
		$tumblrDomain = $this->session->userdata('tumblrdomain');
		*/
	}

}
