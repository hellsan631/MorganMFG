<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends CI_Controller {

	public function __construct(){
		
		parent::__construct();			
		clear_cache();

		$this->load->model('admin_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function pages($offset=0)
	{	
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;

		$data['seo']=$this->admin_model->get_pagination_where('seo', $limit,$offset);

		$config= get_theme_pagination();	

		$config['base_url'] = base_url().'seo/pages/';

		$config['total_rows'] = $this->admin_model->get_pagination_where('seo', 0, 0);

		$config['per_page'] = $limit;

		// $config['num_links'] = 5;		

		$this->pagination->initialize($config); 		

		$data['pagination'] = $this->pagination->create_links();


        $data['template'] = 'seo/pages';

        $this->load->view('templates/admin_template', $data);			

	}

	public function contents($slug=''){
		if(admin_login_in()===FALSE)
			redirect('login');
		$data['page'] = $this->admin_model->get_row('seo', array('slug'=>$slug));		
		// $this->form_validation->set_rules('submit', 'submit', 'required');					
		if ($_POST){			
			$update_data=array(
				'title'			=>	$this->input->post('title'),
				'slug'			=>	$slug,
				'description'	=>	$this->input->post('description'),								
				'keyword'		=>	$this->input->post('keyword'),				
				'created' 		=>	date('Y-m-d h:i:s'),
				);
			// print_r($update_data);
			// die();
			if (empty($data['page'])) {
				// $update_data['slug'] = create_slug('seo', $this->input->post('title'));
				$this->admin_model->insert('seo',$update_data);
			}else{
				// $update_data['slug'] = create_slug_for_update('seo', $this->input->post('title'), $data['page']->id);
				$update_data['updated'] = date('Y-m-d h:i:s');
				$this->admin_model->update('seo',$update_data, array('slug'=>$slug));
			}
			$this->session->set_flashdata('success_msg',"Content has been saved successfully.");
			redirect('seo/contents/'.$slug);
		}		
		$data['template'] = 'seo/contents';
        $this->load->view('templates/admin_template', $data);	
        
	}

	public function delete($slug=""){	
		if(admin_login_in()===FALSE)
			redirect('login');
		
		$data =	$this->admin_model->get_row('seo', array('slug'=> $slug));

		if(empty($data))
			redirect('seo/pages');

		$this->admin_model->delete('seo',array('slug'=> $slug));		
		$this->session->set_flashdata('success_msg',"Seo content of the page has been deleted successfully.");
		redirect('seo/pages');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */