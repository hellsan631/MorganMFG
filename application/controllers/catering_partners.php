<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catering_partners extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'about';
		$data['bodyclass'] = 'about';
		$data['pagetitle'] = 'About Us';
		$data['catering_partners'] = $this->admin_model->get_result('catering_partners');

		$data['template'] = 'catering_partners/index';
		$this->load->view('templates/home_template', $data);
	}

	public function detail($slug = ""){
		//$data['member'] = $this->admin_model->get_row('catering_partners', array('slug'=>$slug));
		$data['slug'] = $slug;
		$data['catering_partners'] = $this->admin_model->get_result('catering_partners');
		$data['template'] = 'catering_partners/detail';
		$this->load->view('templates/home_template', $data);		
	}

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['catering_partners']=$this->admin_model->get_pagination_result('catering_partners', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'catering_partners/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('catering_partners', 0, 0);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
		$data['template'] = 'catering_partners/all';
		$this->load->view('templates/admin_template', $data);		
	}	

	public function add(){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$this->form_validation->set_rules('name', 'Name', 'required');				
		// $this->form_validation->set_rules('position', 'Position', 'required');		        					
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
								'description' => $this->input->post('description'),	
								'slug' => create_slug('catering_partners', $this->input->post('name')),			
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
				$config['upload_path'] = './assets/uploads/catering_partners/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('catering_partners/add');
				}else{
					$upload_data = $this->upload->data();			
					$post_data['member_image']=$upload_data['file_name'];
					create_thumb($post_data['member_image'], './assets/uploads/catering_partners/');
				}
			}else{
				$this->session->set_flashdata('error_msg', 'Please select an image to upload');
				redirect('catering_partners/add');
			}
			$post_id = $this->admin_model->insert('catering_partners',$post_data);
			$this->session->set_flashdata('success_msg','Member Added.');						
			redirect('catering_partners/all');
		}
		$data['template'] = 'catering_partners/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug="")
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		
		if(empty($slug))
			redirect('catering_partners/all');
		$slug = urldecode($slug);
		// $slug = "jordan’s";
		$data['catering_partners'] = $this->admin_model->get_row('catering_partners',array('slug'=>$slug));
		// echo "<br> Slug : ".$slug;
		// echo "<pre >";
		// print_r($data['catering_partners']);
		// die();
		$this->form_validation->set_rules('name', 'Name', 'required');		
		// $this->form_validation->set_rules('description', 'descriptiom', 'required');	
		// $this->form_validation->set_rules('position', 'Position', 'required');	
        // $this->form_validation->set_rules('job_title', 'Job Title', 'required');
        // $this->form_validation->set_rules('email_address', 'Email', 'required');
        // $this->form_validation->set_rules('twitter_link', 'Twitter Link', 'required');	
		$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');	
			
		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
				'member_name'   => $this->input->post('name'),
				'slug' => create_slug_for_update('catering_partners', $this->input->post('name'), $data['catering_partners']->id),
				'position'  => $this->input->post('position'),
                'job_title'  => $this->input->post('job_title'),
                'bio'  => $this->input->post('bio'),               
                'hometown'  => $this->input->post('hometown'),
                'twitter_link'  => $this->input->post('twitter_link'),
                'fb_link'  => $this->input->post('fb_link'),
                'email_address'  => $this->input->post('email_address'),
            );

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/catering_partners/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('catering_partners/edit/'.$slug);
				}else{
					$upload_data = $this->upload->data();			
					$post_data['member_image'] = $upload_data['file_name'];
					create_thumb($post_data['member_image'], './assets/uploads/catering_partners/');
					delete_image($data['catering_partners']->member_image, './assets/uploads/catering_partners/');
				}
			}
			
			$slug = $this->admin_model->update('catering_partners',$post_data, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg','Member Updated.');						
			redirect('catering_partners/all');
		}		
		$data['template'] = 'catering_partners/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($slug=""){	
		if(admin_login_in()===FALSE)
			redirect('login');
		if(empty($slug))
			redirect('catering_partners/all');
		
		$data =	$this->admin_model->get_row('catering_partners', array('slug'=> $slug));
		delete_image($data->member_image, './assets/uploads/catering_partners/');
		$this->admin_model->delete('catering_partners',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"Member has been deleted successfully.");
		redirect('catering_partners/all');
	}

	public function downloadFile($file="140818212921_MORGAN_FLOORPLANS.pdf", $path="./assets/download/")
    {
		downloadFile($file, $path, "MorganMFGfloorplan.pdf");
    }

    public function clickable(){
    	if(admin_login_in()===FALSE)
			redirect('login');
		
    	$data['template'] = 'catering_partners/clickable';
        $this->load->view('templates/admin_template', $data);	
    }
}