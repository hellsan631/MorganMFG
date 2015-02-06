<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index($slug="")
	{
		if($slug == ""){
			redirect('home');
		}
		$data['menuactive'] = 'page';
		$data['pagetitle'] = 'page';		
		$data['page'] = $this->admin_model->get_row('pages', array("slug" => $slug));
		$data['template'] = 'page/index';
		$this->load->view('templates/home_template', $data);
	}

	// public function header($slug)
	// {
	// 	if(admin_login_in()===FALSE)
	// 		redirect('login');
		
	// 	$data['header_content'] = $this->admin_model->get_row('header_content', array('slug'=> $slug));

	// 	$this->form_validation->set_rules('heading', 'Heading', 'required');						
	// 	// $this->form_validation->set_rules('content', 'Content', 'required');		
		
	// 	if($data['header_content']->image=="" && isset($_FILES['header_image']['name']) && $_FILES['header_image']['name']=="")
	// 	{
 //    		$this->form_validation->set_rules('header_image', 'Header Image', 'required');		
	// 	}
	

	// 	if (empty($data['header_content']))
	// 	{
	// 		redirect('admin');
	// 	}

	// 	if ($this->form_validation->run() == TRUE)
	// 	{			

 //        	$updatedata['content'] = $_POST['content']; 
	// 		if(isset($_FILES['header_image']['name']) && $_FILES['header_image']['name']!="")
	// 		{
 //            	$image_name = $this->do_core_upload('header_image','./assets/uploads/header/');
 //            	if($image_name)
 //            	{
	//             	$updatedata['image'] = $image_name;
	//             	@unlink('./assets/uploads/header/'.$data['header_content']->image);
 //            	}
	// 		}
 //            if(!empty($_POST['heading']))
 //            {
 //        	   $updatedata['heading'] = $_POST['heading']; 
 //            }

	// 		$this->admin_model->update('header_content',$updatedata, array('slug'=>$slug));		
	// 		$this->session->set_flashdata('success_msg',"Page Header has been updated successfully.");
	// 		redirect(base_url().'page/header/'.$slug);
	// 	}		
	// 	$data['template'] = 'page/edit_header';
 //        $this->load->view('templates/admin_template', $data);		
	// }	

	public function header($slug)
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$data['header_content'] = $this->admin_model->get_row('header_content', array('slug'=> $slug));

		// $this->form_validation->set_rules('heading', 'Heading', 'required');						
		// $this->form_validation->set_rules('content', 'Content', 'required');		
		
		if($data['header_content']->image=="" && isset($_FILES['header_image']['name']) && $_FILES['header_image']['name']=="")
		{
    		$this->form_validation->set_rules('header_image', 'Header Image', 'required');		
		}
	

		if (empty($data['header_content']))
		{
			redirect('admin');
		}

		// if ($this->form_validation->run() == TRUE)
		if ($_POST)
		{			

        	$updatedata['content'] = $_POST['content']; 
			if(isset($_FILES['header_image']['name']) && $_FILES['header_image']['name']!="")
			{
            	$image_name = $this->do_core_upload('header_image','./assets/uploads/header/');
            	if($image_name)
            	{
	            	$updatedata['image'] = $image_name;
	            	@unlink('./assets/uploads/header/'.$data['header_content']->image);
            	}
			}
       	    $updatedata['heading'] = $_POST['heading'];
       	    if ($slug == 'team' || $slug == 'catering' || $slug == 'catering_partners'){
       	    	$updatedata['midhead'] = $this->input->post('midhead');
       	    	$updatedata['middescription'] = $this->input->post('middescription');
       	    	$updatedata['midbuttontext'] = $this->input->post('midbuttontext');
       	    	$updatedata['midbuttonlink'] = $this->input->post('midbuttonlink');
       	    }
			$this->admin_model->update('header_content',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"Page Header has been updated successfully.");
			redirect(base_url().'page/header/'.$slug);
		}		
		$data['template'] = 'page/edit_header';
        $this->load->view('templates/admin_template', $data);		
	}

	public function all($offset=0)
	{		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['page']=$this->admin_model->get_pagination_result('pages', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'page/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('pages', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'page/all';
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
				'slug' => create_slug('pages', $this->input->post('title')),										
				'description'=>$this->input->post('description'),							
				'created' => date('Y-m-d H:i:s')		
			);		
			
			$this->admin_model->insert('pages',$data);		
			$this->session->set_flashdata('success_msg',"page has been added successfully.");
			redirect('page/all');
		}

		$data['template'] = 'page/add';
        $this->load->view('templates/admin_template', $data);		
	}

	public function edit($slug=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		$this->form_validation->set_rules('title', 'title', 'required');						
		$this->form_validation->set_rules('description', 'description', 'required');		
		$data['page'] = $this->admin_model->get_row('pages', array('slug'=> $slug));

		if (empty($data['page'])) {
			$this->session->set_flashdata('error_msg',"No page found.");
			redirect('page/all');
		}

		if ($this->form_validation->run() == TRUE){			
			$updatedata=array(
				'title'=>$this->input->post('title'),
				'slug' => create_slug_for_update('pages', $this->input->post('title'), $data['page']->id),											
				'description'=>$this->input->post('description'),	
			);			

			$this->admin_model->update('pages',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"page has been updated successfully.");
			redirect('page/all');
		}		
		$data['template'] = 'page/edit';
        $this->load->view('templates/admin_template', $data);		
	}

	public function delete($slug=""){
		if(admin_login_in()===FALSE)
			redirect('login');	
		$this->admin_model->delete('pages',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"page has been deleted successfully.");
		redirect('page/all');
	}

	public function do_core_upload($filename2='user_file' , $upload_path='./assets/uploads/custom_uploads/', $path_of_thumb='')
	{
		$allowed =  array('gif','png','jpg','jpeg','mp4');
		$filename = $_FILES[$filename2]['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed) ){
			return FALSE;
		}
		else{
			
			if ($_FILES[$filename2]["error"] > 0){
	 			return FALSE; 
	 		}
			else{
			 $name = uniqid();
			 if(move_uploaded_file($_FILES[$filename2]['tmp_name'],$upload_path.$name.'.'.$ext))
			 return $name.'.'.$ext;
			 else
			 return FALSE;
			}
		} 
	}
}