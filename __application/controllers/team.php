<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'about';
		$data['bodyclass'] = 'about';
		$data['pagetitle'] = 'About Us';
		$data['team'] = $this->admin_model->get_result('team');

		$data['template'] = 'team/index';
		$this->load->view('templates/home_template', $data);
	}

	public function detail($slug = ""){
		//$data['member'] = $this->admin_model->get_row('team', array('slug'=>$slug));
		$data['slug'] = $slug;
		$data['team'] = $this->admin_model->get_result('team');
		$data['template'] = 'team/detail';
		$this->load->view('templates/home_template', $data);		
	}

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['team']=$this->admin_model->get_pagination_result('team', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'about/team/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('team', 0, 0);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
		$data['template'] = 'team/all';
		$this->load->view('templates/admin_template', $data);		
	}	

	public function add(){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$this->form_validation->set_rules('name', 'Name', 'required');				
		$this->form_validation->set_rules('position', 'Position', 'required');		        					
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'description' => $this->input->post('description'),	
				'slug' => create_slug('team', $this->input->post('name')),			
				'member_name'   => $this->input->post('name'),
				'position'  => $this->input->post('position'),
                'job_title'  => $this->input->post('job_title'),
                'bio'  => $this->input->post('bio'),
                'hometown'  => $this->input->post('hometown'),
                'twitter_link'  => $this->input->post('twitter_link'),
                'fb_link'  => $this->input->post('fb_link'),
                'email_address'  => $this->input->post('email_address'),
        		'created'  		=> date('Y-m-d h:i:s'),							
				);
			
			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/team/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('team/add');
				}else{
					$upload_data = $this->upload->data();			
					$post_data['member_image']=$upload_data['file_name'];
					create_thumb($post_data['member_image'], './assets/uploads/team/');
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload');
				redirect('team/add');
			}
			$post_id = $this->admin_model->insert('team',$post_data);
			$this->session->set_flashdata('success_msg','Member Added.');						
			redirect('team/all');
		}
		$data['template'] = 'team/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug=""){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		if(empty($slug))
			redirect('team/all');
		
		$data['team']=$this->admin_model->get_row('team',array('slug'=>$slug));		
		$this->form_validation->set_rules('name', 'Name', 'required');		
		// $this->form_validation->set_rules('description', 'descriptiom', 'required');	
		$this->form_validation->set_rules('position', 'Position', 'required');	
        // $this->form_validation->set_rules('job_title', 'Job Title', 'required');
        // $this->form_validation->set_rules('email_address', 'Email', 'required');
        // $this->form_validation->set_rules('twitter_link', 'Twitter Link', 'required');	
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');	
			
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'member_name'   => $this->input->post('name'),
				'slug' => create_slug_for_update('team', $this->input->post('name'), $data['team']->id),
				'position'  => $this->input->post('position'),
                'job_title'  => $this->input->post('job_title'),
                'bio'  => $this->input->post('bio'),               
                'hometown'  => $this->input->post('hometown'),
                'twitter_link'  => $this->input->post('twitter_link'),
                'fb_link'  => $this->input->post('fb_link'),
                'email_address'  => $this->input->post('email_address'),
            );

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/team/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('team/edit/'.$slug);
				}else{
					$upload_data = $this->upload->data();			
					$post_data['member_image'] = $upload_data['file_name'];
					create_thumb($post_data['member_image'], './assets/uploads/team/');
					delete_image($data['team']->member_image, './assets/uploads/team/');
				}
			}
			
			$slug = $this->admin_model->update('team',$post_data, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg','Member Updated.');						
			redirect('team/all');
		}		
		$data['template'] = 'team/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($slug=""){	
		if(admin_login_in()===FALSE)
			redirect('login');
		if(empty($slug))
			redirect('team/all');
		
		$data =	$this->admin_model->get_row('team', array('slug'=> $slug));
		delete_image($data->member_image, './assets/uploads/team/');
		$this->admin_model->delete('team',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"Member has been deleted successfully.");
		redirect('team/all');
	}
}