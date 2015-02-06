<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'services';
		$data['pagetitle'] = 'Services';		
		$data['content'] = $this->admin_model->get_result('services',NULL,NULL, array('field'=>'order', 'order'=>'asc') );
		$data['template'] = 'services/index';
		$this->load->view('templates/home_template', $data);
	}	

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['services']=$this->admin_model->get_pagination_result('services', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'services/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('services', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'services/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function add(){
		 if(admin_login_in()===FALSE)
			redirect('login');		
		// $this->form_validation->set_rules('heading', 'heading', 'required');						
		$this->form_validation->set_rules('description', 'description', 'required');					
		$this->form_validation->set_rules('order', 'order', 'required');					

		if ($this->form_validation->run() == TRUE){			
			$data=array(								
				'heading'=>$this->input->post('heading'),							
				'description'=>$this->input->post('description'),				
				'order'=>$this->input->post('order'),				
				'author'=>$this->input->post('author'),				
				'btn_txt'=>$this->input->post('btn_txt'),				
				'btn_url'=>$this->input->post('btn_url'),				
				'image_align'=>$this->input->post('align'),											
				'created' => date('Y-m-d H:i:s')		
			);				
						
				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/services/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload()){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('services/add');
					}else{
					   $upload_data = $this->upload->data();	
					   $data['image']=$upload_data['file_name'];
					   create_thumb($data['image'], './assets/uploads/services/');
					}
				}else{
					$this->session->set_flashdata('error_msg', 'Please select an image to upload');
					redirect('services/add');
				}

			

			$sectionid = $this->admin_model->insert('services',$data);		
			$this->session->set_flashdata('success_msg',"Content has been added successfully.");
			redirect('services/all');

		}		
		$data['template'] = 'services/add';
        $this->load->view('templates/admin_template', $data);		

	}

	public function edit($id=""){

		if(admin_login_in()===FALSE)

			redirect('login');

		// $this->form_validation->set_rules('heading', 'heading', 'required');						
		$this->form_validation->set_rules('description', 'description', 'required');					
		$this->form_validation->set_rules('order', 'order', 'required');										
		$data['section'] = $this->admin_model->get_row('services', array('id'=>$id));

		if (empty($data['section'])) {
			$this->session->set_flashdata('error_msg',"No Content found.");
			redirect('services/all');
		}

		if ($this->form_validation->run() == TRUE){			

			$updatedata=array(
				'heading'=>$this->input->post('heading'),							
				'description'=>$this->input->post('description'),				
				'order'=>$this->input->post('order'),				
				'author'=>$this->input->post('author'),				
				'btn_txt'=>$this->input->post('btn_txt'),				
				'btn_url'=>$this->input->post('btn_url'),				
				'image_align'=>$this->input->post('align'),															
			);

			
				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/services/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload()){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('services/edit/'.$id);
					}else{
					   delete_image($data['section']->image, './assets/uploads/services/');
					   $upload_data = $this->upload->data();			
					   // print_r($upload_data); die();
					   $updatedata['image'] = $upload_data['file_name'];
					   create_thumb($updatedata['image'], './assets/uploads/services/');
					}
				}
		

			$this->admin_model->update('services',$updatedata, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Content has been updated successfully.");
			redirect('services/all');
		}		
		$data['template'] = 'services/edit';
        $this->load->view('templates/admin_template', $data);		
	}


	public function delete($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		if($id=="")
			redirect('services/all');

		$data = $this->admin_model->get_row('services', array('id'=>$id));
		delete_image($data->image, './assets/uploads/services/');
		$this->admin_model->delete('services', array('id'=>$id));	
		$this->session->set_flashdata('success_msg',"Content has been delete successfully.");
			redirect('services/all');
	}

}