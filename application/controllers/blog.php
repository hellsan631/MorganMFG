<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Blog extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('admin_model');

	}



	public function index($admin_id="")
	{
		$category = 'ALL';
		$limit = 6;
		$offset=0;
		$data['menuactive'] = 'blog';

		$data['pagetitle'] = 'Blog';
		$data['fixednav'] = TRUE;


		// $data['news'] = $this->admin_model->get_result('posts', array('status'=>1));
		$data['posts'] = $this->admin_model->get_news($category, $limit, $offset,$admin_id);
		$data['categories'] = $this->admin_model->get_result('categories');
		$data['template'] = 'blog/index';
		$this->load->view('templates/home_template', $data);

	}


	public function category($category="ALL"){
		$offset = 0;
		$limit = 6;
		$data['menuactive'] = 'blog';
		$data['pagetitle'] = 'blog';

		if($_POST){
			$offset = $_POST['offset'];
			$news = $this->admin_model->get_news($category, $limit, $offset);			
			$res = "";
			if ($news){
			$i=1;
			 foreach($news as $row):                
	        	$res .= '<div class="row blog-post"><div class="col-sm-6 nws">
	                		<img src="'.base_url().'assets/uploads/news/'.$row->image.'">
			                <div class="text">
			                  <h5>'.$row->title.'</h5>
			                <div  style="float:left; width:80%">
			                <p>'.word_limiter($row->excerpt, 20).'</p>
			                <a href="'.base_url().'blog/detail/'.$row->slug.'" class="btn btn-grey">READ MORE</a>
			                </div>
			                  <span class="date">'.date('M', strtotime($row->created)).'<br><strong>'.date('d', strtotime($row->created)).'</strong></span>
			                </div>
			              </div>';
			    if($i%2 == 0){
			    	$res .= '</div><div class="row blog-post">';
			    }
			 $i++;
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

		$data['posts'] = $this->admin_model->get_news($category, $limit, $offset);
		$data['categories'] = $this->admin_model->get_result('categories');
		$data['template'] = 'blog/index';
		$this->load->view('templates/home_template', $data);

	}



	public function detail($slug=""){
		if($slug == "")
			redirect('blog');

		$data['menuactive'] = 'blog';
		$data['pagetitle'] = 'blog';
		$data['fixednav'] = TRUE;


		$data['post'] = $this->admin_model->get_row('posts', array('slug'=>$slug));
		if(!$data['post'])
			redirect('blog');
		$data['categories'] = $this->admin_model->get_result('categories');
		$data['related'] = $this->admin_model->get_relatednews($data['post']->category_id,$data['post']->id);
		$data['template'] = 'blog/detail';
		$this->load->view('templates/home_template', $data);

	}

	public function all($offset=0)
	{	
		if(admin_login_in()===FALSE)
			redirect('login');

		$admin = $this->session->userdata('AdminInfo');    

		$limit=10;
		$data['news']=$this->admin_model->get_pagination_where('posts', $limit,$offset,array('admin_id'=>$admin['id']));

		$config= get_theme_pagination();	

		$config['base_url'] = base_url().'blog/all/';

		$config['total_rows'] = $this->admin_model->get_pagination_where('posts', 0, 0,array('admin_id'=>$admin['id']));

		$config['per_page'] = $limit;

		// $config['num_links'] = 5;		

		$this->pagination->initialize($config); 		

		$data['pagination'] = $this->pagination->create_links();		



        $data['template'] = 'blog/all';

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

		$admin = $this->session->userdata('AdminInfo');    

			$data=array(

				'slug' => create_slug('posts', $this->input->post('title')),							
				'title'=>$this->input->post('title'),
				'admin_id' => $admin['id'],
				//'heading'=>$this->input->post('heading'),				
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

					redirect('blog/add');

				}else{

				   $upload_data = $this->upload->data();			

				   $data['image']=$upload_data['file_name'];

				   create_thumb($data['image'], './assets/uploads/news/');

				}

			}else{

				$this->session->set_flashdata('error_msg', 'Please select an image to upload');

				redirect('blog/add');

			}		

			

			$this->admin_model->insert('posts',$data);		

			$this->session->set_flashdata('success_msg',"Post has been added successfully.");

			redirect('blog/all');

		}


		$data['category'] = $this->admin_model->get_result('categories');
		$data['template'] = 'blog/add';

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
			$this->session->set_flashdata('error_msg',"No Post found.");
			redirect('blog/all');

		}



		if ($this->form_validation->run() == TRUE){			

			$updatedata=array(

				'slug' => create_slug_for_update('posts', $this->input->post('title'), $data['news']->id),							
				'title'=>$this->input->post('title'),
				//'heading'=>$this->input->post('heading'),				
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
			redirect('blog/all');

		}		

		$data['category'] = $this->admin_model->get_result('categories');
		$data['template'] = 'blog/edit';
        $this->load->view('templates/admin_template', $data);		

	}

	public function crop($slug=""){

		if(admin_login_in()===FALSE)

			redirect('login');

		$data['news'] = $this->admin_model->get_row('posts', array('slug'=>$slug));

		if (empty($data['news'])) {
			$this->session->set_flashdata('error_msg',"No Post found.");
			redirect('blog/all');

		}

		$this->form_validation->set_rules('w', 'w', 'required');
		$this->form_validation->set_rules('h', 'h', 'required');

		if ($this->form_validation->run() == TRUE){			
			$src = base_url().'assets/uploads/news/'.$data['news']->image;
			$targ_w = $this->input->post('w');
			$targ_h = $this->input->post('h');

			$arr = explode('.', $src);
  			$ext = array_pop($arr);

			if($ext == 'png'){
				$jpeg_quality = 9;
				$img_r = imagecreatefrompng($src);
			}
			else{
				$jpeg_quality = 90;
				$img_r = imagecreatefromjpeg($src);
			}

			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			imagecopyresampled($dst_r,$img_r,0,0,$this->input->post('x'),$this->input->post('y'),$targ_w,$targ_h,$this->input->post('w'),$this->input->post('h'));

			while(1){
				$arr = str_split('Aa2B3b4C5c6D7d8E9eFfGgHhJjKkMmNnOoPpQqRrSsTtUuVvWwXxYyZz');
				shuffle($arr);
				$arr = array_slice($arr, 0, 5);
				$str = implode('', $arr);
				$str = $str."_".time().".".$ext;
				$query = $this->admin_model->get_result('posts', array('image' => $str));
				if(!$query)
					break;
			}

			$new_image = 'assets/uploads/news/'.$str;

			if($ext == 'png')
				imagepng($dst_r, $new_image ,$jpeg_quality);
			else
				imagejpeg($dst_r, $new_image ,$jpeg_quality);

			delete_image($data['news']->image, './assets/uploads/news/');
			$updatedata['image'] = $str;
			create_thumb($updatedata['image'], './assets/uploads/news/');

			$this->admin_model->update('posts',$updatedata, array('slug'=>$slug));		
			$this->session->set_flashdata('success_msg',"Image croped successfully.");
			redirect('blog/all');
		}		

		$data['template'] = 'blog/crop';
        $this->load->view('templates/admin_template', $data);		
    }



	public function delete($slug=""){	

		if(admin_login_in()===FALSE)

			redirect('login');	

		

		$data =	$this->admin_model->get_row('posts', array('slug'=> $slug));

		delete_image(@$data->image, './assets/uploads/news/');



		$this->admin_model->delete('posts',array('slug'=> $slug));		

		$this->session->set_flashdata('success_msg',"post has been deleted successfully.");

		redirect('blog/all');

	}

}