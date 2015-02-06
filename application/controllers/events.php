<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'Events';
		$data['bodyclass'] = 'Events';
		$data['pagetitle'] = 'Events';
		$data['template'] = 'events/index';
		$this->load->view('templates/home_template', $data);
	}

}