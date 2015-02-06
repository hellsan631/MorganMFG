<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}
	

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['slides']=$this->admin_model->get_pagination_result('slider', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'slider/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('slider', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'slider/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function add(){
		 if(admin_login_in()===FALSE)
			redirect('login');		
		$this->form_validation->set_rules('headline', 'heading', 'required');				
		$this->form_validation->set_rules('sub_headline', 'sub heading', 'required');						
		//$this->form_validation->set_rules('btn_link', 'button link', 'required');						
		//$this->form_validation->set_rules('btn_txt', 'button text', 'required');
		$this->form_validation->set_rules('order', 'order', 'required');							
		if ($this->form_validation->run() == TRUE){			
			$data=array(								
				'headline'=>$this->input->post('headline'),				
				'sub_headline'=>$this->input->post('sub_headline'),				
				//'btn_link'=>$this->input->post('btn_link'),				
				//'btn_txt'=>$this->input->post('btn_txt'),			
				'order'=>$this->input->post('order'),			
				'created' => date('Y-m-d H:i:s')		
			);

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/slider/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('slider/add');
				}else{
				   $upload_data = $this->upload->data();			
				   $data['image']=$upload_data['file_name'];
				   create_thumb($data['image'], './assets/uploads/slider/');
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload');
				redirect('slider/add');
			}		
			
			$this->admin_model->insert('slider',$data);		
			$this->session->set_flashdata('success_msg',"Slide has been added successfully.");
			redirect('slider/all');
		}

		$data['template'] = 'slider/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		$this->form_validation->set_rules('headline', 'heading', 'required');				
		$this->form_validation->set_rules('sub_headline', 'sub heading', 'required');						
		//$this->form_validation->set_rules('btn_link', 'button link', 'required');						
		//$this->form_validation->set_rules('btn_txt', 'button text', 'required');						
		$this->form_validation->set_rules('order', 'order', 'required');						
		$data['slider'] = $this->admin_model->get_row('slider', array('id'=> $id));

		if (empty($data['slider'])) {
			$this->session->set_flashdata('error_msg',"No slide found.");
			redirect('slider/all');
		}

		if ($this->form_validation->run() == TRUE){			
			$updatedata=array(
				'headline'=>$this->input->post('headline'),				
				'sub_headline'=>$this->input->post('sub_headline'),				
				//'btn_link'=>$this->input->post('btn_link'),				
				'order'=>$this->input->post('order'),				
				//'btn_txt'=>$this->input->post('btn_txt')				
			);

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/slider/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('slider/add');
				}else{
				   $upload_data = $this->upload->data();			
				   $updatedata['image'] = $upload_data['file_name'];
				   create_thumb($updatedata['image'], './assets/uploads/slider/');
				   delete_image($data['slider']->image, './assets/uploads/slider/');
				}
			}


			$this->admin_model->update('slider',$updatedata, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Slide has been updated successfully.");
			redirect('slider/all');
		}		
		$data['template'] = 'slider/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($id=""){	
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$data =	$this->admin_model->get_row('slider', array('id'=> $id));
		delete_image($data->image, './assets/uploads/slider/');

		$this->admin_model->delete('slider',array('id'=> $id));		
		$this->session->set_flashdata('success_msg',"slide has been deleted successfully.");
		redirect('slider/all');
	}
}