<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	public function index()
	{
		$tumblrDomain = $this->session->userdata('tumblrdomain');
		if($tumblrDomain){
			redirect("/dashboard");
		}	
		$data["recentPromotions"] = $this->promotionsmodel->getRecentPromotion(48);
		$this->load->view('home1',$data);
	}
}
