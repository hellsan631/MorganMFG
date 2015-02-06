<?php

/**

* check Admin authentication

*/

if ( ! function_exists('admin_login_in')) {  

	function admin_login_in() {

		$CI =& get_instance();

		$user_info=$CI->session->userdata('AdminInfo');    

		if($user_info['logged_in']===TRUE && $user_info['role'] == 1)

			return TRUE;    

		else

			return FALSE;       

	}

}



/**

* alert

*/

if ( ! function_exists('alert')) {  

	function alert() {

		$CI =& get_instance();

		if ($CI->session->flashdata('success_msg')){

			echo success_alert($CI->session->flashdata('success_msg'));

		}

		if ($CI->session->flashdata('error_msg')){

			echo error_alert($CI->session->flashdata('error_msg')); 

		}

		if ($CI->session->flashdata('info_msg')){

			echo error_alert($CI->session->flashdata('info_msg')); 

		}

		$js = "";

		$js .= "<script>";

		$js .= "$(document).ready(function(){";

		$js .= "setTimeout(function(){";

		$js .= "$('.alert').fadeOut('slow');";

		$js .= "}, 2000);";

		$js .= "});";

		$js .= "</script>";



		echo $js;

	}

}



/**

* Success alert

*/

if ( ! function_exists('success_alert')) {

	function success_alert($msg = '') { ?>

		<div class="alert alert-success ci_alert alert-dismissable">

  			<button data-dismiss="alert" class="close" type="button">×</button>

  			<strong>Success!</strong> <?php echo $msg ?>

		</div>

  	<?php 

	}

}



/**

* Error alert

*/

if ( ! function_exists('error_alert')) {  

	function error_alert($msg = '') {?>

		<div class="alert alert-danger ci_alert alert-dismissable">

			<button data-dismiss="alert" class="close" type="button">×</button>

	        <strong>Error!</strong> <?php echo $msg ?>

	    </div>

  	<?php 

  	}

}



/**

* info alert

*/

if ( ! function_exists('info_alert')) { 

	function info_alert($msg = '') {?>

		<div class="alert alert-info ci_alert alert-dismissable">

			<button data-dismiss="alert" class="close" type="button">×</button>

			<strong>Error!</strong> <?php echo $msg ?>

		</div>

	<?php 

	}

}



/**

* get usename

*/

if ( ! function_exists('login_username')) { 

	function login_username() {

		$CI =& get_instance();    

		$user_info = $CI->session->userdata('UserInfo');    

		return $user_info['display_name'];  

	}

}



/**

* clear cache

*/

if ( ! function_exists('clear_cache')) {

	function clear_cache(){

		$CI =& get_instance();

		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );

		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');

		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");

		$CI->output->set_header("Pragma: no-cache");      

	}

}



/**

* convert id to encrypt code

*/

if ( ! function_exists('id_encrypt')) { 

	function id_encrypt($id = NULL) {

		$CI =& get_instance();

		return $CI->encrypt->encode($id);

	}

}



/**

* convert decrypt code to id

*/

if ( ! function_exists('id_decrypt')) { 

	function id_decrypt($code = NULL) {

		$CI =& get_instance();

		return $CI->encrypt->decode($code);

	}

}





/* get_theme pagination */

if ( ! function_exists('get_theme_pagination')) {

	function get_theme_pagination(){

		$data = array();

		$data['cur_tag_open'] = '<li class="disabled"><a>';

		$data['cur_tag_close'] = '<</li>';

		$data['full_tag_open'] = '<div style="padding-left:10px"><ul class="pagination">';

		$data['full_tag_close'] = '</ul></div>';

		$data['first_tag_open'] = '<li>';

		$data['first_tag_close'] = '</li>';

		$data['num_tag_open'] = '<li>';

		$data['num_tag_close'] = '</li>';

		$data['last_tag_open'] = '<li>';

		$data['last_tag_close'] = '</li>';

		$data['next_tag_open'] = '<li>';

		$data['next_tag_close'] = '</li>';

		$data['prev_tag_open'] = '<li>';

		$data['prev_tag_close'] = '</li>';

		$data['next_link'] = '&raquo;';

		$data['prev_link'] = '&laquo;';

		$data['cur_tag_open'] = '<li class="active"><a>';

		$data['cur_tag_close'] = '</a></li>';

		return $data;

	}

}







/* theme pagination */

if ( ! function_exists('theme_pagination')) {

	function theme_pagination(){

		$data = array();

		$data['cur_tag_open'] = '<li class="disabled"><a>';

		$data['cur_tag_close'] = '<</li>';

		$data['full_tag_open'] = '<div class="blog_nav"><ul>';

		$data['full_tag_close'] = '</ul></div>';

		$data['first_tag_open'] = '<li>';

		$data['first_tag_close'] = '</li>';

		$data['num_tag_open'] = '<li>';

		$data['num_tag_close'] = '</li>';

		$data['last_tag_open'] = '<li>';

		$data['last_tag_close'] = '</li>';

		$data['next_tag_open'] = '<li>';

		$data['next_tag_close'] = '</li>';

		$data['prev_tag_open'] = '<li>';

		$data['prev_tag_close'] = '</li>';

		$data['next_link'] = '&raquo;';

		$data['prev_link'] = '&laquo;';

		$data['cur_tag_open'] = '<li class="active"><a>';

		$data['cur_tag_close'] = '</a></li>';

		return $data;

	}

}



if (!function_exists('remove_special_character')){

	function remove_special_character($string=''){

		return str_replace(array('!','@','#','$','%','^','&','*','(',')','+','{','}','[',']',':','\'', '"', ',' , ';', '<', '>','|','\\','?','/' ), '', $string);           

	}

}



/**

* Create Slug

*/

if ( ! function_exists('create_slug')) {  

	function create_slug($tablename = '', $title = '') {

    $title = substr($title, 0,10);

		$CI =& get_instance();

		$slug = str_replace(array('!','@','#','$','%','^','&','*','(',')','+','{','}','[',']',':','\'', '"', ',' , ';', '<', '>','|','\\','?','/' ), ' ', $title);     

		$slug = str_replace(' ', '-', $slug);

		$slug = strtolower($slug);

		return get_slug($tablename, $slug);

	}

}



if ( ! function_exists('get_slug')) {  

	function get_slug($tablename = '', $slug = '', $append = '') {

		$CI =& get_instance();

		$CI->db->select('slug');

		

		if($append == '')

			$CI->db->where('slug', $slug);

		else

			$CI->db->where('slug', $slug.'-'.$append);

		

		$query = $CI->db->get($tablename);

		if($query->num_rows() > 0){

			if($append == '')

				$append = 1;

			else

				$append = $append + 1;

			return get_slug($tablename, $slug, $append);

		}

		else{

			if($append == '')

				return $slug;

			else

				return $slug.'-'.$append;

		}

	}

}



/**

* Create Slug

*/

if ( ! function_exists('create_slug_for_update')) {  

	function create_slug_for_update($tablename = '', $title = '', $id = '') {

    $title = substr($title, 0,10);

		$CI =& get_instance();

		$slug = str_replace(array('!','@','#','$','%','^','&','*','(',')','+','{','}','[',']',':','\'', '"', ',' , ';', '<', '>','|','\\','?','/' ), ' ', $title);     

		$slug = str_replace(' ', '-', $slug);

		$slug = strtolower($slug);

		return get_slug_for_update($tablename, $slug, $id);

	}

}



if ( ! function_exists('get_slug_for_update')) {  

	function get_slug_for_update($tablename = '', $slug = '', $id = '' , $append = '') {

		$CI =& get_instance();

		$CI->db->select('slug');

		

		$CI->db->where('id !=', $id);

		if($append == ''){

			$CI->db->where('slug', $slug);

		}

		else{

			$CI->db->where('slug', $slug.'-'.$append);

		}

		

		$query = $CI->db->get($tablename);

		if($query->num_rows() > 0){

			if($append == '')

				$append = 1;

			else

				$append = $append + 1;

			return get_slug_for_update($tablename, $slug, $id , $append);

		}

		else{

			if($append == '')

				return $slug;

			else

				return $slug.'-'.$append;

		}

	}

}



function create_thumb($file = '', $path = './assets/uploads/' ){

	$thumbpath = $path.'thumbs/';

	if (!is_writable($thumbpath)) {

        if (!chmod($thumbpath, 0777)) {

            return FALSE;

        }

    }

    $CI =& get_instance();

    $CI->load->library('image_lib');

	$config['image_library'] = 'gd2';

	$config['source_image'] = $path.$file;

	$config['new_image'] = $thumbpath.$file;

	$config['quality'] = '100%';

	$config['maintain_ratio'] = TRUE;

	$config['width'] = 200;

	$config['height'] = 200;				

	$CI->image_lib->initialize($config);

	if ( ! $CI->image_lib->resize()){

		return FALSE;

	}else{

		return TRUE;

	}

}



function delete_image($file = '', $path = './assets/uploads/' ){

	$thumb = $path.'thumbs/'.$file;

	$image = $path.$file;

	@unlink($thumb);

	@unlink($image);

	return TRUE;

}





if ( ! function_exists('get_country_array'))

  { 

    function get_country_array()

    {

      

      return array(

              "US"=>"United States",

              "AF"=>"Afghanistan",

              "AX"=>"Aland Islands",

              "AL"=>"Albania",

              "DZ"=>"Algeria",

              "AS"=>"American Samoa",

              "AD"=>"Andorra",

              "AO"=>"Angola",

              "AI"=>"Anguilla",

              "AQ"=>"Antarctica",

              "AG"=>"Antigua and Barbuda",

              "AR"=>"Argentina",

              "AM"=>"Armenia",

              "AW"=>"Aruba",

              "AU"=>"Australia",

              "AT"=>"Austria",

              "AZ"=>"Azerbaijan",

              "BS"=>"Bahamas",

              "BH"=>"Bahrain",

              "BD"=>"Bangladesh",

              "BB"=>"Barbados",

              "BY"=>"Belarus",

              "BE"=>"Belgium",

              "BZ"=>"Belize",

              "BJ"=>"Benin",

              "BM"=>"Bermuda",

              "BT"=>"Bhutan",

              "BO"=>"Bolivia, Plurinational State of",

              "BQ"=>"Bonaire, Sint Eustatius and Saba",

              "BA"=>"Bosnia and Herzegovina",

              "BW"=>"Botswana",

              "BV"=>"Bouvet Island",

              "BR"=>"Brazil",

              "IO"=>"British Indian Ocean Territory",

              "BN"=>"Brunei Darussalam",

              "BG"=>"Bulgaria",

              "BF"=>"Burkina Faso",

              "BI"=>"Burundi",

              "KH"=>"Cambodia",

              "CM"=>"Cameroon",

              "CA"=>"Canada",

              "CV"=>"Cape Verde",

              "KY"=>"Cayman Islands",

              "CF"=>"Central African Republic",

              "TD"=>"Chad",

              "CL"=>"Chile",

              "CN"=>"China",

              "CX"=>"Christmas Island",

              "CC"=>"Cocos (Keeling) Islands",

              "CO"=>"Colombia",

              "KM"=>"Comoros",

              "CG"=>"Congo",

              "CD"=>"Congo, The Democratic Republic of the",

              "CK"=>"Cook Islands",

              "CR"=>"Costa Rica",

              "CI"=>"Cote D'Ivoire",

              "HR"=>"Croatia",

              "CU"=>"Cuba",

              "CW"=>"Curaçao",

              "CY"=>"Cyprus",

              "CZ"=>"Czech Republic",

              "DK"=>"Denmark",

              "DJ"=>"Djibouti",

              "DM"=>"Dominica",

              "DO"=>"Dominican Republic",

              "EC"=>"Ecuador",

              "EG"=>"Egypt",

              "SV"=>"El Salvador",

              "GQ"=>"Equatorial Guinea",

              "ER"=>"Eritrea",

              "EE"=>"Estonia",

              "ET"=>"Ethiopia",

              "FK"=>"Falkland Islands (Malvinas)",

              "FO"=>"Faroe Islands",

              "FJ"=>"Fiji",

              "FI"=>"Finland",

              "FR"=>"France",

              "GF"=>"French Guiana",

              "PF"=>"French Polynesia",

              "TF"=>"French Southern Territories",

              "GA"=>"Gabon",

              "GM"=>"Gambia",

              "GE"=>"Georgia",

              "DE"=>"Germany",

              "GH"=>"Ghana",

              "GI"=>"Gibraltar",

              "GR"=>"Greece",

              "GL"=>"Greenland",

              "GD"=>"Grenada",

              "GP"=>"Guadeloupe",

              "GU"=>"Guam",

              "GT"=>"Guatemala",

              "GG"=>"Guernsey",

              "GN"=>"Guinea",

              "GW"=>"Guinea-Bissau",

              "GY"=>"Guyana",

              "HT"=>"Haiti",

              "HM"=>"Heard Island and McDonald Islands",

              "VA"=>"Holy See (Vatican City State)",

              "HN"=>"Honduras",

              "HK"=>"Hong Kong",

              "HU"=>"Hungary",

              "IS"=>"Iceland",

              "IN"=>"India",

              "ID"=>"Indonesia",

              "IR"=>"Iran, Islamic Republic of",

              "IQ"=>"Iraq",

              "IE"=>"Ireland",

              "IM"=>"Isle of Man",

              "IL"=>"Israel",

              "IT"=>"Italy",

              "JM"=>"Jamaica",

              "JP"=>"Japan",

              "JE"=>"Jersey",

              "JO"=>"Jordan",

              "KZ"=>"Kazakhstan",

              "KE"=>"Kenya",

              "KI"=>"Kiribati",

              "KP"=>"Korea, Democratic People's Republic of",

              "KR"=>"Korea, Republic of",

              "KW"=>"Kuwait",

              "KG"=>"Kyrgyzstan",

              "LA"=>"Lao People's Democratic Republic",

              "LV"=>"Latvia",

              "LB"=>"Lebanon",

              "LS"=>"Lesotho",

              "LR"=>"Liberia",

              "LY"=>"Libya",

              "LI"=>"Liechtenstein",

              "LT"=>"Lithuania",

              "LU"=>"Luxembourg",

              "MO"=>"Macao",

              "MK"=>"Macedonia, The Former Yugoslav Republic of",

              "MG"=>"Madagascar",

              "MW"=>"Malawi",

              "MY"=>"Malaysia",

              "MV"=>"Maldives",

              "ML"=>"Mali",

              "MT"=>"Malta",

              "MH"=>"Marshall Islands",

              "MQ"=>"Martinique",

              "MR"=>"Mauritania",

              "MU"=>"Mauritius",

              "YT"=>"Mayotte",

              "MX"=>"Mexico",

              "FM"=>"Micronesia, Federated States of",

              "MD"=>"Moldova, Republic of",

              "MC"=>"Monaco",

              "MN"=>"Mongolia",

              "ME"=>"Montenegro",

              "MS"=>"Montserrat",

              "MA"=>"Morocco",

              "MZ"=>"Mozambique",

              "MM"=>"Myanmar",

              "NA"=>"Namibia",

              "NR"=>"Nauru",

              "NP"=>"Nepal",

              "NL"=>"Netherlands",

              "NC"=>"New Caledonia",

              "NZ"=>"New Zealand",

              "NI"=>"Nicaragua",

              "NE"=>"Niger",

              "NG"=>"Nigeria",

              "NU"=>"Niue",

              "NF"=>"Norfolk Island",

              "MP"=>"Northern Mariana Islands",

              "NO"=>"Norway",

              "OM"=>"Oman",

              "PK"=>"Pakistan",

              "PW"=>"Palau",

              "PS"=>"Palestinian Territory, Occupied",

              "PA"=>"Panama",

              "PG"=>"Papua New Guinea",

              "PY"=>"Paraguay",

              "PE"=>"Peru",

              "PH"=>"Philippines",

              "PN"=>"Pitcairn",

              "PL"=>"Poland",

              "PT"=>"Portugal",

              "PR"=>"Puerto Rico",

              "QA"=>"Qatar",

              "RE"=>"Reunion",

              "RO"=>"Romania",

              "RU"=>"Russian Federation",

              "RW"=>"Rwanda",

              "BL"=>"Saint Barthelemy",

              "SH"=>"Saint Helena, Ascension and Tristan Da Cunha",

              "KN"=>"Saint Kitts and Nevis",

              "LC"=>"Saint Lucia",

              "MF"=>"Saint Martin (French part)",

              "PM"=>"Saint Pierre and Miquelon",

              "VC"=>"Saint Vincent and the Grenadines",

              "WS"=>"Samoa",

              "SM"=>"San Marino",

              "ST"=>"Sao Tome and Principe",

              "SA"=>"Saudi Arabia",

              "SN"=>"Senegal",

              "RS"=>"Serbia",

              "SC"=>"Seychelles",

              "SL"=>"Sierra Leone",

              "SG"=>"Singapore",

              "SX"=>"Sint Maarten (Dutch part)",

              "SK"=>"Slovakia",

              "SI"=>"Slovenia",

              "SB"=>"Solomon Islands",

              "SO"=>"Somalia",

              "ZA"=>"South Africa",

              "GS"=>"South Georgia and the South Sandwich Islands",

              "SS"=>"South Sudan",

              "ES"=>"Spain",

              "LK"=>"Sri Lanka",

              "SD"=>"Sudan",

              "SR"=>"Suriname",

              "SJ"=>"Svalbard and Jan Mayen",

              "SZ"=>"Swaziland",

              "SE"=>"Sweden",

              "CH"=>"Switzerland",

              "SY"=>"Syrian Arab Republic",

              "TW"=>"Taiwan, Province of China",

              "TJ"=>"Tajikistan",

              "TZ"=>"Tanzania, United Republic of",

              "TH"=>"Thailand",

              "TL"=>"Timor-Leste",

              "TG"=>"Togo",

              "TK"=>"Tokelau",

              "TO"=>"Tonga",

              "TT"=>"Trinidad and Tobago",

              "TN"=>"Tunisia",

              "TR"=>"Turkey",

              "TM"=>"Turkmenistan",

              "TC"=>"Turks and Caicos Islands",

              "TV"=>"Tuvalu",

              "UG"=>"Uganda",

              "UA"=>"Ukraine",

              "AE"=>"United Arab Emirates",

              "GB"=>"United Kingdom",

              "UM"=>"United States Minor Outlying Islands",

              "UY"=>"Uruguay",

              "UZ"=>"Uzbekistan",

              "VU"=>"Vanuatu",

              "VE"=>"Venezuela, Bolivarian Republic of",

              "VN"=>"Viet Nam",

              "VG"=>"Virgin Islands, British",

              "VI"=>"Virgin Islands, U.S.",

              "WF"=>"Wallis and Futuna",

              "EH"=>"Western Sahara",

              "YE"=>"Yemen",

              "ZM"=>"Zambia",

              "ZW"=>"Zimbabwe"

            );

    }

  }



  /**

  * Gives Name of Country with respect to the provided country code

  */

  if ( ! function_exists('getnext')) {  
  function getnext($current = '') {
    $CI =& get_instance();
    $CI->db->order_by('id', 'asc');
    $CI->db->where('id >', $current);
    $query = $CI->db->get('properties');    
    if($query->num_rows() > 0)
      return $query->row()->slug;
    else
      return FALSE;
  }
}

if ( ! function_exists('getprev')) {  
  function getprev($current = '') {
    $CI =& get_instance();
    $CI->db->order_by('id', 'desc');
    $CI->db->where('id <', $current);
    $query = $CI->db->get('properties');    
    if($query->num_rows() > 0)
      return $query->row()->slug;
    else
      return FALSE;
  }
}


if ( ! function_exists('getallpages')) {  
  function getallpages() {
    $CI =& get_instance();        
    $query = $CI->db->get('pages');    
    if($query->num_rows() > 0)
      return $query->result();
    else
      return FALSE;
  }
}


 /**
* get twitter feed
*/
if ( ! function_exists('get_twitter_feed')) { 
  function get_twitter_feed() {
    // return FALSE;
   require_once APPPATH.'libraries/TwitterAPIExchange.php';  
    // $CI =& get_instance();
     $CI =& get_instance();
    $query = $CI->db->get('social_links');
    $username = $query->row()->twitter_username;
    // $username ='acapella360';

     $settings = array(
          'oauth_access_token' => "1587768884-0RkLHCvD981xkILNxtUPZzoxcIdGfohtcPCSMcR",
          'oauth_access_token_secret' => "v9CGBmwjZxCcGO735aeKE1oFQ8RnMYPB4eNPz6EJAVN5o",
          'consumer_key' => "CzVD7h4coC57VeCW3WjA",
          'consumer_secret' => "fmrsxJTjfvvOx6sogOslXZJNrxF6pgsLFlEXc6aY0"
         ); //twitter        

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $requestMethod = 'GET';
      
      $getfield = '?screen_name='.$username.'&count=3';
      $twitter = new TwitterAPIExchange($settings);
      $response =  $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(); //get tweet
      $tweet = json_decode($response);   
      // print_r($tweet); die();
      return $tweet;
    }    
   
    // return $CI->encrypt->decode($code);
  }

if ( ! function_exists('get_social_links')) { 
  function get_social_links() { 
    $CI =& get_instance();
    $query = $CI->db->get('social_links');
    if($query->num_rows() > 0)
      return $query->row();
    else
      return FALSE;
  }
}

if ( ! function_exists('twitter_username')) { 
  function twitter_username() { 
    $CI =& get_instance();
    $query = $CI->db->get('social_links');
    if($query->num_rows() > 0)
      return $query->row()->twitter_username;
    else
      return FALSE;
  }
}

if ( ! function_exists('get_headerimage')) { 
  function get_headerimage() { 
    $CI =& get_instance();
    $CI->db->where('id',1);
    $query = $CI->db->get('headerimages');
    if($query->num_rows() > 0)
      return $query->row();
    else
      return FALSE;
  }
}

if ( ! function_exists('get_footer_links')) { 
  function get_footer_links() { 
    $CI =& get_instance();
    $CI->db->select('slug,title');
    $query = $CI->db->get('pages');
    if($query->num_rows() > 0)
      return $query->result();
    else
      return FALSE;
  }
}

if ( ! function_exists('get_row')) { 
   function get_row($table_name='', $id_array=''){
    $CI =& get_instance();
    if(!empty($id_array)):    
      foreach ($id_array as $key => $value){
        $CI->db->where($key, $value);
      }
    endif;

    $query=$CI->db->get($table_name);
    if($query->num_rows()>0)
      return $query->row();
    else
      return FALSE;
  }
}

if ( ! function_exists('get_sections')) { 
   function get_sections()
   {
    $CI =& get_instance();
    $query=$CI->db->get('sections');
    if($query->num_rows()>0)
      return $query->result();
    else
      return FALSE;
  }
}
