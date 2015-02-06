<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Google_fonts {

  public function update_db(){
    // return TRUE;
    $CI =& get_instance();
    $CI->load->model('admin_model');
    $fontsSeraliazed = file_get_contents('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyDa2PQDyh08gjQ5E6JUdFsuIkGUBHDDtHw');
    $fontArray = json_decode($fontsSeraliazed);
    foreach ($fontArray->items as $row) {
      $css_name = str_replace(' ', '+', $row->family);
      $font_family = "font-family: '".$row->family."';";
      $font_name = $row->family;

      $font = array(
        'css_name' => $css_name,
        'font_family' => $font_family,
        'font_name' => $font_name,
      );

      $exist = $CI->admin_model->get_row('google_fonts', array('css_name'=>$css_name));
      if(!$exist){
        $id = $CI->admin_model->insert('google_fonts', $font);
        foreach ($row->variants as $key => $value) {
          $var['font_id'] = $id;
          $var['variant_name'] = $value;                  
          $CI->admin_model->insert('font_variants', $var);
        }        
      }
      
    }    
  }
}