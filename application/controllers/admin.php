<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		clear_cache();
		if(admin_login_in()===FALSE)
			redirect('login/admin_login');
		$this->load->model('admin_model');
	}

	public function index(){
		$data['template'] = 'admin/dashboard';
		$this->load->view('templates/admin_template', $data);
	}

	public function form(){
		$data['template'] = 'admin/form';
		$this->load->view('templates/admin_template', $data);
	}

	public function logout(){
		$this->session->set_userdata('AdminInfo','');
		$this->session->unset_userdata('AdminInfo');
		$this->session->set_flashdata('success_msg','Logout successfully.');		
		redirect('login/admin_login');
	} 

	public function social_links(){		
		$this->form_validation->set_rules('facebook', 'facebook', 'required');			
		$this->form_validation->set_rules('twitter', 'twitter', 'required');			
		$this->form_validation->set_rules('instagram', 'instagram', 'required');			
		$this->form_validation->set_rules('googleplus', 'googleplus', 'required');			
		$this->form_validation->set_rules('twitter_username', 'twitter username', 'required');					
		if ($this->form_validation->run() == TRUE){
			$data = array(
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'instagram' => $this->input->post('instagram'),
				'googleplus' => $this->input->post('googleplus'),
				'twitter_username' => $this->input->post('twitter_username'),				
				);
			$this->admin_model->update('social_links',$data);		
			$this->session->set_flashdata('success_msg',"Updated");
			redirect(current_url());
		}

		$data['link'] = $this->admin_model->get_row('social_links', array('id'=>1));
		$data['template'] = 'admin/social_links';
        $this->load->view('templates/admin_template', $data);
	}


	public function change_fonts()
	{		
		$data['link'] = $this->admin_model->get_row('fonts', array('id'=>1));

		$this->form_validation->set_rules('font_url', 'font Url', 'required');			
		$this->form_validation->set_rules('paragraphs', 'paragraphs Font', 'required');			
		$this->form_validation->set_rules('body', 'Body Font', 'required');			
		$this->form_validation->set_rules('headers', 'Headers Font', 'required');					
		if ($this->form_validation->run() == TRUE){
			$update = array(
				'font_url' => $this->input->post('font_url'),
				'paragraphs' => $this->input->post('paragraphs'),
				'headers' => $this->input->post('headers'),
				'body' => $this->input->post('body'),
				);
			$this->admin_model->update('fonts',$update);				


			if($data['link']){
				$data['fonturl'] = $data['link']->font_url;
				$data['bodyfont'] = $data['link']->body;
				$data['headers'] = $data['link']->headers;
				$data['paragraphs'] = $data['link']->paragraphs;			
			}else{
				$data['fonturl']="";
				$data['bodyfont'] = "";
				$data['headers'] = "";
				$data['paragraphs'] = "";			
			}


			$str = $this->load->view('admin/changefonts', $data, TRUE);	
			// echo $str; die();
			$this->load->helper('file');
			if (! write_file('./assets/theme/css/changefont.css', $str)){
			    $this->session->set_flashdata('error_msg',"Could not write file, changes will not reflects Please update again.");
				redirect(current_url());
			}


			$this->session->set_flashdata('success_msg',"Updated");
			redirect(current_url());

		}		

		$data['template'] = 'admin/fonts';
        $this->load->view('templates/admin_template', $data);
	}

	public function site_content()
	{		
		$site_content = $this->admin_model->get_row('site_content',array('slug'=>'site_content'));

		// $this->form_validation->set_rules('heading', 'Heading', 'required');			
		$this->form_validation->set_rules('address', 'Address', 'required');			
		$this->form_validation->set_rules('city', 'City', 'required');			
		$this->form_validation->set_rules('zipcode', 'Zip Code', 'required');			
		$this->form_validation->set_rules('phone', 'Phone', 'required');					
		// $this->form_validation->set_rules('fax', 'Fax', 'required');					
		$this->form_validation->set_rules('country', 'Country', 'required');					
		
		$this->form_validation->set_rules('contact_email', 'Hours Email', 'required|valid_email');					
		// $this->form_validation->set_rules('contact_mon_to_thursday_start', 'Hours Start time', 'required');					
		// $this->form_validation->set_rules('contact_mon_to_thursday_end', 'Hours End Time', 'required');					
		// $this->form_validation->set_rules('contact_friday_start', 'Hours Start time', 'required');					
		// $this->form_validation->set_rules('contact_friday_end', 'Hours Start end', 'required');					
		
		if ($this->form_validation->run() == TRUE)
		{
			if(empty($site_content))
			{
				$insert = array(
					            'slug'=>'site_content',
								'heading' => $this->input->post('heading'),
								'address' => $this->input->post('address'),
								'city' => $this->input->post('city'),
								'zipcode' => $this->input->post('zipcode'),
								'phone' => $this->input->post('phone'),				
								'fax' => $this->input->post('fax'),
								'country' => $this->input->post('country'),				
								'contact_email' => $this->input->post('contact_email'),				
								'contact_mon_to_thursday_start' => $this->input->post('contact_mon_to_thursday_start'),				
								'contact_mon_to_thursday_end' => $this->input->post('contact_mon_to_thursday_end'),				
								'contact_friday_start' => $this->input->post('contact_friday_start'),				
								'contact_friday_end' => $this->input->post('contact_friday_end'),				
								);
				$this->admin_model->insert('site_content',$insert);		
				$this->session->set_flashdata('success_msg',"Content Added");
				redirect(current_url());
			}
			else
			{
				$update = array(
								'heading' => $this->input->post('heading'),
								'address' => $this->input->post('address'),
								'city' => $this->input->post('city'),
								'zipcode' => $this->input->post('zipcode'),
								'phone' => $this->input->post('phone'),				
								'fax' => $this->input->post('fax'),
								'country' => $this->input->post('country'),	
								'contact_email' => $this->input->post('contact_email'),				
								'contact_mon_to_thursday_start' => $this->input->post('contact_mon_to_thursday_start'),				
								'contact_mon_to_thursday_end' => $this->input->post('contact_mon_to_thursday_end'),				
								'contact_friday_start' => $this->input->post('contact_friday_start'),				
								'contact_friday_end' => $this->input->post('contact_friday_end'),				
								);

				if($_FILES['userfile']['name']!=''){
					$config['upload_path'] = './assets/uploads/home/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '';
					$config['max_width']  = '';
					$config['max_height']  = '';
					$this->load->library('upload', $config);
					if (! $this->upload->do_upload('userfile')){
						$this->session->set_flashdata('error_msg', $this->upload->display_errors());
						redirect('admin/site_content');
					}
					else{
						$upload_data = $this->upload->data();			
						$update['logo']=$upload_data['file_name'];
						//create_thumb($update['logo'], './assets/uploads/home/');
						if(!empty($site_content->logo)){
							@unlink('./assets/uploads/home/'.$site_content->logo);
						}
					}
				}

				$this->admin_model->update('site_content',$update,array('slug'=>'site_content'));		
				$this->session->set_flashdata('success_msg',"Content Updated");
				redirect(current_url());
			}
		}

		$data['site_content'] = $site_content;
		$data['template'] = 'admin/site_content';
        $this->load->view('templates/admin_template', $data);
	}

	public function profile()
	{		
		$admin = $this->session->userdata('AdminInfo');    
		
		$admin_info = $this->admin_model->get_row('users',array('id'=>$admin['id']));

		$this->form_validation->set_rules('first_name', 'First Name', 'required');			
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');			
		$this->form_validation->set_rules('description', 'description', 'required');			

	     if(isset($_FILES['image']['name']) && $_FILES['image']['name']=="" && $admin_info->image =="")
	     {
	 		$this->form_validation->set_rules('image', 'Image', 'required');					
	     }
		
		
		if ($this->form_validation->run() == TRUE)
		{
				$update = array(
								'first_name' => $this->input->post('first_name'),
								'last_name' => $this->input->post('last_name'),
								'description' => $this->input->post('description'),
								'updated' => $this->input->post('updated'),				
								);

			if($_FILES['image']['name']!='')
			{
				$config['upload_path'] = './assets/uploads/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				// $config['max_size']	= '';
				$config['max_width']  = '200';
				$config['max_height']  = '200';
				$this->load->library('upload', $config);
				if (! $this->upload->do_upload('image'))
				{
					$this->session->set_flashdata('error_msg', $this->upload->display_errors());
					redirect('admin/profile');
				}
				else
				{
					$upload_data = $this->upload->data();			
					$update['image']=$upload_data['file_name'];
					create_thumb($update['image'], './assets/uploads/profile/');
				}
			}

			$this->admin_model->update('users',$update,array('id'=>$admin['id']));		
			$this->session->set_flashdata('success_msg',"Profile Updated");
			redirect(current_url());
		}

		$data['admin_info'] = $admin_info;
		$data['template'] = 'admin/profile';
        $this->load->view('templates/admin_template', $data);
	}

	public function changePassword()
	{
		$admin = $this->session->userdata('AdminInfo');	
		$id = $admin['id'];
		$this->form_validation->set_rules('old', 'old password', 'required|callback_check_old_pwd');							
		$this->form_validation->set_rules('new', 'new password', 'required');							
		$this->form_validation->set_rules('con', 'confirm password', 'required|matches[new]');							
		if ($this->form_validation->run() == TRUE)
		{			
			$new = $this->input->post('new');
			$new = sha1(trim($new));
			$this->admin_model->update('users',array('password' => $new), array('id'=>$id));
			$this->session->set_flashdata('success_msg','Password has been changed successfully.');
			redirect(current_url());
		}

		$data['template'] = 'admin/changePassword';
        $this->load->view('templates/admin_template', $data);		
	}

 	public function  check_old_pwd($x)
 	{
		$admin = $this->session->userdata('AdminInfo');	
		$id = $admin['id'];
		$pwd=sha1($x);
		$row = $this->admin_model->get_row('users', array('id'=> $id));
		if($row->password == $pwd)
		{
			return TRUE;
		} 
		else
		{
			$this->form_validation->set_message('check_old_pwd','Please enter correct old password');
			return FALSE;
		}
 	}


}