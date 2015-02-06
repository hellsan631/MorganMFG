<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_inquiry extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function submit_event_inquiry()
	{
		// $data['menuactive'] = 'contactus';
		// $data['pagetitle'] = 'Contact Us';

		if(isset($_POST))
		{	
			$data=array(
						'first_name'=>$this->input->post('event_first_name'),								
						'last_name'=>$this->input->post('event_last_name'),								
						'email'=>$this->input->post('event_email'),							
						'phone'=>$this->input->post('event_phone'),							
						'created' => date('Y-m-d h:i:s'),		
					  );		

			$this->admin_model->insert('event_inquiry', $data);
			echo "ok";
		}
	}


	public function all($offset=0)
	{		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['event_inquiry']=$this->admin_model->get_pagination_result('event_inquiry', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'event_inquiry/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('event_inquiry', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'event_inquiry/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	// public function view($id=''){
	// 	if(admin_login_in()===FALSE)
	// 		redirect('login');
	// 	if($id == "")
	// 		redirect('contactus/all');

	// 	$data['detail'] = $this->admin_model->get_row('contact_us', array('id'=>$id));
	// 	$data['template'] = 'contactus/view';
 //        $this->load->view('templates/admin_template', $data);			
	// }

	public function delete($id="")
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('event_inquiry/all');

		$this->admin_model->delete('event_inquiry', array('id'=>$id));		
		$this->session->set_flashdata('success_msg','successfully Deleted');
			redirect('event_inquiry/all');
	}
}