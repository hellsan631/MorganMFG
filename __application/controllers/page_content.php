<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_content extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function all($offset=0){	
		if(admin_login_in()===FALSE)
			redirect('login');

		$data['template'] = 'page_content/all';
        $this->load->view('templates/admin_template', $data);			
	}

	public function update_home_subheadings(){

		if(admin_login_in()===FALSE)
			redirect('login');

		$slug = 'home_subheadings';

		$this->form_validation->set_rules('home_blog_subheading', 'subheading', 'required');		
		$this->form_validation->set_rules('home_mention_subheading', 'subheading', 'required');
		
		$data['page_content'] = $this->admin_model->get_row('page_content', array('slug'=>$slug));
		
		if ($this->form_validation->run() == TRUE){			
			$updatedata=array(
				'home_blog_subheading'=>$this->input->post('home_blog_subheading'),
				'home_mention_subheading'=>$this->input->post('home_mention_subheading'),
				'updated'=>date("Y-m-d H:i:s")				
			);

			$this->admin_model->update('page_content',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"Headers has been updated successfully.");
			redirect('page_content/all');

		}		

		$data['template'] = 'page_content/update_home_subheadings';
        $this->load->view('templates/admin_template', $data);		
    }

    public function update_contact_address(){

		if(admin_login_in()===FALSE)
			redirect('login');

		$slug = 'contact_address';

		$this->form_validation->set_rules('contact_address', 'Address', 'required');		
		$this->form_validation->set_rules('contact_email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('contact_phone', 'phone', 'required');
		$this->form_validation->set_rules('contact_heading', 'heading', 'required');
		
		$data['page_content'] = $this->admin_model->get_row('page_content', array('slug'=>$slug));
		
		if ($this->form_validation->run() == TRUE){			
			$updatedata=array(
				'contact_address'=>$this->input->post('contact_address'),
				'contact_email'=>$this->input->post('contact_email'),
				'contact_phone'=>$this->input->post('contact_phone'),
				'contact_heading'=>$this->input->post('contact_heading'),
				'updated'=>date("Y-m-d H:i:s")				
			);

			$this->admin_model->update('page_content',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"Address has been updated successfully.");
			redirect('page_content/all');

		}		

		$data['template'] = 'page_content/update_contact_address';
        $this->load->view('templates/admin_template', $data);		
    }
}