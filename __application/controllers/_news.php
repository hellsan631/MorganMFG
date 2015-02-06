<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class News extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('admin_model');

	}



	public function index(){
		$category = 'ALL';
		$limit = 6;
		$offset=0;
		$data['menuactive'] = 'news';

		$data['pagetitle'] = 'News';


		// $data['news'] = $this->admin_model->get_result('posts', array('status'=>1));
		$data['news'] = $this->admin_model->get_news($category, $limit, $offset);
		$data['categories'] = $this->admin_model->get_result('categories', array("type"=>1));
		$data['template'] = 'news/index';

		$this->load->view('templates/home_template', $data);

	}


	public function category($category="ALL"){
		$offset = 0;
		$limit = 6;
		$data['menuactive'] = 'news';
		$data['pagetitle'] = 'News';

		if($_POST){
			$offset = $_POST['offset'];
			$news = $this->admin_model->get_news($category, $limit, $offset);
			$res = "";
			if ($news){
			 foreach($news as $row):
	        	$res .= '<div class="col-sm-6 nws">
	                <a href="'.base_url().'news/detail/'.$row->slug.'">
	                    <img src="'.base_url().'assets/uploads/news/'.$row->image.'" style="width:100%">
	                    <span class="date">
	                    <small>'.date('M', strtotime($row->created)).'</small>
	                    <br>'.date('d', strtotime($row->created)).'</span>
	                </a>
	                <a href="'.base_url().'news/detail/'.$row->slug.'"><h4>'.$row->title.'</h4></a>
	                <p> '.word_limiter($row->excerpt,10).'</p>
	            </div>';
	      	 endforeach;
	      	 echo json_encode(array('status' => true, 'res' => $res));
	  		}else{
	  			echo json_encode(array('status' => false));
	  		}
	      // if($res !="")
	      // 	echo $res;
	      // else
	      // 	return FALSE;
	      die();
		}

		$data['news'] = $this->admin_model->get_news($category, $limit, $offset);
		$data['categories'] = $this->admin_model->get_result('categories', array("type"=>1));
		$data['template'] = 'news/index';
		$this->load->view('templates/home_template', $data);

	}



	public function detail($slug=""){
		if($slug == "")
			redirect('news');

		$data['menuactive'] = 'news';
		$data['pagetitle'] = 'News';


		$data['post'] = $this->admin_model->get_row('posts', array('slug'=>$slug));
		$data['categories'] = $this->admin_model->get_result('categories', array("type"=>1));
		$data['related'] = $this->admin_model->get_relatednews($data['post']->category_id);
		$data['template'] = 'news/detail';
		$this->load->view('templates/home_template', $data);

	}

	public function all($offset=0){	
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['news']=$this->admin_model->get_pagination_result('posts', $limit,$offset);

		$config= get_theme_pagination();	

		$config['base_url'] = base_url().'news/all/';

		$config['total_rows'] = $this->admin_model->get_pagination_result('posts', 0, 0);

		$config['per_page'] = $limit;

		// $config['num_links'] = 5;		

		$this->pagination->initialize($config); 		

		$data['pagination'] = $this->pagination->create_links();		



        $data['template'] = 'news/all';

        $this->load->view('templates/admin_template', $data);			

	}	



	public function add(){

		 if(admin_login_in()===FALSE)

			redirect('login');

		$this->form_validation->set_rules('title', 'title', 'required');
		// $this->form_validation->set_rules('heading', 'heading', 'required');				
		$this->form_validation->set_rules('excerpt', 'excerpt', 'required');				
		$this->form_validation->set_rules('category_id', 'category', 'required');				
		$this->form_validation->set_rules('description', 'description', 'required');				

		$this->form_validation->set_rules('status', 'Status', 'required');						

		if ($this->form_validation->run() == TRUE){			

			$data=array(

				'slug' => create_slug('posts', $this->input->post('title')),							
				'title'=>$this->input->post('title'),
				'heading'=>$this->input->post('heading'),				
				'excerpt'=>$this->input->post('excerpt'),				
				'description'=>$this->input->post('description'),				
				'status'=>$this->input->post('status'),				
				'category_id'=>$this->input->post('category_id'),				
				// 'author_name'=>$this->input->post('author_name'),				
				// 'author_descrpition'=>$this->input->post('author_descrpition'),				
				'created' => date('Y-m-d H:i:s')		

			);



			if($_FILES['userfile']['name']!=''){

				$config['upload_path'] = './assets/uploads/news/';

				$config['allowed_types'] = 'gif|jpg|png';

				$config['max_size']	= '';

				$this->load->library('upload', $config);

				if (! $this->upload->do_upload()){

					$this->session->set_flashdata('error_msg', $this->upload->display_errors());

					redirect('news/add');

				}else{

				   $upload_data = $this->upload->data();			

				   $data['image']=$upload_data['file_name'];

				   create_thumb($data['image'], './assets/uploads/news/');

				}

			}else{

				$this->session->set_flashdata('error_msg', 'Please select an image to upload');

				redirect('news/add');

			}		

			

			$this->admin_model->insert('posts',$data);		

			$this->session->set_flashdata('success_msg',"Post has been added successfully.");

			redirect('news/all');

		}


		$data['category'] = $this->admin_model->get_result('categories', array('type'=>1));
		$data['template'] = 'news/add';

        $this->load->view('templates/admin_template', $data);		

	}



	public function edit($slug=""){

		if(admin_login_in()===FALSE)

			redirect('login');

		$this->form_validation->set_rules('title', 'title', 'required');
		// $this->form_validation->set_rules('heading', 'heading', 'required');				
		$this->form_validation->set_rules('excerpt', 'excerpt', 'required');				
		$this->form_validation->set_rules('category_id', 'category', 'required');				
		$this->form_validation->set_rules('description', 'description', 'required');

		$data['news'] = $this->admin_model->get_row('posts', array('slug'=>$slug));

		if (empty($data['news'])) {
			$this->session->set_flashdata('error_msg',"No news found.");
			redirect('news/all');

		}



		if ($this->form_validation->run() == TRUE){			

			$updatedata=array(

				'slug' => create_slug_for_update('posts', $this->input->post('title'), $data['news']->id),							
				'title'=>$this->input->post('title'),
				'heading'=>$this->input->post('heading'),				
				'excerpt'=>$this->input->post('excerpt'),				
				'description'=>$this->input->post('description'),				
				'status'=>$this->input->post('status'),				
				'category_id'=>$this->input->post('category_id'),				

			);



			if($_FILES['userfile']['name']!=''){


				$config['upload_path'] = './assets/uploads/news/';

				$config['allowed_types'] = 'gif|jpg|png';

				$config['max_size']	= '';

				$this->load->library('upload', $config);

				if (! $this->upload->do_upload()){

					$this->session->set_flashdata('error_msg', $this->upload->display_errors());

					redirect('news/edit/'.$slug);

				}else{
				   delete_image($data['news']->image, './assets/uploads/news/');
				   $upload_data = $this->upload->data();			
				   // print_r($upload_data); die();
				   $updatedata['image'] = $upload_data['file_name'];
				   create_thumb($updatedata['image'], './assets/uploads/news/');
				}
			}

			$this->admin_model->update('posts',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"Posts has been updated successfully.");
			redirect('news/all');

		}		

		$data['category'] = $this->admin_model->get_result('categories', array('type'=> 1));
		$data['template'] = 'news/edit';
        $this->load->view('templates/admin_template', $data);		

	}



	public function delete($slug=""){	

		if(admin_login_in()===FALSE)

			redirect('login');	

		

		$data =	$this->admin_model->get_row('posts', array('slug'=> $slug));

		delete_image($data->image, './assets/uploads/news/');



		$this->admin_model->delete('posts',array('slug'=> $slug));		

		$this->session->set_flashdata('success_msg',"post has been deleted successfully.");

		redirect('news/all');

	}

}