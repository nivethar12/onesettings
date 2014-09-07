<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ref extends CI_Controller {
	public function index(){
		if(isset($_GET["url"])){
			$url = $_GET["url"];
			$parse = parse_url($url);;
			if(isset($parse['host'])){
				$this->load->helper('cookie');
				$cookie = array(
		    		'name'   => "covuurl",
		    		'value'  => $url,
		    		'expire' => '30'
				);
				$this->input->set_cookie($cookie);
				$cookie = array(
		    		'name'   => "covudomain",
		    		'value'  => $parse['host'],
		    		'expire' => '30'
				);
				$this->input->set_cookie($cookie);								
				redirect("/");
			}else{
				redirect("/");
			}
		}else{
			redirect("/");
		}
	}
}
