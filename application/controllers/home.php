<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = '';
		$data['pagetitle'] = 'Homepage';
		
		$data['intro_content'] = $this->admin_model->get_row('contents',array('id' => 1));
		$this->db->order_by('order', 'asc');
		$data['slider'] = $this->admin_model->get_result('slider');
		$data['template'] = 'home/index';
		$this->load->view('templates/home_template', $data);
	}


	public function intro_content(){
		if(admin_login_in()===FALSE){
			redirect('login');
		}
		$where = array('id' => 1);
		$data['row'] = $this->admin_model->get_row('contents',$where);
		$this->form_validation->set_rules('headline','Headline','required');						
		$this->form_validation->set_rules('description','Description','required');						
		if ($this->form_validation->run() == TRUE){
			$update = array(
				'headline' => $this->input->post('headline'),	
				'description' => $this->input->post('description'),	
			);		
			$this->admin_model->update('contents',$update,$where);
			$this->session->set_flashdata('success_msg','Successfully Updated.');
			redirect(current_url());
		}
		$data['template'] = 'contents/intro_content';
		$this->load->view('templates/admin_template', $data);
	}

	


	public function headerimages($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		$data['image'] = $this->admin_model->get_row('headerimages', array('id'=>1));
		if($this->input->post('submit')){
			// echo "here"; die();

			$updatedata = array(
				'contactxt' =>$this->input->post('contactxt'),
				'closetxt' =>$this->input->post('closetxt'),
				'stylingtxt' =>$this->input->post('stylingtxt'),
				);

			if($_FILES['contactimg']['name']!=''){
				$config['upload_path'] = './assets/uploads/home/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload('contactimg')){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect(current_url());
				}else{
				   delete_image($data['image']->contactimg, './assets/uploads/home/');
				   $upload_data = $this->upload->data();							   
				   $updatedata['contactimg'] = $upload_data['file_name'];				   
				}
			}


			if($_FILES['closetimg']['name']!=''){
				$config['upload_path'] = './assets/uploads/home/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload('closetimg')){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect(current_url());
				}else{
				   delete_image($data['image']->closetimg, './assets/uploads/home/');
				   $upload_data = $this->upload->data();							   
				   $updatedata['closetimg'] = $upload_data['file_name'];				   
				}
			}



			if($_FILES['stylingimg']['name']!=''){
				$config['upload_path'] = './assets/uploads/home/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload('stylingimg')){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect(current_url());
				}else{
				   delete_image($data['image']->stylingimg, './assets/uploads/home/');
				   $upload_data = $this->upload->data();							   
				   $updatedata['stylingimg'] = $upload_data['file_name'];				   
				}
			}


			$this->admin_model->update('headerimages',$updatedata);		
			$this->session->set_flashdata('success_msg',"Updated");
			redirect(current_url());
		}

		$data['template'] = 'home/headerimages';
        $this->load->view('templates/admin_template', $data);
	}

	

}