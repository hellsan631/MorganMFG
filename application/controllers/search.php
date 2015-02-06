<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Search extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'search';
		$data['bodyclass'] = 'about';
		$data['pagetitle'] = 'About Us';
		$data['template'] = 'search/index';
		$this->load->view('templates/home_template', $data);

	}

	
}