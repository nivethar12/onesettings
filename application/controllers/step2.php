<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class step2 extends CI_Controller {
	private function index()
	{
		$this->load->view('updateemail');
	}
}
