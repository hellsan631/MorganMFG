<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->admin_login();	
	}

	public function admin_login(){
		if(admin_login_in()===TRUE)
			redirect('admin');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE){
			$this->load->model('turnskey_model');			
			$status = $this->turnskey_model->login($this->input->post('email'),$this->input->post('password'),1);	
			
			if($status){
				redirect('admin');
			}
			else{
				redirect('login/admin_login');
			}
		}

		$this->load->view('login/admin_login');
	}

		/*Forget Password starts*/
	public function forget_password()
	{
		$this->load->model('admin_model');
		if($this->input->post('email'))
			{
				$email=$this->input->post('email'); // user email
				$array = array('email' => $email);
				$user_info = $this->admin_model->get_row('users',$array);
                if(empty($user_info))
                {
                	$array = array('status'=>'error','msg'=>'Please Enter Correct Registred Email');
                    echo json_encode($array);
                    exit;
                }
                ///////// insert secret key in database  //////////
                $secret_key = sha1($email);
                $data = array('secret_key' => $secret_key);
                $id_array = array('email' => $email);
                $this->admin_model->update('users', $data, $id_array);

                /////////////   send Email to user  ///////////////

				$this->load->library('smtp_lib/smtp_email');
                /*Starts*/
				$username = $user_info->first_name.' '.$user_info->last_name;		        
		        $subject = "Notification For Forget Password";
		        $to = array($user_info->email);
		        $from = array('no-reply@morgan.com'=>'morgan.com');
		        $html =  $this->template_for_forget_password($username,$user_info->email,$secret_key);

              /*Ensd*/
				
				$is_fail = $this->smtp_email->sendEmail($from, $to, $subject, $html);
				if($is_fail)
				{
					echo "ERROR :";
					print_r($is_fail);
				}
				$array = array('status'=>'success','msg'=>'Please check your email to access Morgan account');
                echo json_encode($array);
                exit;
			}
	}

	public function template_for_forget_password($username, $email, $secret_key)
	{
		$message = '';
		$message .= '<html>
						<body style="-webkit-box-shadow: 0 0 0 3px rgba(0,0,0,0.025) !important;box-shadow: 0 0 0 3px rgba(0,0,0,0.025) !important;-webkit-border-radius: 6px !important;border-radius: 6px !important;background-color: #fdfdfd;border: 1px solid #dcdcdc;-webkit-border-radius: 6px !important;border-radius: 6px !important;width: 75%;margin: 0 auto;-webkit-box-shadow: 0 0 0 3px rgba(0,0,0,0.025) !important;box-shadow: 0 0 0 3px rgba(0,0,0,0.025) !important;">
						<h3 style="color: #ffffff;margin:0;padding: 28px 24px;text-shadow: 0 1px 0 #7797b4;display:block;font-family:Arial;font-size:30px;font-weight:bold;text-align:left;line-height: 150%;background:#7797b4;border-radius: 6px 6px 0px 0;">Password Reset Instructions</h3>
						<p style="color: #737373;font-family: Arial;font-size: 14px;line-height: 150%;text-align: left;padding: 10px 20px;">Someone requested that the password be reset for the following account:<br><br>Email: <a style="text-decoration:none">'.$email.'</a>.</p>
						<p style="color: #737373;font-family: Arial;font-size: 14px;line-height: 150%;text-align: left;padding: 0 20px;">To reset your password, visit the following address: <a href="'.base_url().'login/forget_password_response/'.$secret_key.'" ><font color="grey"><br><br>Click here to reset your password</font></a></p>
						<p>&nbsp;</p>
						<p style="color: #737373;font-family: Arial;font-size: 14px;line-height: 150%;text-align: left;padding: 0 20px;">Do you have any questions about your account, please contact us at:   
						<a href="'.base_url().'">http://www.morgan.com</a>
						</p>
						<p>&nbsp;</p>
						<p style="text-align:center;color:#99b1c7">Kind Regards,</p>
						<p style="text-align:center;color:#99b1c7;margin-bottom:0px;">Morgan Team</p>
						<p style="text-align:center;margin:0;"><a style="color:#99b1c7;" href="'.base_url().'">www.morgan.com</a></p>';		
		$message .=	'</body></html>';
		return $message;
	}


	public function forget_password_response($secret_key)
	{
		
		$this->load->model('admin_model');
		$array = array('secret_key' => $secret_key);
		$user_info = $this->admin_model->get_row('users',$array);
		if(empty($user_info))
		{
			$this->session->set_flashdata('error_msg','Email link has been expired.');
			redirect('login/admin_login');
		}	
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('con_password', 'Confiorm Password', 'required|matches[password]');
        if($this->form_validation->run())
        {
		        if($this->input->post('password'))
		        {
		        	$pwd_temp = $this->input->post('password');
		            $pwd = sha1($pwd_temp);
		            $id_array = array('secret_key' => $secret_key);
		            $data = array('password' => $pwd, 'secret_key' =>'');
		            $this->admin_model->update('users', $data, $id_array);
					$this->session->set_flashdata('success_msg','Password has been reset successfully, please login..!');
					redirect('login/admin_login');
		        }
        }
		$this->load->view('login/forget_password');
	}
    
	
/*Forget Password Ends*/

}