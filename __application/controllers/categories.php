<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(admin_login_in()===FALSE)
			redirect('login');
		$this->load->model('admin_model');
	}
	


	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['categories']=$this->admin_model->get_pagination_result('categories', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'categories/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('categories', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'categories/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function add(){
		 if(admin_login_in()===FALSE)
			redirect('login');
		$this->form_validation->set_rules('name', 'Category name', 'required');							
		// $this->form_validation->set_rules('type', 'type', 'required');							
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'name'=>$this->input->post('name'),
				'slug' => create_slug('categories', $this->input->post('name')),							
				'type'=>$this->input->post('type'),								
				'created' => date('Y-m-d H:i:s')		
			);			
			
			$this->admin_model->insert('categories',$data);		
			$this->session->set_flashdata('success_msg',"Category has been added successfully.");
			redirect('categories/all');
		}

		$data['template'] = 'categories/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug = ""){
		if($slug == "")
			redirect('categories/all');

		 if(admin_login_in()===FALSE)
			redirect('login');

		$data['category'] = $this->admin_model->get_row('categories', array('slug'=>$slug));
		$this->form_validation->set_rules('name', 'Category name', 'required');							
		// $this->form_validation->set_rules('type', 'type', 'required');							
		if ($this->form_validation->run() == TRUE){			
			$update=array(
				'name'=>$this->input->post('name'),
				'slug' => create_slug_for_update('categories', $this->input->post('name'), $data['category']->id),							
				// 'type'=>$this->input->post('type'),								
				'created' => date('Y-m-d H:i:s')		
			);			
			
			$this->admin_model->update('categories',$update, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg',"Category has been updated successfully.");
			redirect('categories/all');
		}

		$data['template'] = 'categories/edit';
        $this->load->view('templates/admin_template', $data);		
	}


	public function delete($slug=""){
		if($slug == "")
			redirect('categories/all');

		 if(admin_login_in()===FALSE)
			redirect('login');

		$this->admin_model->delete('categories', array('slug'=>$slug));
		$this->session->set_flashdata('success_msg',"Category has been deleted successfully.");
			redirect('categories/all');
	}
}