<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home2 extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	public function index(){
		$data['menuactive'] = '';
		$data['pagetitle'] = 'Homepage';
		$data['homevideos'] = $this->admin_model->get_result('homevideos');
		$data['page_content'] = $this->admin_model->get_row('page_content', array('slug'=>'home_subheadings'));
		$data['posts'] = $this->admin_model->get_result('posts', array('status'=>1),NUll,array('field'=>'id','order'=>'desc'),3);		
		$data['mentions'] = $this->admin_model->get_result('mentions',NULL ,NULL,array('field'=>'id','order'=>'desc'),4);		
		$data['happy_clients'] = $this->admin_model->get_result('happy_clients',NULL ,NULL,array('field'=>'order','order'=>'asc'),6);		
		$data['template'] = 'home2/index';
		$this->load->view('templates/home_template', $data);
	}

	public function test_video(){
		$data['menuactive'] = '';
		$data['pagetitle'] = 'Homepage';
		$data['homevideos'] = $this->admin_model->get_result('homevideos');
		$data['page_content'] = $this->admin_model->get_row('page_content', array('slug'=>'home_subheadings'));
		$data['posts'] = $this->admin_model->get_result('posts', array('status'=>1),NUll,array('field'=>'id','order'=>'desc'),3);		
		$data['mentions'] = $this->admin_model->get_result('mentions',NULL ,NULL,array('field'=>'id','order'=>'desc'),4);		
		$data['happy_clients'] = $this->admin_model->get_result('happy_clients',NULL ,NULL,array('field'=>'order','order'=>'asc'),6);		
		$this->load->view('home/test_video', $data);
	}



	public function addVideo(){
		if(admin_login_in()===FALSE)
			redirect('login');

		$this->form_validation->set_rules('order', 'Order', 'required|is_unique[homevideos.order]');
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
					'order'  		=> $this->input->post('order'),
					'heading'  		=> $this->input->post('heading'),
					'subheading'  	=> $this->input->post('subheading'),
					'btn_text'  	=> $this->input->post('btn_text'),
					'btn_link'  	=> $this->input->post('btn_link'),
					'updated'  		=> date('Y-m-d h:i:s'),
					'created'  		=> date('Y-m-d h:i:s'),
				);
			// print_r($_FILES);
			// die();
			$mp4 = $this->do_video_upload('mp4', './assets/uploads/videos/');

			$webm = $this->do_video_upload('webm', './assets/uploads/videos/');

			$ogv = FALSE;

			if ($_FILES['ogv']['name'] != '')
				$ogv = $this->do_video_upload('ogv', './assets/uploads/videos/');

			if ($mp4)
				$post_data['mp4'] = $mp4;
			else{
				$this->session->set_flashdata('error_msg', 'File upload failed.');
				redirect('home/allVideos');
			}

			if ($webm)
				$post_data['webm'] = $webm;
			else{
				if ($mp4)
					$this->delete_video($mp4);

				$this->session->set_flashdata('error_msg', 'File upload failed.');
				redirect('home/allVideos');
			}
			
				if ($ogv)
				$post_data['ogv'] = $ogv;
			$this->admin_model->insert('homevideos',$post_data);
			$this->session->set_flashdata('success_msg','Video has been added successfully.');
			redirect('home/allVideos');
		}

		$data['template'] = 'home/addVideo';
        $this->load->view('templates/admin_template', $data);
	}

	public function allVideos($offset=0){		
		if(admin_login_in()===FALSE) redirect('login');

		$limit=10;
		$data['videos']	= $this->admin_model->get_pagination_result('homevideos', $limit,$offset);
		$config = get_theme_pagination();	
		$config['base_url'] = base_url().'home/allVideos/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('homevideos', 0, 0);
		$config['per_page'] = $limit;
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		
	    $data['template'] = 'home/allVideo';
	    $this->load->view('templates/admin_template', $data);
	}

	public function editVideo($id=''){
		if(admin_login_in()===FALSE)
			redirect('login');
			$data['video'] = $this->admin_model->get_row('homevideos', array('id' => $id));
			if (empty($data['video'])) {
				$this->session->set_flashdata('error_msg', 'No item found...');
				redirect('home/allVideos');
			}
			$this->form_validation->set_rules('order', 'Order', 'required|callback_check_video_order['.$data['video']->order.']');
			$this->form_validation->set_rules('mp4', 'MP4', 'callback_check_mp4_file');
			$this->form_validation->set_rules('webm', 'webm', 'callback_check_webm_file');
			$this->form_validation->set_rules('ogv', 'Ogv', 'callback_check_ogv_file');
			$this->form_validation->set_rules('heading', 'heading', 'xss_clean');
			$this->form_validation->set_rules('subheading', 'subheading', 'xss_clean');
			$this->form_validation->set_rules('btn_text', 'btn_text', 'xss_clean');
			$this->form_validation->set_rules('btn_link', 'btn_link', 'xss_clean');
			$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
			
			if ($this->form_validation->run() == TRUE){
				$post_data=array(
						'order'  		=> $this->input->post('order'),
						'heading'  		=> $this->input->post('heading'),
						'subheading'  	=> $this->input->post('subheading'),
						'btn_text'  	=> $this->input->post('btn_text'),
						'btn_link'  	=> $this->input->post('btn_link'),
						'updated'  		=> date('Y-m-d h:i:s'),
						'created'  		=> date('Y-m-d h:i:s'),
					);
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
						redirect('home/allVideos');
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
						redirect('home/allVideos');
					}
				}

				$this->admin_model->update('homevideos', $post_data, array('id' => $id));
				$this->session->set_flashdata('success_msg','Video has been Updated successfully.');
				redirect('home/allVideos');
		}		

		$data['template'] = 'home/editVideo';
        $this->load->view('templates/admin_template', $data);		
	}

	public function editPlaylist(){
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$id = 1;

		$data['video'] = $this->admin_model->get_row('youtube_playlist', array('id' => $id));
		if (empty($data['video'])) {
			$this->session->set_flashdata('error_msg', 'No item found...');
			redirect('home/allVideos');
		}
			$this->form_validation->set_rules('playlist_id', 'playlist_id', 'required');
			$this->form_validation->set_rules('heading', 'heading', 'xss_clean');
			$this->form_validation->set_rules('subheading', 'subheading', 'xss_clean');
			$this->form_validation->set_rules('btn_text', 'btn_text', 'xss_clean');
			$this->form_validation->set_rules('btn_link', 'btn_link', 'xss_clean');
			$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
			
			if ($this->form_validation->run() == TRUE){
				$post_data=array(
						'playlist_id'  	=> $this->input->post('playlist_id'),
						'heading'  		=> $this->input->post('heading'),
						'subheading'  	=> $this->input->post('subheading'),
						'btn_text'  	=> $this->input->post('btn_text'),
						'btn_link'  	=> $this->input->post('btn_link'),
						'updated'  		=> date('Y-m-d h:i:s'),
						'created'  		=> date('Y-m-d h:i:s'),
					);
			
				$this->admin_model->update('youtube_playlist', $post_data, array('id' => $id));
				$this->session->set_flashdata('success_msg','Playlist has been Updated successfully.');
				redirect(current_url());
		}		

		$data['template'] = 'home/editPlaylist';
        $this->load->view('templates/admin_template', $data);		
	}	


	public function deleteVideo($id=""){
		if(admin_login_in()===FALSE)
			redirect('login');

		$data =	$this->admin_model->get_row('homevideos', array('id'=> $id));

		if(empty($data))
			redirect('home/allVideos');
		else{
			$this->delete_video($data->mp4);
			$this->delete_video($data->webm);
		}

		$this->admin_model->delete('homevideos',array('id'=> $id));
		$this->session->set_flashdata('success_msg',"Video has been deleted successfully.");
		redirect('home/allVideos');
	}

	public function delete_video($video='', $path='./assets/uploads/videos/')
	{
		if (!empty($video)) {
			@unlink( $path.$video);
		}
		return TRUE;
	}

	public function check_video_order($old_order)
	{
		// echo "Order : ".$old_order;
		// die();
		if ($old_order == $this->input->post('order')) {
			return TRUE;
		}else{
			$is_unique = $this->admin_model->get_row('homevideos', array('order' => $this->input->post('order')));
			if ($is_unique) {
				$this->form_validation->set_message('check_video_order','This order is not available.');
				return FALSE;
			}
		}
		return TRUE;
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