<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myaccount extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'myaccount';
		$data['pagetitle'] = 'My Account';

		$data['template'] = 'myaccount/index';
		$this->load->view('templates/home_template', $data);
	}
}