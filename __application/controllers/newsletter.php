<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}	


	public function all($offset=0)
	{		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['newsletter']=$this->admin_model->get_pagination_result('newsletter', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'newsletter/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('newsletter', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'newsletter/all';
        $this->load->view('templates/admin_template', $data);			
	}	


	public function ajax_save_newletter(){
		if($_POST['email'])
		{
			$email = $this->input->post('email');
			$exist = $this->admin_model->get_row('newsletter', array('email' => $email));
			if($exist)
			{
				$this->admin_model->update('newsletter', array('subscription'=> 1), array('email'=>$email));			
			}
			else{
				$val = rand('333','999');
				$key = uniqid().$val;
				$data = array(
					'email'=> $email,
					'subscription'=> 1,
					'key'=> $key,
					'created'=> date('Y-m-d H:i:s'),
				);
				$this->admin_model->insert('newsletter', $data);

				// $subject = 'Thank You For Subscribing to Morgan!';
				// $to = array(
				// 	trim($this->input->post('email'))
				// );

				// $from = array(
				// 	'noreply@morgan.com'
				// );

				//  $html = "me";
				
				// $this->load->library('smtp_lib/smtp_email');
				// $this->smtp_email->sendEmail($from, $to, $subject, $html);

				// $subject = 'Newsletter Subscription.';
				// $to = array(
				// 	"faheem.test@gmail.com"
				// );

				// $from = array(
				// 	'noreply@morgan.com'
				// ); 
				//  $html = "me";
				
				// $this->smtp_email->sendEmail($from, $to, $subject, $html);
				echo 1;

			}		
		}else{
			echo 0;
		}
	}


	// public function unsubscribe($key="")
	// {
	// 	if($key == ""){
	// 		redirect(base_url());
	// 	}else{
	// 		$this->admin_model->update('newsletter', array('subscription'=>0), array('key'=>$key));
	// 		redirect(base_url());
	// 	}
	// }

	
	public function delete($id="")
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('newsletter/all');
		$this->admin_model->delete('newsletter', array('id'=>$id));		
		$this->session->set_flashdata('success_msg','successfully Deleted');
		redirect('newsletter/all');
	}
}