<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sections extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		// $data['menuactive'] = 'about';
		// $data['bodyclass'] = 'about';
		// $data['pagetitle'] = 'About Us';
		// $data['template'] = 'sections/index';
		// $this->load->view('templates/home_template', $data);
		redirect('sections/all');
	}


	public function all($offset=0)
	{		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['sections']=$this->admin_model->get_pagination_result('sections', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'sections/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('sections', 0, 0);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
		$data['template'] = 'sections/all';
		$this->load->view('templates/admin_template', $data);		
	}	

	public function add()
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		
		// $this->form_validation->set_rules('heading', 'Heading', 'required');				
		// $this->form_validation->set_rules('sub_heading', 'Sub-Heading', 'required');				
		$this->form_validation->set_rules('button_text', 'Button Text', 'required');				
		$this->form_validation->set_rules('button_link', 'Button Link', 'required');				
	
		// if(isset($_FILES['icon']['name']) && $_FILES['icon']['name']=="")
		// {
 	// 		$this->form_validation->set_rules('icon', 'Icon', 'required');				
		// }
		if(isset($_FILES['image']['name']) && $_FILES['image']['name']=="")
		{
			$this->form_validation->set_rules('image', 'Image', 'required');				
		}

		if ($this->form_validation->run() == TRUE){
			$post_data=array(				
							// 'slug' => create_slug('sections', $_POST['heading']),			
			        		'created'  		=> date('Y-m-d h:i:s'),
			        		'heading'=>$_POST['heading'],
			        		'sub_heading'=>$_POST['sub_heading'],
			        		'button_text'=>$_POST['button_text'],
			        		'button_link'=>$_POST['button_link'],
			            	);


			// if($_FILES['icon']['name']!='')
			// {
			// 	$config['upload_path'] = './assets/uploads/sections/icon/';
			// 	$config['allowed_types'] = 'gif|jpg|png';
			// 	// $config['max_size']	= '';
			// 	// $config['max_width']  = '80';
			// 	// $config['max_height']  = '80';
			// 	$this->load->library('upload', $config);

			// 	if (! $this->upload->do_upload('icon'))
			// 	{
			// 		$this->session->set_flashdata('error_msg', $this->upload->display_errors());
			// 		redirect('sections/add');
			// 	}
			// 	else
			// 	{
			// 		$upload_data = $this->upload->data();			
			// 		$post_data['icon']=$upload_data['file_name'];
			// 		create_thumb($post_data['icon'], './assets/uploads/sections/icon/');
			// 	}
			// }

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/sections/image/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				// $config['max_width'] = '1400';
				// $config['max_height'] = '700';

				$this->load->library('upload', $config);
                $this->upload->initialize($config);
				if (!$this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('sections/add');
				}
				else
				{
					$upload_data = $this->upload->data();			
					$post_data['image']=$upload_data['file_name'];
					create_thumb($post_data['image'], './assets/uploads/sections/image/');
				}
			}

			$post_id = $this->admin_model->insert('sections',$post_data);
			$this->session->set_flashdata('success_msg','Sections Added.');						
			redirect('sections/all');
		}
		$data['template'] = 'sections/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($id="")
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		
		if(empty($id))
			redirect('sections/all');
		
		$data['sections']=$this->admin_model->get_row('sections',array('id'=>$id));		
		
		// $this->form_validation->set_rules('heading', 'Heading', 'required');				
		// $this->form_validation->set_rules('sub_heading', 'Sub-Heading', 'required');				
		$this->form_validation->set_rules('button_text', 'Button Text', 'required');				
		$this->form_validation->set_rules('button_link', 'Button Link', 'required');				
			
		if ($this->form_validation->run() == TRUE)
		{
			$post_data=array(				
							// 'slug' => create_slug_for_update('sections', $_POST['heading']),			
			        		'updated'  		=> date('Y-m-d h:i:s'),
			        		'heading'=>$_POST['heading'],
			        		'sub_heading'=>$_POST['sub_heading'],
			        		'button_text'=>$_POST['button_text'],
			        		'button_link'=>$_POST['button_link'],
			            	);

			// if($_FILES['icon']['name']!='')
			// {
			// 	$config['upload_path'] = './assets/uploads/sections/icon/';
			// 	$config['allowed_types'] = 'gif|jpg|png';
			// 	// $config['max_size']	= '';
			// 	$config['max_width']  = '60';
			// 	$config['max_height']  = '60';
			// 	$this->load->library('upload', $config);

			// 	if (! $this->upload->do_upload('icon'))
			// 	{
			// 		$this->session->set_flashdata('error_msg', $this->upload->display_errors());
			// 		redirect('sections/edit/'.$slug);
			// 	}
			// 	else
			// 	{
			// 		$upload_data = $this->upload->data();			
			// 		$post_data['icon']=$upload_data['file_name'];
			// 		create_thumb($post_data['icon'], './assets/uploads/sections/icon/');
			// 	    delete_image($data['sections']->icon,'./assets/uploads/sections/icon/');
			// 	}
			// }

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/sections/image/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				// $config['max_width'] = '1400';
				// $config['max_height'] = '700';

				$this->load->library('upload', $config);
                $this->upload->initialize($config);
				if (!$this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('sections/edit/'.$slug);
				}
				else
				{
					$upload_data = $this->upload->data();			
					$post_data['image']=$upload_data['file_name'];
					create_thumb($post_data['image'], './assets/uploads/sections/image/');
				    delete_image($data['sections']->image,'./assets/uploads/sections/image/');
				}
			}
			
		    $this->admin_model->update('sections',$post_data, array('id'=>$id));
			$this->session->set_flashdata('success_msg','Sections Updated.');						
			redirect('sections/all');
		}		
		$data['template'] = 'sections/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($id="")
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		if(empty($id))
			redirect('sections/all');
		
		$data =	$this->admin_model->get_row('sections', array('id'=> $id));
		delete_image($data->icon, './assets/uploads/sections/icon/');
		delete_image($data->image, './assets/uploads/sections/image/');
		$this->admin_model->delete('sections',array('id'=> $id));		
		$this->session->set_flashdata('success_msg',"Sections has been deleted successfully.");
		redirect('sections/all');
	}
}