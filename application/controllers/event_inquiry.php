<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_inquiry extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model');
	}

	// public function test()
	// {
	// 	$event_html = "<h3>you have got the a notification on event inquiry.</h3>";
	// 	$event_html .= "<p>here are the user details.</p> ";	  		
	// 	$event_html .= "<p>name : user. </p>";	  		
	// 	$event_html .= "<p>email : user. </p>";	  		
	// 	$event_html .= "<p>phone : user. </p>";	  		
	// 	$event_html .= "<p>message : user. </p>";	
	// 	echo $event_html;  		

	// }

	public function submit_event_inquiry()
	{
		// $data['menuactive'] = 'contactus';
		// $data['pagetitle'] = 'Contact Us';

		if(isset($_POST))
		{	
			$data=array(
						'first_name'=>$this->input->post('event_first_name'),								
						'last_name'=>$this->input->post('event_last_name'),								
						'email'=>$this->input->post('event_email'),							
						'phone'=>$this->input->post('event_phone'),							
						'message'=>$this->input->post('event_message'),							
						'created' => date('Y-m-d h:i:s'),		
					  );

				$event_html = "<h3>you have a notification on event inquiry.</h3>";
				$event_html .= "<p>here are the user details.</p> ";	  		
				$event_html .= "<p>name : ".$_POST['event_first_name']." ".$_POST['event_last_name'].". </p>";	  		
				$event_html .= "<p>email : ".$_POST['event_email'].". </p>";	  		
				$event_html .= "<p>phone : ".$_POST['event_phone'].". </p>";	  		
				$event_html .= "<p>message : ".$_POST['event_message'].". </p>";	

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
			    $this->email->from('no-reply@401morgan.com', 'Morgan');
			    $this->email->to('info@401morganmfg.com');
			    // $this->email->reply_to('morgan.com', 'Explendid Videos');
			    $this->email->subject('Event Inquiry.');
			    $this->email->message($event_html);
			    $this->email->send();

			$this->admin_model->insert('event_inquiry', $data);
			echo "ok";
		}
	}


	public function all($offset=0)
	{		
		if(admin_login_in()===FALSE)
			redirect('login');

		$limit=10;
		$data['event_inquiry']=$this->admin_model->get_pagination_result('event_inquiry', $limit,$offset);
		$config= get_theme_pagination();	
		$config['base_url'] = base_url().'event_inquiry/all/';
		$config['total_rows'] = $this->admin_model->get_pagination_result('event_inquiry', 0, 0);
		$config['per_page'] = $limit;
		// $config['num_links'] = 5;		
		$this->pagination->initialize($config); 		
		$data['pagination'] = $this->pagination->create_links();		

        $data['template'] = 'event_inquiry/all';
        $this->load->view('templates/admin_template', $data);			
	}	

	// public function view($id=''){
	// 	if(admin_login_in()===FALSE)
	// 		redirect('login');
	// 	if($id == "")
	// 		redirect('contactus/all');

	// 	$data['detail'] = $this->admin_model->get_row('contact_us', array('id'=>$id));
	// 	$data['template'] = 'contactus/view';
 //        $this->load->view('templates/admin_template', $data);			
	// }

	public function delete($id="")
	{
		if(admin_login_in()===FALSE)
			redirect('login');
		if($id == "")
			redirect('event_inquiry/all');

		$this->admin_model->delete('event_inquiry', array('id'=>$id));		
		$this->session->set_flashdata('success_msg','successfully Deleted');
			redirect('event_inquiry/all');
	}
}