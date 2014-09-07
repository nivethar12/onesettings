<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller
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
    }
    public function index()
    {
    	$this->session->sess_destroy();
    	redirect("/");
    }
}
