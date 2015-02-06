<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class About extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('admin_model');

	}



	public function index()
	{

		$data['menuactive'] = 'about';

		$data['bodyclass'] = 'about';

		$data['pagetitle'] = 'About Us';

		// $data['team'] = $this->admin_model->get_result('team');
		$this->db->order_by('order','asc');
		$data['content'] = $this->admin_model->get_result('about');
		$this->db->order_by('order','asc');
		$data['event'] = $this->admin_model->get_result('event');
		$data['template'] = 'about/index';

		$this->load->view('templates/home_template', $data);

	}


	public function in_the_kitchen(){
		$data['menuactive'] = 'about';
		$data['bodyclass'] = 'about';
		$data['pagetitle'] = 'About Us';		
		$data['template'] = 'about/in_the_kitchen';
		$this->load->view('templates/home_template', $data);
	}


	public function all($offset=0){		

		if(admin_login_in()===FALSE)

			redirect('login');



		$limit=10;

		$data['about']=$this->admin_model->get_pagination_result('about', $limit,$offset);

		$config= get_theme_pagination();	

		$config['base_url'] = base_url().'about/all/';

		$config['total_rows'] = $this->admin_model->get_pagination_result('about', 0, 0);

		$config['per_page'] = $limit;

		// $config['num_links'] = 5;		

		$this->pagination->initialize($config); 		

		$data['pagination'] = $this->pagination->create_links();		



        $data['template'] = 'about/all';

        $this->load->view('templates/admin_template', $data);			

	}		


	public function add(){
		 if(admin_login_in()===FALSE)
			redirect('login');		
		// $this->form_validation->set_rules('heading', 'heading', 'required');						
		$this->form_validation->set_rules('type', 'type', 'required');					
		$this->form_validation->set_rules('order', 'order', 'required');					

		if ($this->form_validation->run() == TRUE){			
			$data=array(								
				'heading'=>$this->input->post('heading'),							
				'description'=>$this->input->post('description'),				
				'order'=>$this->input->post('order'),								
				'type'=>$this->input->post('type'),				
				'created' => date('Y-m-d H:i:s')		
			);

				
			if($this->input->post('type') == 1){				
				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/about/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload()){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('about/add');
					}else{
					   $upload_data = $this->upload->data();	
					   $data['image']=$upload_data['file_name'];
					   create_thumb($data['image'], './assets/uploads/about/');
					}
				}else{
					$this->session->set_flashdata('error_msg', 'Please select an image to upload');
					redirect('about/add');
				}

			}

			$sectionid = $this->admin_model->insert('about',$data);		
			$this->session->set_flashdata('success_msg',"Content has been added successfully.");
			redirect('about/all');

		}		
		$data['template'] = 'about/add';
        $this->load->view('templates/admin_template', $data);		

	}

	public function edit($id=""){

		if(admin_login_in()===FALSE)

			redirect('login');

		// $this->form_validation->set_rules('heading', 'heading', 'required');						
		$this->form_validation->set_rules('type', 'type', 'required');					
		$this->form_validation->set_rules('order', 'order', 'required');					
		$data['section'] = $this->admin_model->get_row('about', array('id'=>$id));

		if (empty($data['section'])) {
			$this->session->set_flashdata('error_msg',"No Content found.");
			redirect('about/all');
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
				'type'=>$this->input->post('type'),				
				'created' => date('Y-m-d H:i:s')				
			);

			if($this->input->post('type') == 1){
				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/about/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload()){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('about/edit/'.$id);
					}else{
					   delete_image(@$data['section']->image, './assets/uploads/about/');
					   $upload_data = $this->upload->data();			
					   // print_r($upload_data); die();
					   $updatedata['image'] = $upload_data['file_name'];
					   create_thumb($updatedata['image'], './assets/uploads/about/');
					}
				}
			}

			$this->admin_model->update('about',$updatedata, array('id'=>$id));		
			$this->session->set_flashdata('success_msg',"Content has been updated successfully.");
			redirect('about/all');
		}		
		$data['template'] = 'about/edit';
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
			redirect('about/all');

		$data = $this->admin_model->get_row('about', array('id'=>$id));
		delete_image($data->image, './assets/uploads/about/');
		$this->admin_model->delete('about', array('id'=>$id));	
		$this->session->set_flashdata('success_msg',"Content has been delete successfully.");
			redirect('about/all');
	}

}