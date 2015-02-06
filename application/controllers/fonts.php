<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fonts extends CI_Controller {

	public function __construct(){
		parent::__construct();
		clear_cache();
		
		if(admin_login_in()===FALSE)
			redirect('login/admin_login');
		
		$this->load->model('admin_model');
	}
	
	public function index(){
		$this->change_fonts();
	}

	public function common($id='', $file=''){
		if($id == '' || $file == ''){
			redirect(base_url());
		}

		$this->load->library('google_fonts');
		$this->google_fonts->update_db();
		
		$data['row'] = $this->admin_model->get_row('site_fonts', array('id'=>$id));

		if(!$data['row']){
			$this->admin_model->insert('site_fonts', array('id'=>$id));
			$data['row'] = $this->admin_model->get_row('site_fonts', array('id'=>$id));
		}
		
		$this->db->order_by('font_name', 'asc');
		$data['google_fonts'] = $this->admin_model->get_result('google_fonts');	
		$this->form_validation->set_rules('submit', 'submit', 'required');					
		if ($this->form_validation->run() == TRUE){
			
			$update = array(
				'f_body_id' => $this->input->post('f_body_id'),
				'f_w_size' => $this->input->post('f_w_size'),
				'f_m_size' => $this->input->post('f_m_size'),
				'f_t_size' => $this->input->post('f_t_size'),
				'f_color' => $this->input->post('f_color'),
				'f_weight' => $this->input->post('f_weight'),
				'f_line_height' => $this->input->post('f_line_height'),
				'f_word_spacing' => $this->input->post('f_word_spacing'),
				'f_letter_spacing' => $this->input->post('f_letter_spacing'),
				's_body_id' => $this->input->post('s_body_id'),
				's_w_size' => $this->input->post('s_w_size'),
				's_m_size' => $this->input->post('s_m_size'),
				's_t_size' => $this->input->post('s_t_size'),
				's_color' => $this->input->post('s_color'),
				's_weight' => $this->input->post('s_weight'),
				's_line_height' => $this->input->post('s_line_height'),
				's_word_spacing' => $this->input->post('s_word_spacing'),
				's_letter_spacing' => $this->input->post('s_letter_spacing'),
				't_body_id' => $this->input->post('t_body_id'),
				't_w_size' => $this->input->post('t_w_size'),
				't_m_size' => $this->input->post('t_m_size'),
				't_t_size' => $this->input->post('t_t_size'),
				't_color' => $this->input->post('t_color'),
				't_weight' => $this->input->post('t_weight'),
				't_line_height' => $this->input->post('t_line_height'),
				't_word_spacing' => $this->input->post('t_word_spacing'),
				't_letter_spacing' => $this->input->post('t_letter_spacing'),
				'fo_body_id' => $this->input->post('fo_body_id'),
				'fo_w_size' => $this->input->post('fo_w_size'),
				'fo_m_size' => $this->input->post('fo_m_size'),
				'fo_t_size' => $this->input->post('fo_t_size'),
				'fo_color' => $this->input->post('fo_color'),
				'fo_weight' => $this->input->post('fo_weight'),
				'fo_line_height' => $this->input->post('fo_line_height'),
				'fo_word_spacing' => $this->input->post('fo_word_spacing'),
				'fo_letter_spacing' => $this->input->post('fo_letter_spacing'),
				'fi_body_id' => $this->input->post('fi_body_id'),
				'fi_w_size' => $this->input->post('fi_w_size'),
				'fi_m_size' => $this->input->post('fi_m_size'),
				'fi_t_size' => $this->input->post('fi_t_size'),
				'fi_color' => $this->input->post('fi_color'),
				'fi_weight' => $this->input->post('fi_weight'),
				'fi_line_height' => $this->input->post('fi_line_height'),
				'fi_word_spacing' => $this->input->post('fi_word_spacing'),
				'fi_letter_spacing' => $this->input->post('fi_letter_spacing'),
				'updated' => date('Y-m-d H:i:s')
			);
				
			$this->admin_model->update('site_fonts',$update,array('id'=>$id));				
			
			$fonts = $update;

			if($this->input->post('f_body_id') != ''){
				$fonts['f'] = $this->admin_model->get_row('google_fonts', array('id' => $this->input->post('f_body_id')));
			}
			else{
				$fonts['f'] = FALSE;
			}

			if($this->input->post('s_body_id') != ''){
				$fonts['s'] = $this->admin_model->get_row('google_fonts', array('id' => $this->input->post('s_body_id')));
			}
			else{
				$fonts['s'] = FALSE;
			}

			if($this->input->post('t_body_id') != ''){
				$fonts['t'] = $this->admin_model->get_row('google_fonts', array('id' => $this->input->post('t_body_id')));
			}
			else{
				$fonts['t'] = FALSE;
			}

			if($this->input->post('fo_body_id') != ''){
				$fonts['fo'] = $this->admin_model->get_row('google_fonts', array('id' => $this->input->post('fo_body_id')));
			}
			else{
				$fonts['fo'] = FALSE;
			}

			if($this->input->post('fi_body_id') != ''){
				$fonts['fi'] = $this->admin_model->get_row('google_fonts', array('id' => $this->input->post('fi_body_id')));
			}
			else{
				$fonts['fi'] = FALSE;
			}

			$str = $this->load->view('fonts/css/'.$file.'', $fonts, TRUE);	
			// echo $str; die();
			@unlink('./assets/dynamic_css/'.$file.'.css');
			$this->load->helper('file');
			if (! write_file('./assets/dynamic_css/'.$file.'.css', $str)){
			    $this->session->set_flashdata('error_msg',"Could not write file, changes will not reflects Please update again.");
				redirect(current_url());
			}
			$this->session->set_flashdata('success_msg',"Updated");
			redirect(current_url());
		}
		$data['id'] = $id;
		$data['template'] = 'fonts/'.$file.'';
        $this->load->view('templates/admin_template', $data);
	}

	public function change_fonts(){
		$this->common(1, 'change_fonts');
	}

	public function navigation(){
		$this->common(2, 'navigation');
	}

	public function home_slider(){
		$this->common(3, 'home_slider');
	}

	public function footer_inquire(){
		$this->common(4, 'footer_inquire');
	}

	public function footer_connect_container(){
		$this->common(5, 'footer_connect_container');
	}

	public function section(){
		$this->common(6, 'section');
	}

	public function space(){
		$this->common(7, 'space');
	}

	public function space_detail(){
		$this->common(8, 'space_detail');
	}

	public function catering(){
		$this->common(9, 'catering');
	}

	public function catering_detail(){
		$this->common(10, 'catering_detail');
	}

	public function news(){
		$this->common(11, 'news');
	}

	public function news_detail(){
		$this->common(12, 'news_detail');
	}

	public function contact(){
		$this->common(13, 'contact');
	}

	public function footer(){
		$this->common(14, 'footer');
	}

	public function form_field(){
		$this->common(15, 'form_field');
	}

	public function get_font_weights($id){
		if($id != ''){
			$fontvar = get_font_var($id);
			$str = "";
			if($fontvar){
				foreach ($fontvar as $row) {
					$var = TRUE;
					$var = strripos($row->variant_name, 'italic');
					//echo $var; die();
					if(!$var){
						if($row->variant_name == 'regular'){
							$str .= '<option value="normal">Regular</option>';							
						}elseif($row->variant_name == 'italic'){
							
						}else{
							$str .= '<option value="'.$row->variant_name.'">'.$row->variant_name.'</option>';
						}
					}
				}
			}

			echo $str;
		}else{
			echo '<option value="">Default</option>';
		}
	}

	public function reset($id=''){
		$url = base_url();
		switch ($id) {
			case '1':
				@unlink('./assets/dynamic_css/change_fonts.css');
				$url = base_url().'fonts/change_fonts';
				write_file('./assets/dynamic_css/change_fonts.css', ' /* NO CSS */ ');
				break;

			case '2':
				@unlink('./assets/dynamic_css/navigation.css');
				$url = base_url().'fonts/navigation';
				write_file('./assets/dynamic_css/navigation.css', ' /* NO CSS */ ');
				break;

			case '3':
				@unlink('./assets/dynamic_css/home_slider.css');
				$url = base_url().'fonts/home_slider';
				write_file('./assets/dynamic_css/home_slider.css', ' /* NO CSS */ ');
				break;

			case '4':
				@unlink('./assets/dynamic_css/footer_inquire.css');
				$url = base_url().'fonts/footer_inquire';
				write_file('./assets/dynamic_css/footer_inquire.css', ' /* NO CSS */ ');
				break;

			case '5':
				@unlink('./assets/dynamic_css/footer_connect_container.css');
				$url = base_url().'fonts/footer_connect_container';
				write_file('./assets/dynamic_css/footer_connect_container.css', ' /* NO CSS */ ');
				break;

			case '6':
				@unlink('./assets/dynamic_css/section.css');
				$url = base_url().'fonts/section';
				write_file('./assets/dynamic_css/section.css', ' /* NO CSS */ ');
				break;

			case '7':
				@unlink('./assets/dynamic_css/space.css');
				$url = base_url().'fonts/space';
				write_file('./assets/dynamic_css/space.css', ' /* NO CSS */ ');
				break;

			case '8':
				@unlink('./assets/dynamic_css/space_detail.css');
				$url = base_url().'fonts/space_detail';
				write_file('./assets/dynamic_css/space_detail.css', ' /* NO CSS */ ');
				break;

			case '9':
				@unlink('./assets/dynamic_css/catering.css');
				$url = base_url().'fonts/catering';
				write_file('./assets/dynamic_css/catering.css', ' /* NO CSS */ ');
				break;

			case '10':
				@unlink('./assets/dynamic_css/catering_detail.css');
				$url = base_url().'fonts/catering_detail';
				write_file('./assets/dynamic_css/catering_detail.css', ' /* NO CSS */ ');
				break;

			case '11':
				@unlink('./assets/dynamic_css/news.css');
				$url = base_url().'fonts/news';
				write_file('./assets/dynamic_css/news.css', ' /* NO CSS */ ');
				break;

			case '12':
				@unlink('./assets/dynamic_css/news_detail.css');
				$url = base_url().'fonts/news_detail';
				write_file('./assets/dynamic_css/news_detail.css', ' /* NO CSS */ ');
				break;

			case '13':
				@unlink('./assets/dynamic_css/contact.css');
				$url = base_url().'fonts/contact';
				write_file('./assets/dynamic_css/contact.css', ' /* NO CSS */ ');
				break;

			case '14':
				@unlink('./assets/dynamic_css/footer.css');
				$url = base_url().'fonts/footer';
				write_file('./assets/dynamic_css/footer.css', ' /* NO CSS */ ');
				break;

			case '15':
				@unlink('./assets/dynamic_css/form_field.css');
				$url = base_url().'fonts/form_field';
				write_file('./assets/dynamic_css/form_field.css', ' /* NO CSS */ ');
				break;
			
			default:
				die();
				break;
		}
		$this->admin_model->update('site_fonts', $this->blank_row() ,array('id'=>$id));
		redirect($url);
	}

	public function blank_row(){
		return array(
			'f_body_id' => '',
			'f_w_size' => '',
			'f_m_size' => '',
			'f_t_size' => '',
			'f_color' => '',
			'f_weight' => '',
			'f_line_height' => '',
			'f_word_spacing' => '',
			'f_letter_spacing' => '',
			's_body_id' => '',
			's_w_size' => '',
			's_m_size' => '',
			's_t_size' => '',
			's_color' => '',
			's_weight' => '',
			's_line_height' => '',
			's_word_spacing' => '',
			's_letter_spacing' => '',
			't_body_id' => '',
			't_w_size' => '',
			't_m_size' => '',
			't_t_size' => '',
			't_color' => '',
			't_weight' => '',
			't_line_height' => '',
			't_word_spacing' => '',
			't_letter_spacing' => '',
			'fo_body_id' => '',
			'fo_w_size' => '',
			'fo_m_size' => '',
			'fo_t_size' => '',
			'fo_color' => '',
			'fo_weight' => '',
			'fo_line_height' => '',
			'fo_word_spacing' => '',
			'fo_letter_spacing' => '',
			'fi_body_id' => '',
			'fi_w_size' => '',
			'fi_m_size' => '',
			'fi_t_size' => '',
			'fi_color' => '',
			'fi_weight' => '',
			'fi_line_height' => '',
			'fi_word_spacing' => '',
			'fi_letter_spacing' => '',
			'updated' => date('Y-m-d H:i:s')
		);
	}
}