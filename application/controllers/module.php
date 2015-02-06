<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module extends CI_Controller 
{
	public function __construct()
	{ 
		parent::__construct();
		$this->load->database();
		$this->load->dbforge();
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function add()
	{
		$this->form_validation->set_rules('name', 'Module Name', 'required|callback_is_module_exist');

		if ($this->form_validation->run() == TRUE)
		{
			$name = strtolower($this->input->post('name'));
			$fname = $this->input->post('fname');
			$ftype = $this->input->post('ftype');
			$fsize = $this->input->post('fsize');
			$post = $_POST;
			
			$this->create_table($name,$fname,$ftype,$fsize);
			$this->create_controller($post);
			$this->create_upload($name);

			$this->create_view_folder($name);
			$this->write_all_view($post);
			$this->write_create_view($post);
			$this->write_update_view($post);

			$this->session->set_flashdata('success_msg','Module Created Successfully.');
			redirect(base_url()._INDEX.$name.'/all');
		}
		else
		{
			$data['template'] = 'module/add';
			$this->load->view('templates/admin_template', $data);
		}
	}

	public function delete()
	{
		$this->form_validation->set_rules('name', 'Module Name', 'required');

		if ($this->form_validation->run() == TRUE)
		{ 
			$name = strtolower($this->input->post('name'));
			if($name == 'module')
			{
				$this->session->set_flashdata('error_msg','Are you crazy oooooooo MEN .....!');
				redirect(_INDEX.'module/delete');
			}
			@unlink('./application/controllers/'.$name.'.php');
			$this->remove_directory('./application/views/'.$name);
			$this->remove_directory('./assets/uploads/'.$name);
			$this->dbforge->drop_table($name);
			$this->session->set_flashdata('success_msg','Module has been removed successfully.');
			redirect(base_url()._INDEX.'module/delete');
		}
		else
		{
			$data['template'] = 'module/delete';
			$this->load->view('templates/admin_template', $data);
		}
	}


	function remove_directory($directory, $empty=FALSE)
    {
        if(substr($directory,-1) == '/') {
            $directory = substr($directory,0,-1);
        }

        if(!file_exists($directory) || !is_dir($directory)) {
            return FALSE;
        } elseif(!is_readable($directory)) {

        return FALSE;

        } else {

            $handle = opendir($directory);
            while (FALSE !== ($item = readdir($handle)))
            {
                if($item != '.' && $item != '..') {
                    $path = $directory.'/'.$item;
                    if(is_dir($path)) {
                        $this->remove_directory($path);
                    }else{
                        unlink($path);
                    }
                }
            }
            closedir($handle);
            if($empty == FALSE)
            {
                if(!rmdir($directory))
                {
                    return FALSE;
                }
            }
        return TRUE;
        }
    }

	public function is_module_exist($name)
	{
		$controller = file_exists('./application/controllers/'.$name.'.php');
		$view = file_exists('./application/views/'.$name);
		$upload = file_exists('./assets/uploads/'.$name);
		if($controller){
			$this->form_validation->set_message('is_module_exist', ucfirst($name).' controller already exists.');
			return FALSE;
		}else if($view){
			$this->form_validation->set_message('is_module_exist', ucfirst($name).' view already exists.');
			return FALSE;
		}else if($upload){
			$this->form_validation->set_message('is_module_exist', ucfirst($name).' folder already exists in assets/uploads.');
			return FALSE;
		}else if($this->db->table_exists($name)){
			$this->form_validation->set_message('is_module_exist', ucfirst($name).' table already exists in database.');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function create_table($name,$fname,$ftype,$fsize)
	{
		$count = count($fname);	
		$query = "CREATE TABLE IF NOT EXISTS `$name` (";
  		$query .= "`id` int(11) NOT NULL AUTO_INCREMENT,";
  		$query .= "`slug` varchar(255) NOT NULL,";
		for($i=0;$i<$count;$i++)
		{
			$fname[$i] = strtolower($fname[$i]);
			if($ftype[$i]=='text' || $ftype[$i]=='date'){
				$second = $ftype[$i]; 
			}else{
				$second = $ftype[$i].'('.$fsize[$i].')';
			}	
			$query .= "`$fname[$i]` $second NOT NULL,";
		}

		$query .= "`created` int(20) NOT NULL,";
		$query .= "`updated` int(20) NOT NULL,";
		$query .= "PRIMARY KEY (`id`)";
		$query .= ")";
		$status = mysql_query($query);
		if($status){
			return TRUE;
		}else{
			$this->session->set_flashdata('success_msg','Some problem in creating table.');
			redirect(base_url()._INDEX.'module/add');
		}
	}

/**
		START : Methods For Creating Controller
*/
	public function get_rules_create($post)
	{
		$table_name = $post['name'];
		$table_fields = $post['fname'];
		$validation_rules = "\n";
		$i = 1;
		foreach($table_fields as $fname)
		{
			$field_type = strtolower($post['type_'.$i]);

			$fname = strtolower($fname);
			$current_rules_index = $post['validation_'.$i];
			$min = $post['min_'.$i];
			$max = $post['max_'.$i];
			$exact = $post['exact_'.$i];
			$match = $post['match_'.$i];
			$display = $post['display_name_'.$i];
			$rules_array = array();
			$rules_array['0'] = 'trim';
			$rules_array['1'] = 'required';
	 		$rules_array['2'] = 'valid_email';
	 		$rules_array['3'] = 'is_unique['.$table_name.'.'.$fname.']';
	 		$rules_array['4'] = 'matches['.$match.']';
	 		$rules_array['5'] = 'min_length['.$min.']';
	 		$rules_array['6'] = 'max_length['.$max.']';
	 		$rules_array['7'] = 'exact_length['.$exact.']';
	 		$rules_array['8'] = 'numeric';
	 		$rules_array['9'] = 'alpha_numeric';
	 		$rules_array['10'] = 'alpha';
	 		$rules_array['11'] = 'integer';
	 		$rules_array['12'] = 'decimal'; 
			$rules_array['100'] = 'trim';// file required
			$rules_array['200'] = 'trim';// file type validation
			$rules_parameter = '';

			if($field_type == 'file'){
				$allowed_file_types = $post['allowed_file_types_'.$i];
				$allowed_file_size = $post['allowed_file_size_'.$i];
				if(in_array(100,$current_rules_index) && in_array(200,$current_rules_index)){
					$rules_parameter .= "callback_file_validation[$fname;required;$allowed_file_types;$allowed_file_size]"; 
				}elseif(in_array(100,$current_rules_index)){
					$rules_parameter .= "callback_file_validation[$fname;required;;]";
				}elseif(in_array(200,$current_rules_index)){
					$rules_parameter .= "callback_file_validation[$fname;;$allowed_file_types;$allowed_file_size]";
				}
			}else{
				foreach($current_rules_index as $single_rule_index)
				{
					$rules_parameter .= $rules_array[$single_rule_index].'|';
				}
			}
			$validation_rules .= "        ";							
			$validation_rules .= "$".""."this->form_validation->set_rules('".$fname."','".ucfirst($display)."','".$rules_parameter."');";							
			$validation_rules .= "\n";
			$i++;
		}
		return $validation_rules;
	}
	
	public function get_rules_update($post)
	{
		$table_name = $post['name'];
		$table_fields = $post['fname'];
		$validation_rules = "\n";
		$i = 1;
		foreach($table_fields as $fname)
		{
			$field_type = strtolower($post['type_'.$i]);	

			$fname = strtolower($fname);
			$current_rules_index = $post['validation_'.$i];
			$min = $post['min_'.$i];
			$max = $post['max_'.$i];
			$exact = $post['exact_'.$i];
			$match = $post['match_'.$i];
			$display = $post['display_name_'.$i];
			$rules_array = array();
			$rules_array['0'] = 'trim';
			$rules_array['1'] = 'required';
	 		$rules_array['2'] = 'valid_email';
	 		$rules_array['3'] = 'is_unique['.$table_name.'.'.$fname.']';
	 		$rules_array['4'] = 'matches['.$match.']';
	 		$rules_array['5'] = 'min_length['.$min.']';
	 		$rules_array['6'] = 'max_length['.$max.']';
	 		$rules_array['7'] = 'exact_length['.$exact.']';
	 		$rules_array['8'] = 'numeric';
	 		$rules_array['9'] = 'alpha_numeric';
	 		$rules_array['10'] = 'alpha';
	 		$rules_array['11'] = 'integer';
	 		$rules_array['12'] = 'decimal'; 
			$rules_array['100'] = 'trim';// file required
			$rules_array['200'] = 'trim';// file type validation
			$rules_parameter = '';
			
			if($field_type == 'file'){
				$allowed_file_types = $post['allowed_file_types_'.$i];
				$allowed_file_size = $post['allowed_file_size_'.$i];
				if(in_array(200,$current_rules_index)){
					$rules_parameter .= "callback_file_validation[$fname;;$allowed_file_types;$allowed_file_size]";
				}
				$validation_rules .= "        ";							
				$validation_rules .= "$".""."this->form_validation->set_rules('".$fname."','".ucfirst($display)."','".$rules_parameter."');";							
				$validation_rules .= "\n";
			}else{
				if(in_array(3,$current_rules_index)){
					$validation_rules .= "		if($"."data['rows']->".$fname." != $"."this->input->post('".$fname."'))\n";
					$validation_rules .= "		{\n";
					foreach($current_rules_index as $single_rule_index)
					{
						$rules_parameter .= $rules_array[$single_rule_index].'|';
					}
					$validation_rules .= "      		";							
					$validation_rules .= "$".""."this->form_validation->set_rules('".$fname."','".ucfirst($display)."','".$rules_parameter."');\n";							
					$validation_rules .= "		}\n";
				}else{
					foreach($current_rules_index as $single_rule_index)
					{
						$rules_parameter .= $rules_array[$single_rule_index].'|';
					}
					$validation_rules .= "        ";							
					$validation_rules .= "$".""."this->form_validation->set_rules('".$fname."','".ucfirst($display)."','".$rules_parameter."');\n";							
				}
			}
			$i++;
		}
		return $validation_rules;
	}

	public function get_insert_array($post)
	{
		$slug_as = $post['slug_as'];
		$table_name = $post['name'];
		$table_fields = $post['fname'];
		$data_string = "\n";
		$data_string .= "			";
		$data_string .= "$"."insert = array(";
		$data_string .= "\n";
		$data_string .= "			";
		$data_string .= "	'slug' => create_slug('".$table_name."',$"."this->input->post('".$slug_as."')),";
		$data_string .= "\n";
		$i = 1;
		foreach($table_fields as $fname)
		{
			$input_type = strtolower($post['type_'.$i]);
			$data_string .= "			";
			if($input_type=='password')
			{
				$data_string .=	"	'".strtolower($fname)."' => sha1($"."this->input->post('".strtolower($fname)."')),";
			}
			else if($input_type=='file')
			{
				$data_string_NA = "";
			}
			else
			{
				$data_string .=	"	'".strtolower($fname)."' => $"."this->input->post('".strtolower($fname)."'),";
			}
			$data_string .= "\n";
			$i++;
		}
		$data_string .= "			";
		$data_string .= "	'created' => time()";
		$data_string .= "\n";
		$data_string .= "			";
		$data_string .= ");";
		$data_string .= "\n";

		return $data_string;	
	}

	public function get_update_array($post)
	{
		$slug_as = $post['slug_as'];
		$table_name = $post['name'];
		$table_fields = $post['fname'];
		$data_string = "\n";
		$data_string .= "			";
		$data_string .= "$"."update = array(";
		$data_string .= "\n";
		$data_string .= "			";
		$data_string .= "	'slug' => create_slug_for_update('".$table_name."',$"."this->input->post('".$slug_as."')),";
		$data_string .= "\n";
		$i = 1;
		foreach($table_fields as $fname)
		{
			$input_type = strtolower($post['type_'.$i]);
			$data_string .= "			";
			if($input_type=='password')
			{
				$data_string .=	"	'".strtolower($fname)."' => sha1($"."this->input->post('".strtolower($fname)."')),";
			}
			else if($input_type=='file')
			{
				$data_string_NA = "";
			}
			else
			{
				$data_string .=	"	'".strtolower($fname)."' => $"."this->input->post('".strtolower($fname)."'),";
			}
			$data_string .= "\n";
			$i++;
		}
		$data_string .= "			";
		$data_string .= "	'updated' => time()";
		$data_string .= "\n";
		$data_string .= "			";
		$data_string .= ");";
		$data_string .= "\n";

		return $data_string;	
	}

	public function image_data_create($post)
	{
		$module = strtolower($post['name']);
		$fname = $post['fname'];
		$ftype = $post['ftype'];
		$image_data = "\n";
		$i = 1;
		foreach($fname as $fname)
		{
			$fname = strtolower($fname);
			$ftype = strtolower($post['type_'.$i]);
			if($ftype == 'file')
			{
				$image_data .= "			$"."insert['".$fname."'] = ' ';\n";
				$image_data .= "			if($"."_FILES['".$fname."']['name']!='')\n";
				$image_data .= "			{\n";
				$image_data .= "				$"."ext = pathinfo($"."_FILES['".$fname."']['name'], PATHINFO_EXTENSION);\n";
				$image_data .= "				$"."insert['".$fname."'] = uniqid().'.'.$"."ext;\n";
				$image_data .= "   				move_uploaded_file($"."_FILES['".$fname."']['tmp_name'],'./assets/uploads/".$module."/'.$"."insert['".$fname."']);\n";			
				$image_data .= "   				create_thumb($"."insert['".$fname."'],'./assets/uploads/".$module."/');\n";
				$image_data .= "			}\n\n";
			}
			$i++;
		}
		return $image_data;
	}

	public function image_data_update($post)
	{
		$module = strtolower($post['name']);
		$fname = $post['fname'];
		$ftype = $post['ftype'];
		$image_data = "\n";
		$i = 1;
		foreach($fname as $fname)
		{
			$fname = strtolower($fname);
			$ftype = strtolower($post['type_'.$i]);
			if($ftype == 'file')
			{
				$image_data .= "			$"."update['".$fname."'] = $"."data['rows']->".$fname.";\n";
				$image_data .= "			if($"."_FILES['".$fname."']['name']!='')\n";
				$image_data .= "			{\n";
				$image_data .= "				$"."ext = pathinfo($"."_FILES['".$fname."']['name'], PATHINFO_EXTENSION);\n";
				$image_data .= "				$"."update['".$fname."'] = uniqid().'.'.$"."ext;\n";
				$image_data .= "   				move_uploaded_file($"."_FILES['".$fname."']['tmp_name'],'./assets/uploads/".$module."/'.$"."update['".$fname."']);\n";			
				$image_data .= "   				create_thumb($"."update['".$fname."'],'./assets/uploads/".$module."/');\n";
				$image_data .= "   				@unlink('./assets/uploads/".$module."/'.$"."data['rows']->".$fname.");\n";
				$image_data .= "   				@unlink('./assets/uploads/".$module."/thumbs/'.$"."data['rows']->".$fname.");\n";
				$image_data .= "			}\n\n";
			}
			$i++;
		}
		return $image_data;
	}

	public function image_data_delete($post)
	{
		$module = strtolower($post['name']);
		$fname = $post['fname'];
		$ftype = $post['ftype'];
		$image_data = "\n";
		$i = 1;
		foreach($fname as $fname)
		{
			$fname = strtolower($fname);
			$ftype = strtolower($post['type_'.$i]);
			if($ftype == 'file')
			{
				$image_data .= "   		@unlink('./assets/uploads/".$module."/'.$"."row->".$fname.");\n";
				$image_data .= "   		@unlink('./assets/uploads/".$module."/thumbs/'.$"."row->".$fname.");\n";
			}
			$i++;
		}
		return $image_data;
	}

	public function create_controller($post)
	{
		$cname =  strtolower($post['name']);
		$cpath = './application/controllers/';
		$validation_rules_create = $this->get_rules_create($post);
		$validation_rules_update = $this->get_rules_update($post);
		$insert_array = $this->get_insert_array($post);
		$update_array = $this->get_update_array($post);
		$image_data_create = $this->image_data_create($post);
		$image_data_update = $this->image_data_update($post);
		$image_data_delete = $this->image_data_delete($post);
		$new_controller = @fopen($cpath.$cname.'.php','w');
		$status = file_exists('./application/controllers/'.$cname.'.php');
		if($status)
		{
			$content = "<?php ";
			$content .=	"if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n";
			$content .= "class ".ucfirst($cname)." extends CI_Controller\n";
			$content .= "{\n"; 
			$content .= "   public function __construct()\n";
			$content .= "   {\n"; 
			$content .= "		parent::__construct();\n";
			$content .= "		$"."this->load->model('admin_model');\n";
			$content .= "   }\n\n";
			$content .= "   public function all($"."offset=0)\n";
			$content .= "	{\n"; 
			$content .= " 		$"."limit=10;\n";
			$content .= " 		$"."data['rows'] = $"."this->admin_model->get_pagination_result('".$cname."',$"."limit,$"."offset);\n";
			$content .= " 		$"."config = get_theme_pagination();\n";	
			$content .= " 		$"."config['base_url'] = base_url()._INDEX.'".$cname."/all/';\n";
			$content .= " 		$"."config['total_rows'] = $"."this->admin_model->get_pagination_result('".$cname."',0,0);\n";
			$content .= " 		$"."config['per_page'] = $"."limit;\n";
			$content .= " 		$"."this->pagination->initialize($"."config);\n"; 		
			$content .= " 		$"."data['pagination'] = $"."this->pagination->create_links();\n";		
			$content .= "		$"."data['template'] = '".$cname."/all';\n";
			$content .= "		$"."this->load->view('templates/admin_template',$".''."data);\n";
			$content .= "	}\n\n";
			$content .= "	public function add()\n"; 
			$content .= "	{\n";
			$content .= 		$validation_rules_create."\n"; 
			$content .= "		if($"."this->form_validation->run() == TRUE)\n"; 
			$content .= "		{\n";
			$content .= 			$insert_array;
			$content .= 			$image_data_create;
			$content .= "		    $"."this->admin_model->insert('".$cname."',$"."insert);\n";
 			$content .= "		    $"."this->session->set_flashdata('success_msg','Added successfully.');\n";
			$content .= "                    redirect(_INDEX.'".$cname."/all');\n";
			$content .= "		}\n";
			$content .= "		$"."data['template'] = '".$cname."/add';\n";
			$content .= "                $"."this->load->view('templates/admin_template',$"."data);\n";
			$content .= "	}\n\n";
			$content .= "	public function edit($"."slug='')\n"; 
			$content .= "	{\n";
			$content .= "	    	$"."data['rows'] = $"."this->admin_model->get_row('".$cname."',array('slug'=>$"."slug));	\n";
			$content .= 		$validation_rules_update."\n"; 
			$content .= "		if($"."this->form_validation->run() == TRUE)\n"; 
			$content .= "		{\n";
			$content .= 			$update_array;
			$content .= 			$image_data_update;
			$content .= "		    $"."where = array('slug' => $"."slug);\n";
			$content .= "		    $"."this->admin_model->update('".$cname."',$"."update,$"."where);\n";
 			$content .= "		    $"."this->session->set_flashdata('success_msg','Updated successfully.');\n";
			$content .= "           redirect(_INDEX.'".$cname."/all');\n";
			$content .= "		}\n";
			$content .= "		$"."data['template'] = '".$cname."/edit';\n";
			$content .= "       $"."this->load->view('templates/admin_template',$"."data);\n";
			$content .= "	}\n\n";
			$content .= "	public function delete($"."slug='')\n"; 
			$content .= "	{\n";
			$content .= "		$"."where = array('slug' => $"."slug);\n";
			$content .= "	    $"."row = $"."this->admin_model->get_row('".$cname."',$"."where);	\n";
			$content .= "	    $"."this->admin_model->delete('".$cname."',$"."where);	\n";
			$content .= $image_data_delete;
 			$content .= "		$"."this->session->set_flashdata('success_msg','Deleted successfully.');\n";
			$content .= "        redirect(_INDEX.'".$cname."/all');\n";
			$content .= "	}\n\n";
			$content .= "	public function file_validation($"."post=NULL,$"."parameter)\n";
			$content .= "	{\n";
			$content .= "		list($"."file,$"."required,$"."types,$"."size) = explode(';',$"."parameter);\n";
			$content .=	"		if($"."required != ''){ \n";
			$content .=	"			if($"."_FILES[$"."file]['name'] == ''){\n";
			$content .=	"				$"."this->form_validation->set_message('file_validation','Please select an file to upload.');\n";
			$content .=	"				return false;\n";
			$content .=	"			}\n";
			$content .=	"		}\n";
			$content .=	"		\n";
			$content .=	"		if($"."_FILES[$"."file]['name'] == ''){\n";
			$content .=	"			return true;\n";
			$content .=	"		}\n";
			$content .=	"		\n";
			$content .=	"		if($"."types != ''){\n";
			$content .=	"			$"."format = strtolower(pathinfo($"."_FILES[$"."file]['name'],PATHINFO_EXTENSION));\n";
			$content .=	"			$"."types_array = explode(',',$"."types);\n";
			$content .=	"			if(!in_array($"."format,$"."types_array)){\n";
			$content .=	"				$"."this->form_validation->set_message('file_validation','File format not allowed.');\n";
			$content .=	"				return false;\n";
			$content .=	"			}\n";
			$content .=	"		}\n";
			$content .=	"		\n";
			$content .=	"		if($"."size != ''){\n";
			$content .=	"			$"."actual_size = $"."_FILES[$"."file]['size']/1048576;\n";
			$content .=	"			if($"."actual_size > $"."size){\n";
			$content .=	"				$"."this->form_validation->set_message('file_validation','File not allowed which is large than '.$"."size.' MB.');\n";
			$content .=	"				return FALSE;\n";
			$content .=	"			}\n";
			$content .=	"		}\n";
			$content .=	"		return true;\n";
			$content .=	"	}\n";
			$content .= "\n\n"; 
			$content .= "}";
			$content .= "\n"; 
			$content .= "?>";
			fwrite($new_controller,$content);
			fclose($new_controller);
			return true;
		}
		else
		{
			$this->session->set_flashdata('success_msg','Some problem in creating controller.');
			redirect(base_url()._INDEX.'module/add');
		}
	}
/**
		END : Methods For Creating Controller
*/

/**
		START : Methods For Creating Views
*/
	public function create_view_folder($vname)
	{
		$vpath = './application/views/';
		@mkdir($vpath.$vname);
		$status = file_exists($vpath.$vname);
		if($status){
			return true;
		}else{
			$this->session->set_flashdata('success_msg','Some problem in creating view folder.');
			redirect(base_url()._INDEX.'module/add');
		}
	}	

	public function write_create_view($post)
	{
		$vpath = './application/views/';
		$vname = strtolower($post['name']);
		$table_name = $post['fname'];

		$content  = "<section>\n";
		$content .= "<section class='vbox'>\n";
		$content .= "<?php $"."this->load->view('admin/subheader'); ?>\n";
		$content .= "<section id='content'>\n";
		$content .= "<section class='wrapper'>\n";
		$content .= "<div class='row'>\n";
		$content .= "<div class='col-lg-12'>\n";
		$content .= "<?php alert(); ?>\n";
		$content .= "<section class='panel'>\n";
		$content .= "<header class='panel-heading'>\n";
		$content .= "Add New\n";
		$content .= "</header>\n";
		$content .= "<div class='panel-body'>\n";
		$content .= "<div class=' form'>\n";
		$content .= "<?php echo form_open_multipart(cms_current_url(),array('class'=>'cmxform form-horizontal form-example')) ?>\n";

		$i = 1;
		foreach($table_name as $row)
		{
			$table_name = strtolower($row);	
			$display_name = ucwords($post['display_name_'.$i]);
			$input_type = strtolower($post['type_'.$i]);	
			if($input_type == 'select')
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<select class='form-control' name='".$table_name."'><option value=''>Please Select</option><option value='1'>Yes</option><option value='0'>No</option></select>\n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}
			else if($input_type == 'textarea')
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<textarea class='form-control' rows='5' name='".$table_name."'><?php echo set_value('".$table_name."'); ?></textarea>\n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}
			else if($input_type == 'file')
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<input type='".$input_type."' name='".$table_name."'>\n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}	
			else
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<input type='".$input_type."' class='form-control' name='".$table_name."' value='<?php echo set_value(".'"'.$table_name.'"'."); ?>'> \n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}	
			$i++;
		}

		$content .= "<div class='form-group'>\n";
		$content .= "<div class='col-lg-offset-2 col-lg-10'>\n";
		$content .= "<input name='submit' type='submit' class='btn btn-primary' value='Add'>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "<?php echo form_close(); ?>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "</section>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";

		$add_view = @fopen($vpath.$vname.'/add.php','w');
		@fwrite($add_view,$content);
		@fclose($add_view);
		return true;
	}
	
	public function write_update_view($post)
	{
		$vpath = './application/views/';
		$vname = strtolower($post['name']);
		$table_name = $post['fname'];

		$content  = "<section>\n";
		$content .= "<section class='vbox'>\n";
		$content .= "<?php $"."this->load->view('admin/subheader'); ?>\n";
		$content .= "<section id='content'>\n";
		$content .= "<section class='wrapper'>\n";
		$content .= "<div class='row'>\n";
		$content .= "<div class='col-lg-12'>\n";
		$content .= "<?php alert(); ?>\n";
		$content .= "<section class='panel'>\n";
		$content .= "<header class='panel-heading'>\n";
		$content .= "Edit\n";
		$content .= "</header>\n";
		$content .= "<div class='panel-body'>\n";
		$content .= "<div class=' form'>\n";
		$content .= "<?php echo form_open_multipart(cms_current_url(),array('class'=>'cmxform form-horizontal form-example')) ?>\n";

		$i = 1;
		foreach($table_name as $row)
		{
			$table_name = strtolower($row);	
			$display_name = ucwords($post['display_name_'.$i]);
			$input_type = strtolower($post['type_'.$i]);	
			if($input_type == 'select')
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<select class='form-control' name='".$table_name."'><option value='' >Please Select</option><option value='1'>Yes</option><option value='0'>No</option></select>\n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}
			else if($input_type == 'textarea')
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<textarea class='form-control' rows='5' name='".$table_name."'><?php echo $"."rows->".$table_name."; ?></textarea>\n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}
			else if($input_type == 'file')
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<input type='file' name='".$table_name."'>\n";
				$content .= "<br><br><img style='width:200px; height:200px;' src='<?php echo base_url(); ?>assets/uploads/".$vname."/<?php echo $"."rows->".$table_name."; ?>'>\n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}	
			else
			{
				$content .= "<div class='form-group '>\n";
				$content .= "<label for='ccomment' class='control-label col-lg-2'>".$display_name."</label>\n";
				$content .= "<div class='col-lg-10'>\n";
				$content .= "<input type='".$input_type."' class='form-control' name='".$table_name."' value='<?php echo $"."rows->".$table_name."; ?>'> \n";
				$content .= "<span class='error'><?php echo form_error('".$table_name."'); ?></span>\n";
				$content .= "</div>\n";
				$content .= "</div>\n";
			}	
			$i++;
		}

		$content .= "<div class='form-group'>\n";
		$content .= "<div class='col-lg-offset-2 col-lg-10'>\n";
		$content .= "<input name='submit' type='submit' class='btn btn-primary' value='Edit'>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "<?php echo form_close(); ?>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "</section>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";

		$edit_view = @fopen($vpath.$vname.'/edit.php','w');
		@fwrite($edit_view,$content);
		@fclose($edit_view);
		return true;
	}

	public function write_all_view($post)
	{
		$vpath = './application/views/';
		$vname = strtolower($post['name']);
		$table_name = $post['fname'];

		$content  = "<section>\n";
		$content .= "<section class='vbox'>\n";
		$content .= "<?php $"."this->load->view('admin/subheader'); ?>\n";
		$content .= "<section id='content'>\n";
		$content .= "<section class='wrapper'>\n";
		$content .= "<div class='row'>\n";
		$content .= "<div class='col-lg-12'>\n";
		$content .= "<section class='panel'>\n";
		$content .= "<header class='panel-heading'>\n";
		$content .= "".ucfirst($post['name'])."\n";
		$content .= "<a href='<?php echo base_url()._INDEX ?>".$vname."/add' class='btn btn-success pull-right' style='margin-top:-8px;'>Add New</a>\n";
		$content .= "</header>\n";
		$content .= "<div class='panel-body'>\n";
		$content .= "<?php alert(); ?>\n";
		$content .= "<section id='unseen'>\n";
		$content .= "<?php if(!empty($"."rows)): ?>\n";
		$content .= "<table class='table table-bordered table-striped table-condensed'>\n";
		$content .= "<thead>\n";
		$content .= "<tr>\n";
		$i = 1;
		foreach($table_name as $field_name)
		{
			$input_type = strtolower($post['type_'.$i]);
			if($input_type != 'password'){
				$content .= "<th>".ucwords($post['display_name_'.$i])."</th>\n";
			}
			$i++;
		}
		$content .= "<th>Created</th>\n";
		$content .= "<th>Actions</th>\n";
		$content .= "</tr>\n";
		$content .= "</thead>\n";
		$content .= "<tbody>\n";

		$content .= "<?php foreach($"."rows as $"."row): ?>\n";
		$content .= "<tr>\n";

		$i = 1;
		foreach($table_name as $field_name)
		{
			$input_type = strtolower($post['type_'.$i]);
			if($input_type == 'file'){
				$content .= "<td><img src='<?php echo base_url(); ?>assets/uploads/".$vname."/<?php echo $"."row->".$field_name."; ?>' style='width:80px; height:80px;'></td>\n";
			}else if($input_type == 'email'){
				$content .= "<td><a href='mailto:<?php echo $"."row->".$field_name."; ?>'><?php echo $"."row->".$field_name."; ?></a></td>\n";
			}else if($input_type == 'password'){
				$content .= '';
			}else{
				$content .= "<td><?php echo $"."row->".$field_name."; ?></td>\n";
			}	
			$i++;
		}

		$content .= "<td><?php echo date('Y-m-d',$"."row->created); ?></td>";
		$content .= "<td>";
		$content .= "<a class='btn btn-info' href='<?php echo base_url()._INDEX; ?>".$vname."/edit/<?php echo $"."row->slug; ?>'  >Edit</a>";
		$content .= "&nbsp;&nbsp;&nbsp;";
		$content .= "<a class='btn btn-danger' onclick='return confirm(\"Are you sure ?\");' href='<?php echo base_url()._INDEX; ?>".$vname."/delete/<?php echo $"."row->slug; ?>' >Delete</a>";
		$content .= "</td>";
		$content .= "</tr>\n";
		$content .= "<?php endforeach; ?>\n";

		$content .= "</tbody>\n";
		$content .= "</table>\n";
		$content .= "<?php else: ?>\n";
		$content .= "No record found.\n";
		$content .= "<?php endif; ?>\n";
		$content .= "</section>\n";
		$content .= "<?php echo @$"."pagination; ?>\n";
		$content .= "</div>\n";
		$content .= "</section>\n";
		$content .= "</div>\n";
		$content .= "</div>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";
		$content .= "</section>\n";

		$all_view = @fopen($vpath.$vname.'/all.php','w');
		@fwrite($all_view,$content);
		@fclose($all_view);
		return true;
	}
/**
		END : Methods For Creating Views
*/

	
	public function create_upload($name)
	{
		$path = './assets/uploads/';
		@mkdir($path.$name);
		@mkdir($path.$name.'/thumbs');
		$status1 = file_exists($path.$name);
		$status2 = file_exists($path.$name.'/thumbs');
		if($status1 && $status2){
			return true;
		}else{
			$this->session->set_flashdata('success_msg','Some problem in creating uploads folder.');
			redirect(base_url()._INDEX.'module/add');
		}
	}


}