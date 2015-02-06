<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Landingpage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}



	public function index(){
		$data['menuactive'] = '';
		$data['bodyclass'] = '';
		$data['pagetitle'] = '';		

		$data['leftvideo'] = $this->admin_model->get_row('landinpagevideo', array('id'=>1));
		$data['rightvideo'] = $this->admin_model->get_row('landinpagevideo', array('id'=>2));		
		$data['content'] = $this->admin_model->get_result('landingpage');
		//$data['template'] = 'about/index';
		$this->load->view('landingpage/index', $data);

	}


	public function leftvideo(){
		if(admin_login_in()===FALSE)
			redirect('login');

		$data['video'] = $this->admin_model->get_row('landinpagevideo', array('id'=>1));

		$this->form_validation->set_rules('mp4', 'MP4', 'callback_check_mp4_file');
		$this->form_validation->set_rules('webm', 'webm', 'callback_check_webm_file');
		$this->form_validation->set_rules('ogv', 'Ogv', 'callback_check_ogv_file');
		$this->form_validation->set_rules('heading', 'heading', 'xss_clean');
		$this->form_validation->set_rules('subheading', 'subheading', 'xss_clean');
		$this->form_validation->set_rules('btn_text', 'btn_text', 'xss_clean');
		$this->form_validation->set_rules('btn_link', 'btn_link', 'xss_clean');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == TRUE){
			// echo "string"; die();
			$post_data=array(					
					'heading'  		=> $this->input->post('heading'),
					'type'  		=> 1,
					'subheading'  	=> $this->input->post('subheading'),
					'btn_text'  	=> $this->input->post('btn_text'),
					'btn_link'  	=> $this->input->post('btn_link'),
					'updated'  		=> date('Y-m-d h:i:s'),
					'created'  		=> date('Y-m-d h:i:s'),
				);
			// print_r($_FILES);
			// die();
			

			$ogv = FALSE;

			if ($_FILES['ogv']['name'] != ''){
					$ogv = $this->do_video_upload('ogv', './assets/uploads/videos/');
					if ($ogv){
						if (!empty($data['video']->ogv))
							$this->delete_video($data['video']->ogv);
						$post_data['ogv'] = $ogv;
					}
				}	
				if ($_FILES['mp4']['name'] != '') {
					$mp4 = $this->do_video_upload('mp4', './assets/uploads/videos/');
					if ($mp4){
						$post_data['mp4'] = $mp4;
					}
					else{
						$this->session->set_flashdata('error_msg', 'File upload failed.');
						redirect('landingpage/leftvideo');
					}
				}

				if ($_FILES['webm']['name'] != '') {
					$webm = $this->do_video_upload('webm', './assets/uploads/videos/');
					if ($webm){
						$this->delete_video($data['video']->mp4);
						$this->delete_video($data['video']->webm);
						$post_data['webm'] = $webm;
					}
					else{
						if ($mp4)
							$this->delete_video($mp4);

						$this->session->set_flashdata('error_msg', 'File upload failed.');
						redirect('landingpage/leftvideo');
					}
				}		
			
				
			$this->admin_model->update('landinpagevideo',$post_data, array('id'=>1));
			$this->session->set_flashdata('success_msg','Video has been updated successfully.');
			redirect('landingpage/leftvideo');
		}

		$data['template'] = 'landingpage/leftvideo';
        $this->load->view('templates/admin_template', $data);
	}



	public function rightvideo(){
		if(admin_login_in()===FALSE)
			redirect('login');

		$data['video'] = $this->admin_model->get_row('landinpagevideo', array('id'=>2));

		$this->form_validation->set_rules('mp4', 'MP4', 'callback_check_mp4_file');
		$this->form_validation->set_rules('webm', 'webm', 'callback_check_webm_file');
		$this->form_validation->set_rules('ogv', 'Ogv', 'callback_check_ogv_file');
		$this->form_validation->set_rules('heading', 'heading', 'xss_clean');
		$this->form_validation->set_rules('subheading', 'subheading', 'xss_clean');
		//$this->form_validation->set_rules('btn_text', 'btn_text', 'xss_clean');
		//$this->form_validation->set_rules('btn_link', 'btn_link', 'xss_clean');
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');

		if ($this->form_validation->run() == TRUE){
			// echo "string"; die();
			$post_data=array(					
					'heading'  		=> $this->input->post('heading'),
					'type'  		=> 2,
					'subheading'  	=> $this->input->post('subheading'),
					'btn_text'  	=> $this->input->post('btn_text'),
					'btn_link'  	=> $this->input->post('btn_link'),
					'updated'  		=> date('Y-m-d h:i:s'),
					'created'  		=> date('Y-m-d h:i:s'),
				);
			// print_r($_FILES);
			// die();
			

			$ogv = FALSE;

			if ($_FILES['ogv']['name'] != ''){
					$ogv = $this->do_video_upload('ogv', './assets/uploads/videos/');
					if ($ogv){
						if (!empty($data['video']->ogv))
							$this->delete_video($data['video']->ogv);
						$post_data['ogv'] = $ogv;
					}
				}	
				if ($_FILES['mp4']['name'] != '') {
					$mp4 = $this->do_video_upload('mp4', './assets/uploads/videos/');
					if ($mp4){
						$post_data['mp4'] = $mp4;
					}
					else{
						$this->session->set_flashdata('error_msg', 'File upload failed.');
						redirect('landingpage/rightvideo');
					}
				}

				if ($_FILES['webm']['name'] != '') {
					$webm = $this->do_video_upload('webm', './assets/uploads/videos/');
					if ($webm){
						$this->delete_video($data['video']->mp4);
						$this->delete_video($data['video']->webm);
						$post_data['webm'] = $webm;
					}
					else{
						if ($mp4)
							$this->delete_video($mp4);

						$this->session->set_flashdata('error_msg', 'File upload failed.');
						redirect('landingpage/rightvideo');
					}
				}		
			
				
			$this->admin_model->update('landinpagevideo',$post_data, array('id'=>2));
			$this->session->set_flashdata('success_msg','Video has been updated successfully.');
			redirect('landingpage/rightvideo');
		}

		$data['template'] = 'landingpage/rightvideo';
        $this->load->view('templates/admin_template', $data);
	}

	public function check_mp4_file()
	{
		if (!$this->input->post('is_edit')) {
			$a = explode('.', $_FILES['mp4']['name']);
			$ext = (end($a));
			if (empty($_FILES['mp4']['name'])) {
				$this->form_validation->set_message('check_mp4_file','Please select an mp4 file.');
				return false;
			}elseif($ext != 'mp4'){
				$this->form_validation->set_message('check_mp4_file','Only mp4 file allowed.');
				return false;
			}
			return true;
		}else{

			if (empty($_FILES['mp4']['name'])) {
				return TRUE;
			}else{
				$a = explode('.', $_FILES['mp4']['name']);
				$ext = (end($a));
				if($ext != 'mp4'){
					$this->form_validation->set_message('check_mp4_file','Only mp4 file allowed.');
					return false;
				}
			}
			return true;
		}
	}

	public function check_webm_file()
	{
		if (!$this->input->post('is_edit')) {
			$a = explode('.', $_FILES['webm']['name']);
			$ext = (end($a));
			if (empty($_FILES['webm']['name'])) {
				$this->form_validation->set_message('check_webm_file','Please select an webm file.');
				return false;
			}elseif($ext != 'webm'){
				$this->form_validation->set_message('check_webm_file','Only webm file allowed.');
				return false;
			}
			return true;
		}else{

			if (empty($_FILES['webm']['name'])) {
				return TRUE;
			}else{
				$a = explode('.', $_FILES['webm']['name']);
				$ext = (end($a));
				if($ext != 'webm'){
					$this->form_validation->set_message('check_webm_file','Only webm file allowed.');
					return false;
				}
			}
			return true;
		}
	}

	public function check_ogv_file()
	{

		if (empty($_FILES['ogv']['name'])) {
			return TRUE;
		}else{
			$a = explode('.', $_FILES['ogv']['name']);
			$ext = (end($a));
			if($ext != 'ogv'){
				$this->form_validation->set_message('check_ogv_file','Only Ogv file allowed.');
				return false;
			}
		}
		return true;
	}


	public function do_video_upload($filename2='mp4' , $upload_path='./assets/uploads/videos/', $path_of_thumb=''){
		$allowed =  array('webm','mp4','ogv');
		$filename = $_FILES[$filename2]['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed) ) {
		    return FALSE;
		}
		else{
			if ($_FILES[$filename2]["error"] > 0){
				return FALSE; 
			}else{
				$name = uniqid();
				if(move_uploaded_file($_FILES[$filename2]['tmp_name'],$upload_path.$name.'.'.$ext))
					return $name.'.'.$ext;
				else
					return FALSE;
			}
		}
	}


	public function content($offset=0){		

		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['landingpage']=$this->admin_model->get_pagination_result('landingpage', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'landingpage/content/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('about', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;	
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
        $data['template'] = 'landingpage/content';
        $this->load->view('templates/admin_template', $data);			
	}		


	public function add(){
		 if(admin_login_in()===FALSE)
			redirect('login');		
		// $this->form_validation->set_rules('heading', 'heading', 'required');						
		$this->form_validation->set_rules('heading', 'heading', 'required');					
		

		if ($this->form_validation->run() == TRUE){			
			$data=array(								
				'heading'=>$this->input->post('heading'),							
				'description'=>$this->input->post('description'),												
			);

				
						
				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/home/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload()){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('landingpage/add');
					}else{
					   $upload_data = $this->upload->data();	
					   $data['image']=$upload_data['file_name'];
					   create_thumb($data['image'], './assets/uploads/home/');
					}
				}else{
					$this->session->set_flashdata('error_msg', 'Please select an image to upload');
					redirect('landingpage/add');
				}

			$sectionid = $this->admin_model->insert('landingpage',$data);		
			$this->session->set_flashdata('success_msg',"Content has been added successfully.");
			redirect('landingpage/content');

		}		
		$data['template'] = 'landingpage/add';
        $this->load->view('templates/admin_template', $data);		

	}

	public function edit($id=""){

		if(admin_login_in()===FALSE)

			redirect('login');

		$this->form_validation->set_rules('heading', 'heading', 'required');								
		$data['section'] = $this->admin_model->get_row('landingpage', array('id'=>$id));

		if (empty($data['section'])) {
			$this->session->set_flashdata('error_msg',"No Content found.");
			redirect('landingpage/content');
		}

		if ($this->form_validation->run() == TRUE){			

			$updatedata=array(
				'heading'=>$this->input->post('heading'),							
				'description'=>$this->input->post('description'),								
			);

			
				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/home/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload()){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('landingpage/edit/'.$id);
					}else{
					   delete_image(@$data['section']->image, './assets/uploads/home/');
					   $upload_data = $this->upload->data();			
					   // print_r($upload_data); die();
					   $updatedata['image'] = $upload_data['file_name'];
					   create_thumb($updatedata['image'], './assets/uploads/home/');
					}
				}
			

			$this->admin_model->update('landingpage',$updatedata, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Content has been updated successfully.");
			redirect('landingpage/content');
		}		
		$data['template'] = 'landingpage/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	private function set_upload_options(){   
	    $config = array();
	    $config['upload_path'] = './assets/uploads/home';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;
	    return $config;
	}

	public function ajax_remove_logo($id=""){		
		if(admin_login_in()===FALSE){
			return FALSE;
			die();		
		}

		if($id == ""){
			echo "0";
			die();
		}

		$img = $this->admin_model->get_row('maplogos', array('id'=>$id));
		delete_image($img->image, './assets/uploads/about/');
		$this->admin_model->delete('maplogos', array('id'=>$id));	

	}


	public function delete($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		if($id=="")
			redirect('landingpage/content');

		$data = $this->admin_model->get_row('landingpage', array('id'=>$id));
		delete_image($data->image, './assets/uploads/home/');
		$this->admin_model->delete('landingpage', array('id'=>$id));	
		$this->session->set_flashdata('success_msg',"Content has been delete successfully.");
			redirect('landingpage/content');
	}

	public function delete_video($video='', $path='./assets/uploads/videos/')
	{
		if (!empty($video)) {
			@unlink( $path.$video);
		}
		return TRUE;
	}

}