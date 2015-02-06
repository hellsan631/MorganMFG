<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Appointments extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}


	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['appointments']=$this->admin_model->get_pagination_result('appointment', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'appointments/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('appointment', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'appointments/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function view($id=''){
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('appointments/all');

		$data['detail'] = $this->admin_model->get_row('appointment', array('id'=>$id));
		$data['template'] = 'appointments/view';
        $this->load->view('templates/admin_template', $data);			
	}

	public function delete($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('appointments/all');

		$this->admin_model->delete('appointment', array('id'=>$id));		
		$this->session->set_flashdata('success_msg','successfully Deleted');
			redirect('appointments/all');
	}
}