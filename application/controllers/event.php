<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event extends CI_Controller
{
   public function __construct()
   {
		parent::__construct();
		$this->load->model('admin_model');
   }

   public function all($offset=0)
	{
		if(admin_login_in()===FALSE)
			redirect('login/admin_login');


 		$limit=10;
 		$data['rows'] = $this->admin_model->get_pagination_result('event',$limit,$offset);
 		$config = get_theme_pagination();
 		$config['base_url'] = base_url()._INDEX.'event/all/';
 		$config['total_rows'] = $this->admin_model->get_pagination_result('event',0,0);
 		$config['per_page'] = $limit;
 		$this->pagination->initialize($config);
 		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'event/all';
		$this->load->view('templates/admin_template',$data);
	}

	public function add()
	{
		if(admin_login_in()===FALSE)
			redirect('login/admin_login');


        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('description','Description','trim|');
        $this->form_validation->set_rules('image','Image','trim|callback_file_validation[image;;png,jpeg,gif,jpg;10]');
        $this->form_validation->set_rules('order','Order','required|numeric|');

		if($this->form_validation->run() == TRUE)
		{

			$insert = array(
				'slug' => create_slug('event',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
			
				'order' => $this->input->post('order'),
				'created' => time()
			);

			$insert['image'] = ' ';
			if($_FILES['image']['name']!=''){
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$insert['image'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/event/'.$insert['image']);
   				create_thumb($insert['image'],'./assets/uploads/event/');
			}

		    $this->admin_model->insert('event',$insert);
		    $this->session->set_flashdata('success_msg','Added successfully.');
            redirect(_INDEX.'event/all');
		}
		$data['template'] = 'event/add';
        $this->load->view('templates/admin_template',$data);
	}

	public function edit($slug=''){
		if(admin_login_in()===FALSE)
			redirect('login/admin_login');

    	$data['rows'] = $this->admin_model->get_row('event',array('slug'=>$slug));	

        $this->form_validation->set_rules('title','Title','required|');
        $this->form_validation->set_rules('description','Description','trim|');
        $this->form_validation->set_rules('image','Image','callback_file_validation[image;;png,jpeg,gif,jpg;10]');
        $this->form_validation->set_rules('order','Order','required|numeric|');

		if($this->form_validation->run() == TRUE)
		{

			$update = array(
				'slug' => create_slug_for_update('event',$this->input->post('title')),
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
			
				'order' => $this->input->post('order'),
				'updated' => time()
			);

			$update['image'] = $data['rows']->image;
			if($_FILES['image']['name']!='')
			{
				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$update['image'] = uniqid().'.'.$ext;
   				move_uploaded_file($_FILES['image']['tmp_name'],'./assets/uploads/event/'.$update['image']);
   				create_thumb($update['image'],'./assets/uploads/event/');
   				@unlink('./assets/uploads/event/'.$data['rows']->image);
   				@unlink('./assets/uploads/event/thumbs/'.$data['rows']->image);
			}

		    $where = array('slug' => $slug);
		    $this->admin_model->update('event',$update,$where);
		    $this->session->set_flashdata('success_msg','Updated successfully.');
           redirect(_INDEX.'event/all');
		}
		$data['template'] = 'event/edit';
       $this->load->view('templates/admin_template',$data);
	}

	public function delete($slug='')
	{
		if(admin_login_in()===FALSE)
			redirect('login/admin_login');

		$where = array('slug' => $slug);
	    $row = $this->admin_model->get_row('event',$where);	
	    $this->admin_model->delete('event',$where);	

   		@unlink('./assets/uploads/event/'.$row->image);
   		@unlink('./assets/uploads/event/thumbs/'.$row->image);
		$this->session->set_flashdata('success_msg','Deleted successfully.');
        redirect(_INDEX.'event/all');
	}

	public function file_validation($post=NULL,$parameter)
	{
		list($file,$required,$types,$size) = explode(';',$parameter);
		if($required != ''){ 
			if($_FILES[$file]['name'] == ''){
				$this->form_validation->set_message('file_validation','Please select an file to upload.');
				return false;
			}
		}
		
		if($_FILES[$file]['name'] == ''){
			return true;
		}
		
		if($types != ''){
			$format = strtolower(pathinfo($_FILES[$file]['name'],PATHINFO_EXTENSION));
			$types_array = explode(',',$types);
			if(!in_array($format,$types_array)){
				$this->form_validation->set_message('file_validation','File format not allowed.');
				return false;
			}
		}
		
		if($size != ''){
			$actual_size = $_FILES[$file]['size']/1048576;
			if($actual_size > $size){
				$this->form_validation->set_message('file_validation','File not allowed which is large than '.$size.' MB.');
				return FALSE;
			}
		}
		return true;
	}


}
?>