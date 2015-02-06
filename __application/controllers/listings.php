<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Listings extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('admin_model');

	}



	public function index($status = ''){
		if($status == '')
			redirect(base_url());

		if($status == 'active')
			$data['status'] = 1;
		else
			$data['status'] = 2;
		
		$data['menuactive'] = 'listings';
		$data['pagetitle'] = 'Listings';
		$data['categories'] = $this->admin_model->get_result('categories', array('type'=>2));
		$data['listings'] = $this->admin_model->get_pagination_result('properties',6,0,array('status' => $data['status']));		
		$data['numrow'] = $this->admin_model->get_pagination_result('properties',0,0,array('status' => $data['status']));		
		$data['template'] = 'listings/index';
		$this->load->view('templates/home_template', $data);
	}



	public function detail($slug = ""){

		$data['menuactive'] = 'listings';

		$data['pagetitle'] = 'Listings';


		$data['property'] = $this->admin_model->get_row('properties', array('slug'=>$slug));
		if(!$data['property'])
			redirect('listings');
		$data['gallery'] = $this->admin_model->get_result('pr_gallery', array('property_id'=> $data['property']->id));
		$data['template'] = 'listings/detail';
		$this->load->view('templates/home_template', $data);

	}



	public function all($offset=0){		

		if(admin_login_in()===FALSE)

			redirect('login');



		$limit=10;

		$data['properties']=$this->admin_model->get_pagination_result('properties', $limit,$offset);

		$config= get_theme_pagination();	

		$config['base_url'] = base_url().'listings/all/';

		$config['total_rows'] = $this->admin_model->get_pagination_result('properties', 0, 0);

		$config['per_page'] = $limit;

		// $config['num_links'] = 5;		

		$this->pagination->initialize($config); 		

		$data['pagination'] = $this->pagination->create_links();		



        $data['template'] = 'listings/all';

        $this->load->view('templates/admin_template', $data);			

	}	



	public function add(){

		 if(admin_login_in()===FALSE)

			redirect('login');

		$this->form_validation->set_rules('title', 'title', 'required');							

		$this->form_validation->set_rules('excerpt', 'excerpt', 'required');							

		$this->form_validation->set_rules('description', 'description', 'required');							

		$this->form_validation->set_rules('price', 'price', 'required');							

		$this->form_validation->set_rules('category', 'category', 'required');							

		$this->form_validation->set_rules('address', 'address', 'required');							

		$this->form_validation->set_rules('zip', 'zip', 'required');							

		$this->form_validation->set_rules('city', 'city', 'required');							

		$this->form_validation->set_rules('state', 'state', 'required');							

		$this->form_validation->set_rules('country', 'country', 'required');							

		$this->form_validation->set_rules('status', 'status', 'required');							

		if ($this->form_validation->run() == TRUE){			

			$data=array(

				'title'			=>$this->input->post('title'),

				'excerpt'		=>$this->input->post('excerpt'),

				'description'	=>$this->input->post('description'),

				'price'			=>$this->input->post('price'),

				'category_id'	=>$this->input->post('category'),

				'city'			=>$this->input->post('city'),

				'state'			=>$this->input->post('state'),

				'zip'			=>$this->input->post('zip'),

				'address'		=>$this->input->post('address'),

				'video_url'		=>$this->input->post('url'),

				'country'		=>$this->input->post('country'),

				'status'		=>$this->input->post('status'),

				'slug' 			=> create_slug('properties', $this->input->post('title')),				

				'created' 		=> date('Y-m-d H:i:s')		

			);			



			if($_FILES['userfile']['name']!=''){

				$config['upload_path'] = './assets/uploads/properties/';

				$config['allowed_types'] = 'gif|jpg|png';

				$config['max_size']	= '';

				$this->load->library('upload', $config);

				if (! $this->upload->do_upload()){

					$this->session->set_flashdata('error_msg', $this->upload->display_errors());

					redirect('listings/add');

				}else{

				   $upload_data = $this->upload->data();			

				   $data['featured_image']=$upload_data['file_name'];

				   create_thumb($data['featured_image'], './assets/uploads/properties/');

				}

			}

			

			$prid = $this->admin_model->insert('properties',$data);		



		  if($_FILES['gall']['name'][0]!='' && $_POST['galcap'][0]!='' ){

			$this->load->library('upload');

              $resp = array();

              $cpt = count($_FILES['gall']['name']);

              $files = $_FILES;                 

              for($i=0; $i<$cpt; $i++){

              	$prgallery = array(

              		'caption' => $_POST['galcap'][$i],

              		'property_id'=>$prid,

              		'created' =>date('Y-m-d H:i:s')

              		);



                $_FILES['userfile']['name']= $files['gall']['name'][$i];

                $_FILES['userfile']['type']= $files['gall']['type'][$i];

                $_FILES['userfile']['tmp_name']= $files['gall']['tmp_name'][$i];

                $_FILES['userfile']['error']= $files['gall']['error'][$i];

                $_FILES['userfile']['size']= $files['gall']['size'][$i];    

                $this->upload->initialize($this->set_upload_options());

                $this->upload->do_upload();

                $name = $this->upload->data();

                create_thumb($name['file_name'], './assets/uploads/properties/');

                $prgallery['image'] = $name['file_name'];

                $this->admin_model->insert('pr_gallery', $prgallery);

              }

          }





			$this->session->set_flashdata('success_msg',"Property has been added successfully.");

			redirect('listings/all');

		}



		$data['categories'] = $this->admin_model->get_result('categories', array('type'=>2));

		$data['template'] = 'listings/add';

        $this->load->view('templates/admin_template', $data);		

	}



	public function edit($slug = ""){

		if($slug == "")

			redirect('listings/all');



		 if(admin_login_in()===FALSE)

			redirect('login');



		$data['property'] = $this->admin_model->get_row('properties', array('slug'=>$slug));

		$data['pr_gallery'] = $this->admin_model->get_result('pr_gallery', array('property_id'=>$data['property']->id));		



		$this->form_validation->set_rules('title', 'title', 'required');							

		$this->form_validation->set_rules('excerpt', 'excerpt', 'required');							

		$this->form_validation->set_rules('description', 'description', 'required');							

		$this->form_validation->set_rules('price', 'price', 'required');							

		$this->form_validation->set_rules('category', 'category', 'required');							

		$this->form_validation->set_rules('address', 'address', 'required');							

		$this->form_validation->set_rules('zip', 'zip', 'required');							

		$this->form_validation->set_rules('city', 'city', 'required');							

		$this->form_validation->set_rules('state', 'state', 'required');							

		$this->form_validation->set_rules('country', 'country', 'required');							

		$this->form_validation->set_rules('status', 'status', 'required');							

		if ($this->form_validation->run() == TRUE){			

			$update=array(

				'title'			=>$this->input->post('title'),

				'excerpt'		=>$this->input->post('excerpt'),

				'description'	=>$this->input->post('description'),

				'price'			=>$this->input->post('price'),

				'category_id'		=>$this->input->post('category'),

				'city'			=>$this->input->post('city'),

				'state'			=>$this->input->post('state'),

				'zip'			=>$this->input->post('zip'),

				'address'		=>$this->input->post('address'),

				'video_url'		=>$this->input->post('url'),

				'country'		=>$this->input->post('country'),

				'status'		=>$this->input->post('status'),

				'slug' 			=> create_slug_for_update('properties', $this->input->post('title')),				

				'created' 		=> date('Y-m-d H:i:s')		

			);			



			if($_FILES['userfile']['name']!=''){

				$config['upload_path'] = './assets/uploads/properties/';

				$config['allowed_types'] = 'gif|jpg|png';

				$config['max_size']	= '';

				$this->load->library('upload', $config);

				if (! $this->upload->do_upload()){

					$this->session->set_flashdata('error_msg', $this->upload->display_errors());

					redirect('listings/edit/'.$data['property']->id);

				}else{

				   $upload_data = $this->upload->data();			

				   $update['featured_image']=$upload_data['file_name'];

				   create_thumb($update['featured_image'], './assets/uploads/properties/');

				   delete_image($data['property']->featured_image, './assets/uploads/properties/');

				}

			}

			

			 $this->admin_model->update('properties',$update, array('id'=>$data['property']->id));		

			 $prid = $data['property']->id;

		  if(@$_FILES['gall']['name'][0]!='' && @$_POST['galcap'][0]!='' ){

			$this->load->library('upload');

              $resp = array();

              $cpt = count($_FILES['gall']['name']);

              $files = $_FILES;                 

              for($i=0; $i<$cpt; $i++){

              	$prgallery = array(

              		'caption' => $_POST['galcap'][$i],

              		'property_id'=>$prid,

              		'created' =>date('Y-m-d H:i:s')

              		);



                $_FILES['userfile']['name']= $files['gall']['name'][$i];

                $_FILES['userfile']['type']= $files['gall']['type'][$i];

                $_FILES['userfile']['tmp_name']= $files['gall']['tmp_name'][$i];

                $_FILES['userfile']['error']= $files['gall']['error'][$i];

                $_FILES['userfile']['size']= $files['gall']['size'][$i];    

                $this->upload->initialize($this->set_upload_options());

                $this->upload->do_upload();

                $name = $this->upload->data();

                create_thumb($name['file_name'], './assets/uploads/properties/');

                $prgallery['image'] = $name['file_name'];

                $this->admin_model->insert('pr_gallery', $prgallery);

              }

          }





			$this->session->set_flashdata('success_msg',"Property has been updated successfully.");

			redirect('listings/all');

		}

		$data['categories'] = $this->admin_model->get_result('categories', array('type'=>2));		

		$data['template'] = 'listings/edit';

        $this->load->view('templates/admin_template', $data);		

	}

	 		



	 private function set_upload_options(){   

	  //  upload an image options

	    $config = array();

	    $config['upload_path'] = './assets/uploads/properties';

	    $config['allowed_types'] = 'gif|jpg|png';

	    $config['max_size']      = '0';

	    $config['overwrite']     = FALSE;





	    return $config;

	}



	public function ajax_update_gallery($id){		

		if(admin_login_in()===FALSE){

			return FALSE;

			die();		

		}



		if($_POST){

			$this->admin_model->update('pr_gallery',array('caption'=>$_POST['caption']),array('id'=>$id));

		}

	}



	public function ajax_remove_gallery($id=""){		

		if(admin_login_in()===FALSE){

			return FALSE;

			die();		

		}



		if($id == ""){

			echo "0";

			die();

		}

		$img = $this->admin_model->get_row('pr_gallery', array('id'=>$id));

		delete_image($img->image, './assets/uploads/properties/');

		$this->admin_model->delete('pr_gallery', array('id'=>$id));

		

	}



	public function delete($slug =""){

		if($slug == ""){

			redirect('listings/all');

		}



		$img = $this->admin_model->get_row('properties', array('slug'=>$slug));

		delete_image($img->featured_image, './assets/uploads/properties/');

		$this->admin_model->delete('properties', array('slug'=>$slug));

		$this->session->set_flashdata('success_msg',"Property has been deleted successfully.");

			redirect('listings/all');

	}


	public function ajaxfilter_listings($status = 1 , $offset = 0){
		if($_POST){
			// print_r($_POST);
			$limit=6;
			$post = $_POST;
			$listings  = $this->admin_model->filter_listings($post, $limit, $offset, array('status' => $status));		
			// print_r($listings);
			$res="";
			if($listings['listings']):
			$res .='<div class="row side-contant">';
                  $i= 1; foreach ($listings['listings'] as $row ): 
            $res .='<div class="col-sm-4 hover proprty">';
            $res .='<a href="'.base_url().'listings/detail/'.$row->slug.'" ><img src="'.base_url().'assets/uploads/properties/'.$row->featured_image.'"></a>';
            $res .='<a href="'.base_url().'listings/detail/'.$row->slug.'" ><h4>'.$row->title.'</h4></a>';
            $res .='<p>'.word_limiter($row->excerpt,20).'</p>';
            $res .='<div class="hoverbox m-t"><a href="'.base_url().'listings/detail/'.$row->slug.'" class="btn lern-more">CONTACT US</a></div>';
            $res .='</div>';  
                if($i%3==0){                      
                   $res .='</div>';
                    $res.='<div class="row side-contant">';
                 } 
             $i++; endforeach; 
            $res .='</div>';

               foreach ($listings['listings'] as $row) { 
            		$location = '<span id="'.$row->id.'">'.$row->address.' '.$row->city.' '.$row->state.' '.$row->zip.' '.$row->country.'</span>';
           		}  

            echo json_encode(array('listing'=>$res,'status'=>'found','count'=>$listings['count'], 'locations'=>$location));
            else:           
            echo json_encode(array('status'=>'not found'));
            endif; 

        }
	}

	public function ajaxsubmitform(){
	 	if($_POST){
	 		$res="";
	 		$flag = FALSE;
	 		$res.='<p>Please Correct the following</p>';
	 		if($this->input->post('fname') == ""){
	 			$res.='<p>&#9679; First Name</p>';
	 			$flag = TRUE;
	 		}

	 		if($this->input->post('lname') == ""){
	 			$res.='<p>&#9679; Last Name</p>';
	 			$flag = TRUE;
	 		}

	 		if($this->input->post('email') == ""){
	 			$res.='<p>&#9679; Email Address</p>';
	 			$flag = TRUE;
	 		}elseif(!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)){
	 			$res.='<p>&#9679; Valid Email Address</p>';
	 			$flag = TRUE;
	 		}

	 		if($this->input->post('message') == ""){
	 			$res.='<p>&#9679; Message</p>';
	 			$flag = TRUE;
	 		}

	 		if($this->input->post('phone') == ""){
	 			$res.='<p>&#9679; Phone</p>';
	 			$flag = TRUE;
	 		}

	 		if($this->input->post('address') == ""){
	 			$res.='<p>&#9679; Address</p>';
	 			$flag = TRUE;
	 		}

	 		// if($this->input->post('fname') == "" || $this->input->post('lname') == "" || $this->input->post('email') == "" || $this->input->post('message') == "" || $this->input->post('phone') == "" || $this->input->post('address') == "")
	 		if($flag){
	 			$response = array('status'=>'error','validation_error'=>$res);
	 			echo json_encode($response);
	 			die();
	 		}else{
	 			$data = array(
	 				'name'=>$this->input->post('fname').' '.$this->input->post('lname'),				
					'email'=>$this->input->post('email'),							
					'address'=>$this->input->post('address'),							
					'phone'=>$this->input->post('phone'),							
					'message'=>$this->input->post('message'),							
					'created' => date('Y-m-d H:i:s')		
				);		

			$this->admin_model->insert('contact_us', $data);
	 			$response = array('status'=>'success');
	 			echo json_encode($response);
	 		}
	}

}

}