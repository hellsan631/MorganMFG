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


	public function ajax_save_newletter()
	{
		if($_POST['email'])
		{
			$email = trim($this->input->post('email'));
			$email = strtolower($email);
			$exist = $this->admin_model->get_row('newsletter', array('email' => $email));
			if($exist)
			{
				$this->admin_model->update('newsletter', array('subscription'=> 1), array('email'=>$email));			

				$config = array(
			        'apikey' => 'ae8ad4beb222fab50ef8d02faf06f100-us8' ,     // Insert your api key
			        'secure' => FALSE   // Optional (defaults to FALSE)
			    );

				$list_id = 'be5bc010fc';
				/*$merge_vars = array(
				                'FNAME'=>$first, 
				                'LNAME'=>$last
				                    ); */
				$this->load->library('MCAPI', $config, 'mail_chimp');
				$res = $this->mail_chimp->listSubscribe($list_id, $email);
			}
			else
			{
				$val = rand('333','999');
				$key = uniqid().$val;
				$data = array(
					'email'=> $email,
					'subscription'=> 1,
					'key'=> $key,
					'created'=> date('Y-m-d H:i:s'),
				);
				$this->admin_model->insert('newsletter', $data);

				$config = array(
			        'apikey' => 'ae8ad4beb222fab50ef8d02faf06f100-us8' ,     // Insert your api key
			        'secure' => FALSE   // Optional (defaults to FALSE)
			    );

				$list_id = 'be5bc010fc';
				/*$merge_vars = array(
				                'FNAME'=>$first, 
				                'LNAME'=>$last
				                    ); */
				$this->load->library('MCAPI', $config, 'mail_chimp');
				$res = $this->mail_chimp->listSubscribe($list_id, $email);


			    $this->load->library('email');
			    $config['protocol'] = "smtp";
			    $config['smtp_host'] = "ssl://smtp.mandrillapp.com";
			    $config['smtp_port'] = "465";
			    $config['smtp_user'] = "contact@faheemhasan.com";
			    $config['smtp_pass'] = "786ycxrFRADbdjmq3QEg-Q";
			    $config['charset'] = "utf-8";
			    $config['mailtype'] = "html";
			    $config['newline'] = "\r\n";
			    $this->email->initialize($config);
			    $this->email->from('contact@faheemhasan.com', 'Morgan');
			    $this->email->to($email);
			    $this->email->reply_to('morgan.com', 'Explendid Videos');
			    $this->email->subject('Newsletter Subscription.');
			    $this->email->message("<p>Thank you for subscribing to Morgan Manufacturing's Newsletter! Expect new and exciting updates coming your way soon.<br>
										Sincerely,<br>
										The Morgan Manufacturing Marketing Team</p>"
				);
			    $this->email->send();
				echo 1;
			}		
		}
		else
		{
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