<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index()
	{
		$data['menuactive'] = '';
		$data['pagetitle'] = 'Gallery';
		
		$this->db->order_by('order', 'asc');
		$data['gallery'] = $this->admin_model->get_result('gallery');
		$data['template'] = 'gallery/index';
		$this->load->view('templates/home_template', $data);
	}

	public function detail($slug="")
	{
		if($slug == "")
			redirect('gallery');

		$data['menuactive'] = '';
		$data['pagetitle'] = 'Gallery';


		$data['gallery_info'] = $this->admin_model->get_row('gallery', array('slug'=>$slug));
		if(!$data['gallery_info'])
			redirect('gallery');
		$data['gallery_images_info'] = $this->admin_model->get_result('gallery_images',array('gallery_id'=>$data['gallery_info']->id));
		$data['template'] = 'gallery/detail';
		$this->load->view('templates/home_template', $data);

	}


	public function page(){
		if(admin_login_in()===FALSE){
			redirect('login');
		}
		$where = array('slug' => 'gallery');
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
		$data['template'] = 'contents/gallery';
		$this->load->view('templates/admin_template', $data);
	}


	public function all($offset=0)
	{		
		if(admin_login_in()===FALSE)
			redirect('login');
		$limit=10;
		$data['gallery']=$this->admin_model->get_pagination_where('gallery', $limit, $offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'gallery/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_where('gallery', 0, 0 );
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'gallery/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function add()
	{
		 if(admin_login_in()===FALSE)
			redirect('login');

        $this->form_validation->set_rules('name','Name','trim');
        $this->form_validation->set_rules('order','Order','trim|required|numeric');
        $this->form_validation->set_rules('image','Image','trim|callback_file_validation['.@$_FILES['image']['name'].';required;png,jpeg,gif,jpg]');

		if($this->form_validation->run() == TRUE)
		{
			$data=array(
				'name'=>$this->input->post('name'),
				'order'=>$this->input->post('order'),
				'slug' => create_slug('gallery', $this->input->post('name')),
				'created' => date('Y-m-d')		
			);			

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/gallery/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				// $config['max_width']  = '80';
				// $config['max_height']  = '80';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('gallery/add');
				}
				else
				{
					$upload_data = $this->upload->data();			
					$data['image']=$upload_data['file_name'];
					create_thumb($data['image'], './assets/uploads/gallery/');
				}
			}

			
			$this->admin_model->insert('gallery',$data);		
			$this->session->set_flashdata('success_msg',"Gallery has been added successfully.");
			redirect('gallery/all');
		}

		$data['template'] = 'gallery/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug = "")
	{

		 if(admin_login_in()===FALSE)
			redirect('login');

		$data['gallery'] = $this->admin_model->get_row('gallery', array('slug'=>$slug));



		if(empty($data['gallery']))
		{
			redirect('gallery/all');
		}

        $this->form_validation->set_rules('name','Name','trim');
        $this->form_validation->set_rules('order','Order','trim|required|numeric');
        $this->form_validation->set_rules('image','Image','trim|callback_file_validation['.@$_FILES['image']['name'].';;png,jpeg,gif,jpg]');

		if($this->form_validation->run() == TRUE)
		{
			$update_data=array(
				'name'=>$this->input->post('name'),
				'order'=>$this->input->post('order'),
				'slug' => create_slug_for_update('gallery', $this->input->post('name')),
				'updated' => date('Y-m-d')		
			);			

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/gallery/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				// $config['max_width']  = '80';
				// $config['max_height']  = '80';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('gallery/edit');
				}
				else
				{
					$upload_data = $this->upload->data();			
					$update_data['image']=$upload_data['file_name'];
					create_thumb($update_data['image'], './assets/uploads/gallery/');
             		delete_image($data['gallery']->image, './assets/uploads/gallery/');
				}
			}

			
			$this->admin_model->update('gallery',$update_data, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg',"Gallery has been updated successfully.");
			redirect('gallery/all');
		}

		
		
		$data['template'] = 'gallery/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($id = "")
	{

		 if(admin_login_in()===FALSE)
			redirect('login');

		$row = $this->admin_model->get_row('gallery', array('id'=>$id));
		if($row == "")
		{
			redirect('gallery/all');
		}
		

		$this->admin_model->delete('gallery', array('id'=>$id));
        delete_image($row->image,'./assets/uploads/gallery/');
		
		$result = $this->admin_model->get_result('gallery_images', array('gallery_id'=>$row->id));
		$this->admin_model->delete('gallery_images', array('gallery_id'=>$row->id));
		
		if(!empty($result))
		{
			foreach ($result as $value)
			{
              delete_image($value->image,'./assets/uploads/gallery_images/');
			}
		}
		
		$this->session->set_flashdata('success_msg',"Gallery has been deleted successfully.");
		redirect('gallery/all');
	}



	public function all_images($gallery_slug="",$offset=0)
	{		
  		$data['gallery_info'] = $this->admin_model->get_row('gallery',array('slug'=>$gallery_slug));
		
		if($data['gallery_info']=="")
		{
			redirect('gallery/all');
		}

		if(admin_login_in()===FALSE)
			redirect('login');
		$limit=10;
		$data['gallery_images']=$this->admin_model->get_pagination_where('gallery_images', $limit, $offset,array('gallery_id'=>$data['gallery_info']->id));
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'gallery_images/all/'.$gallery_slug;
		$config['total_rows'] = $this->admin_model->get_pagination_where('gallery_images', 0, 0 ,array('gallery_id'=>$data['gallery_info']->id));
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'gallery/all_images';
        $this->load->view('templates/admin_template', $data);			
	}	

	public function add_images($gallery_slug="")
	{
		 if(admin_login_in()===FALSE)
			redirect('login');

  		$data['gallery_info'] = $this->admin_model->get_row('gallery',array('slug'=>$gallery_slug));
      
		if($data['gallery_info']=="")
		{
	    	redirect('gallery/all');
		}

		if ($_POST)
		{			
			$data=array(
				'name'=>$this->input->post('name'),
				'gallery_id'=>$data['gallery_info']->id,
				'slug' => create_slug('gallery_images', $this->input->post('name')),
				'created' => date('Y-m-d')		
			);			

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/gallery_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				// $config['max_width']  = '80';
				// $config['max_height']  = '80';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('gallery/add_images/'.$gallery_slug);
				}
				else
				{
					$upload_data = $this->upload->data();			
					$data['image']=$upload_data['file_name'];
					create_thumb($data['image'], './assets/uploads/gallery_images/');
				}
			}

			
			$this->admin_model->insert('gallery_images',$data);		
			$this->session->set_flashdata('success_msg',"Gallery Image has been added successfully.");
			redirect('gallery/all_images/'.$gallery_slug);
		}

		$data['template'] = 'gallery/add_images';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit_images($slug = "")
	{

		 if(admin_login_in()===FALSE)
			redirect('login');

  		$data['gallery_images_info'] = $this->admin_model->get_row('gallery_images',array('slug'=>$slug));
  		
  		$data['gallery_info'] = $this->admin_model->get_row('gallery',array('id'=>$data['gallery_images_info']->gallery_id));
      
		if($data['gallery_images_info']=="")
		{
	    	redirect('gallery/all');
		}


		if ($_POST)
		{			
			$update_data=array(
				'name'=>$this->input->post('name'),
				'slug' => create_slug_for_update('gallery_images', $this->input->post('name')),
				'updated' => date('Y-m-d')		
			);			

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/gallery_images/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				// $config['max_width']  = '80';
				// $config['max_height']  = '80';
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('gallery/edit_images/'.$slug);
				}
				else
				{
					$upload_data = $this->upload->data();			
					$update_data['image']=$upload_data['file_name'];
					create_thumb($update_data['image'], './assets/uploads/gallery_images/');
             		delete_image($data['gallery_images_info']->image, './assets/uploads/gallery_images/');
				}
			}

			
			$this->admin_model->update('gallery_images',$update_data, array('slug'=>$slug));
			$this->session->set_flashdata('success_msg',"Gallery Image has been updated successfully.");
			redirect('gallery/all_images/'.$data['gallery_info']->slug);
		}

		
		
		$data['template'] = 'gallery/edit_images';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete_images($id = "")
	{

		 if(admin_login_in()===FALSE)
			redirect('login');

		$row = $this->admin_model->get_row('gallery_images',array('id'=>$id));

		$this->admin_model->delete('gallery_images', array('id'=>$row->id));
		
		delete_image($row->image,'./assets/uploads/gallery_images/');
		
		$gallery_row = $this->admin_model->get_row('gallery',array('id'=>$row->gallery_id));
	
		$this->session->set_flashdata('success_msg',"Gallery Image has been deleted successfully.");
		redirect('gallery/all_images/'.$gallery_row->slug);
	}


	public function file_validation($post='0',$parameter)
	{
		list($image,$required,$types) = explode(';',$parameter);
		$image_array = explode('.',$image);
		$format = $image_array[count($image_array)-1];
		$format = strtolower($format);
		$types_array = explode(',',$types);

		if($required == '' && $types == ''){
			return true;
		}

		if($required != '' && $types == ''){
			if($image==''){
				$this->form_validation->set_message('file_validation','Please select an file to upload.');
				return false;
			}else{
				return true;
			}
		}

		if($required == '' && $types != ''){
			if($image==''){
 				return true;
			}else{
				if(in_array($format,$types_array)){
					return true;
				}else{
					$this->form_validation->set_message('file_validation','File format not allowed.');
					return false;
				}
			}
		}

		if($required != '' && $types != ''){
			if($image==''){
				$this->form_validation->set_message('file_validation','Please select an file to upload.');
				return false;
			}else{
				if(in_array($format,$types_array)){
					return true;
				}else{
					$this->form_validation->set_message('file_validation','File format not allowed.');
					return false;
				}
			}
		}
	}


	// public function test(){
	// 	$gallery = $this->admin_model->get_result('gallery');
 //       $i=1;
 //        foreach ($gallery as $key => $value) {
	// 		$this->admin_model->update('gallery',array('order'=>$i),array('id'=>$value->id));
 //             $i++;
 //        }
	// } 




}