<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invest extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = 'invest';
		$data['pagetitle'] = 'Invest';

		$this->form_validation->set_rules('firstname', 'firstname', 'required');						
		$this->form_validation->set_rules('lastname', 'lastname', 'required');						
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');						
		$this->form_validation->set_rules('city', 'city', 'required');						
		$this->form_validation->set_rules('state', 'state', 'required');						
		$this->form_validation->set_rules('invest_category', 'invest category', 'required');						
		$this->form_validation->set_rules('invest_range', 'invest range', 'required');						
		$this->form_validation->set_rules('zip', 'zip', 'required');						
		$this->form_validation->set_rules('address', 'address', 'required');						
		$this->form_validation->set_rules('information', 'information', 'required');						
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'firstname'=>$this->input->post('firstname'),				
				'lastname'=>$this->input->post('lastname'),				
				'email'=>$this->input->post('email'),							
				'address'=>$this->input->post('address'),							
				'invest_category'=>$this->input->post('invest_category'),							
				'invest_range'=>$this->input->post('invest_range'),							
				'zip'=>$this->input->post('zip'),							
				'phone'=>$this->input->post('phone'),							
				'country'=>$this->input->post('country'),							
				'city'=>$this->input->post('city'),							
				'state'=>$this->input->post('state'),							
				'information'=>$this->input->post('information'),							
				'created' => date('Y-m-d H:i:s')		
			);		

			$this->admin_model->insert('invest_form', $data);
			$this->session->set_flashdata('success_msg','successfully submitted');
			redirect('invest');
		}

		$data['video'] =	$this->admin_model->get_row('investvideo', array('id'=> 1));
		$data['invests']=  $this->admin_model->get_result('invest');
		$data['template'] = 'invest/index';
		$this->load->view('templates/home_template', $data);
	}

	public function all($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['invest']=$this->admin_model->get_pagination_result('invest', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'invest/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('invest', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'invest/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function add(){
		 if(admin_login_in()===FALSE)
			redirect('login');
		$this->form_validation->set_rules('title', 'title', 'required');										
		$this->form_validation->set_rules('description', 'description', 'required');						
		if ($this->form_validation->run() == TRUE){			
			$data=array(
				'title'=>$this->input->post('title'),
				'slug' => create_slug('invest', $this->input->post('title')),											
				'description'=>$this->input->post('description'),								
				'created' => date('Y-m-d H:i:s')		
			);

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/invest/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('invest/add');
				}else{
				   $upload_data = $this->upload->data();			
				   $data['image']=$upload_data['file_name'];
				   create_thumb($data['image'], './assets/uploads/invest/');
				}
			}	
			
			$this->admin_model->insert('invest',$data);		
			$this->session->set_flashdata('success_msg',"Content has been added successfully.");
			redirect('invest/all');
		}

		$data['template'] = 'invest/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		$this->form_validation->set_rules('title', 'title', 'required');							
		$this->form_validation->set_rules('description', 'description', 'required');		
		$data['invest'] = $this->admin_model->get_row('invest', array('slug'=> $slug));

		if (empty($data['invest'])) {
			$this->session->set_flashdata('error_msg',"No content found.");
			redirect('invest/all');
		}

		if ($this->form_validation->run() == TRUE){			
			$updatedata=array(
				'title'=>$this->input->post('title'),
				'slug' => create_slug_for_update('invest', $this->input->post('title'), $data['invest']->id),																'description'=>$this->input->post('description'),				
				'created' => date('Y-m-d H:i:s')		
			);

			if($_FILES['userfile']['name']!=''){
				$config['upload_path'] = './assets/uploads/invest/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload()){
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('invest/add');
				}else{
				   $upload_data = $this->upload->data();			
				   $updatedata['image'] = $upload_data['file_name'];
				   create_thumb($updatedata['image'], './assets/uploads/invest/');
				   delete_image($data['invest']->image, './assets/uploads/invest/');
				}
			}


			$this->admin_model->update('invest',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"Content has been updated successfully.");
			redirect('invest/all');
		}		
		$data['template'] = 'invest/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($slug=""){	
		if(admin_login_in()===FALSE)
			redirect('login');	
		
		$data =	$this->admin_model->get_row('invest', array('slug'=> $slug));
		delete_image($data->image, './assets/uploads/invest/');

		$this->admin_model->delete('invest',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"Content has been deleted successfully.");
		redirect('invest/all');
	}

	public function video(){
		$data['video'] =	$this->admin_model->get_row('investvideo', array('id'=> 1));
		$this->form_validation->set_rules('url', 'Video id', 'required');		
		if($this->form_validation->run() === TRUE){			
			$updatedata['url'] = $this->input->post('url');
			$this->admin_model->update('investvideo',$updatedata);		
			$this->session->set_flashdata('success_msg',"video url has been updated successfully.");
			redirect(current_url());
		}
		$data['template'] = 'invest/video';
        $this->load->view('templates/admin_template', $data);		
	}

	public function form($offset=0){		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['invest']=$this->admin_model->get_pagination_result('invest_form', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'invest/form/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('invest_form', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'invest/form';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function view($id=''){
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('invest/form');

		$data['detail'] = $this->admin_model->get_row('invest_form', array('id'=>$id));
		$data['template'] = 'invest/view';
        $this->load->view('templates/admin_template', $data);			
	}

	public function deleteform($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('invest/form');

		$this->admin_model->delete('invest_form', array('id'=>$id));		
		$this->session->set_flashdata('success_msg','successfully Deleted');
			redirect('invest/form');
	}
}