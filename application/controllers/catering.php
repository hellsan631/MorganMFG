<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catering extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'catering';
		$data['bodyclass'] = 'catering';
		$data['pagetitle'] = 'Catering';
		$data['catering'] = $this->admin_model->get_result('catering');
		$data['template'] = 'catering/index';
		$this->load->view('templates/home_template', $data);
	}

	public function detail($slug = ""){
		$data['slug'] = $slug;
		$data['catering'] = $this->admin_model->get_result('catering');
		$data['template'] = 'catering/detail';
		$this->load->view('templates/home_template', $data);		
	}

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['catering']=$this->admin_model->get_pagination_result('catering', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'catering/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('catering', 0, 0);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
		$data['template'] = 'catering/all';
		$this->load->view('templates/admin_template', $data);		
	}	

	public function add(){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$this->form_validation->set_rules('name', 'Name', 'required');				
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'description' => $this->input->post('description'),	
				'slug' => create_slug('catering', $this->input->post('name')),			
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
				$config['upload_path'] = './assets/uploads/catering/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('catering/add');
				}else{
					$upload_data = $this->upload->data();			
					$post_data['member_image']=$upload_data['file_name'];
					create_thumb($post_data['member_image'], './assets/uploads/catering/');
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload');
				redirect('catering/add');
			}
			$post_id = $this->admin_model->insert('catering',$post_data);
			$this->session->set_flashdata('success_msg','Member Added.');						
			redirect('catering/all');
		}
		$data['template'] = 'catering/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug=""){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		if(empty($slug))
			redirect('catering/all');
		$slug = urldecode($slug);
		$data['catering'] = $this->admin_model->get_row('catering',array('slug'=>$slug));
		$this->form_validation->set_rules('name', 'Name', 'required');		
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');	
			
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'member_name'   => $this->input->post('name'),
				'slug' => create_slug_for_update('catering', $this->input->post('name'), $data['catering']->id),
				'position'  => $this->input->post('position'),
                'job_title'  => $this->input->post('job_title'),
                'bio'  => $this->input->post('bio'),               
                'hometown'  => $this->input->post('hometown'),
                'twitter_link'  => $this->input->post('twitter_link'),
                'fb_link'  => $this->input->post('fb_link'),
                'email_address'  => $this->input->post('email_address'),
            );

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/catering/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('catering/edit/'.$slug);
				}else{
					$upload_data = $this->upload->data();			
					$post_data['member_image'] = $upload_data['file_name'];
					create_thumb($post_data['member_image'], './assets/uploads/catering/');
					delete_image($data['catering']->member_image, './assets/uploads/catering/');
				}
			}
			
			$slug = $this->admin_model->update('catering',$post_data, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg','Member Updated.');						
			redirect('catering/all');
		}		
		$data['template'] = 'catering/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($slug=""){	
		if(admin_login_in()===FALSE)
			redirect('login');
		if(empty($slug))
			redirect('catering/all');
		
		$data =	$this->admin_model->get_row('catering', array('slug'=> $slug));
		delete_image($data->member_image, './assets/uploads/catering/');
		$this->admin_model->delete('catering',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"Member has been deleted successfully.");
		redirect('catering/all');
	}

	public function downloadFile()
    {
    	$file_info = $this->admin_model->get_row('site_content',array('slug'=>'site_content'));
		if($file_info->floor_plans){
			$file = $file_info->floor_plans;
		}
		else{
			echo "No File Found. it may be removed.";
			return false;
		}

		if(!file_exists($path='./assets/download/'.$file)){
			redirect('home');
		}

		downloadFile($file, $path='./assets/download/', "MorganMFGfloorplan.pdf");
    }

    public function clickable(){
    	if(admin_login_in()===FALSE)
			redirect('login');
		
    	$data['template'] = 'catering/clickable';
        $this->load->view('templates/admin_template', $data);	
    }
}