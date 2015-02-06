<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spaces extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
		// redirect('amenities');
	}

	public function index(){
		$data['menuactive'] = 'about';
		$data['bodyclass'] = 'about';
		$data['pagetitle'] = 'About Us';
		//$data['fixednav'] = TRUE;
		$data['footspaces'] = TRUE;
		$data['space'] = $this->admin_model->get_result('space',FALSE,FALSE,FALSE);

		$data['template'] = 'space/index';
		$this->load->view('templates/home_template', $data);
	}

	public function detail($slug = ""){
		$data['slug'] = $slug;
        

		$data['space'] = $this->admin_model->get_row('space', array('slug'=>$slug));
		if(empty($data['space']))
		{
			redirect('spaces');
		}
		//$data['member'] = $this->admin_model->get_row('team', array('slug'=>$slug));
		$data['template'] = 'space/detail';
		$this->load->view('templates/home_template', $data);		
	}

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['space']=$this->admin_model->get_pagination_result('space', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'spaces/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('space', 0, 0);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
		$data['template'] = 'space/all';
		$this->load->view('templates/admin_template', $data);		
	}	

	public function add(){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$this->form_validation->set_rules('title', 'title', 'required');				
		$this->form_validation->set_rules('description', 'description', 'required');		        					
		$this->form_validation->set_rules('link', 'link', 'xss_clean');	        					
		$this->form_validation->set_rules('btn_txt', 'btn_txt', 'xss_clean');	        					
		
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'slug' => create_slug('space', $this->input->post('title')),			
				'description' => $this->input->post('description'),	
				'title'   => $this->input->post('title'),
				'btn_txt'  => $this->input->post('btn_txt'),
				'link'  => $this->input->post('link'),
                'created'  		=> date('Y-m-d h:i:s')							
			);
			
			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/space/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('spaces/add');
				}else{
					$upload_data = $this->upload->data();			
					$post_data['image']=$upload_data['file_name'];
					create_thumb($post_data['image'], './assets/uploads/space/');
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload');
				redirect('spaces/add');
			}
			
			$post_id = $this->admin_model->insert('space',$post_data);
			$this->session->set_flashdata('success_msg','Space Added.');						
			redirect('spaces/all');
		}
		$data['template'] = 'space/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug=""){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		if(empty($slug))
			redirect('spaces/all');
		
		$data['space']=$this->admin_model->get_row('space',array('slug'=>$slug));		
		
		$this->form_validation->set_rules('title', 'title', 'required');				
		$this->form_validation->set_rules('description', 'description', 'required');		        					
		$this->form_validation->set_rules('link', 'link', 'xss_clean');	 
			
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'slug' => create_slug_for_update('space', $this->input->post('title'), $data['space']->id),
				'description' => $this->input->post('description'),	
				'title'   => $this->input->post('title'),
				'link'  => $this->input->post('link'),
				'btn_txt'  => $this->input->post('btn_txt'),
                'updated'  		=> date('Y-m-d h:i:s')
            );

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/space/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('spaces/edit/'.$slug);
				}else{
					$upload_data = $this->upload->data();			
					$post_data['image'] = $upload_data['file_name'];
					create_thumb($post_data['image'], './assets/uploads/space/');
					delete_image($data['space']->image, './assets/uploads/space/');
				}
			}
			
			$slug = $this->admin_model->update('space',$post_data, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg','Space Updated.');						
			redirect('spaces/all');
		}		
		$data['template'] = 'space/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($slug=""){	
		if(admin_login_in()===FALSE)
			redirect('login');
		
		if(empty($slug))
			redirect('spaces/all');
		
		$data =	$this->admin_model->get_row('space', array('slug'=> $slug));
		delete_image($data->image, './assets/uploads/space/');
		$this->admin_model->delete('space',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"Space has been deleted successfully.");
		redirect('spaces/all');
	}
}