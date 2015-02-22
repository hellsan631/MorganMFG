<?php

$classes = array(
	'f' => '.team-list .half-block .inner h1 a',
	's' => '.team-list .half-block .inner p',
	't' => '.cateringhead h3',
	'fo' => '.cateringhead p',
	'fi' => FALSE
);

if($f){
	echo "@import url(http://fonts.googleapis.com/css?family=".$f->css_name.");\n";
	if($classes['f']){
		echo $classes['f']." {\n\t".str_replace(';', '', $f->font_family)." !important;\n}\n\n";
	}
}

if($s){
	echo "@import url(http://fonts.googleapis.com/css?family=".$s->css_name.");\n";
	if($classes['s']){
		echo $classes['s']." {\n\t".str_replace(';', '', $s->font_family)." !important;\n}\n\n";
	}
}

if($t){
	echo "@import url(http://fonts.googleapis.com/css?family=".$t->css_name.");\n";
	if($classes['t']){
		echo $classes['t']." {\n\t".str_replace(';', '', $t->font_family)." !important;\n}\n\n";
	}
}

if($fo){
	echo "@import url(http://fonts.googleapis.com/css?family=".$fo->css_name.");\n";
	if($classes['fo']){
		echo $classes['fo']." {\n\t".str_replace(';', '', $fo->font_family)." !important;\n}\n\n";
	}
}

if($fi){
	echo "@import url(http://fonts.googleapis.com/css?family=".$fi->css_name.");\n";
	if($classes['fi']){
		echo $classes['fi']." {\n\t".str_replace(';', '', $fi->font_family)." !important;\n}\n\n";
	}
}

if($classes['f']){
	$class = $classes['f'];
	$class_style = '';
	$class_style .= $class." {";

	if($f_w_size != '')
		$class_style .= "\n\tfont-size:".$f_w_size." !important;";

	if($f_color != '')
		$class_style .= "\n\tcolor:#".$f_color." !important;";

	if($f_weight != '')
		$class_style .= "\n\tfont-weight:".$f_weight." !important;";

	if($f_line_height != '')
		$class_style .= "\n\tline-height:".$f_line_height." !important;";

	if($f_word_spacing != '')
		$class_style .= "\n\tword-spacing:".$f_word_spacing." !important;";

	if($f_letter_spacing != '')
		$class_style .= "\n\tletter-spacing:".$f_letter_spacing." !important;";

	$class_style .= "\n}\n\n";

	if($f_m_size != ''){
		$class_style .= "@media(min-width:320px) and (max-width:480px){\n";
		$class_style .= $class."{\n\tfont-size:".$f_m_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	if($f_t_size != ''){
		$class_style .= "@media(min-device-width:768px) and (max-device-width:1024px){\n";
		$class_style .= $class."{\n\tfont-size:".$f_t_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	echo $class_style;
}

if($classes['s']){
	$class = $classes['s'];
	$class_style = '';
	$class_style .= $class." {";

	if($s_w_size != '')
		$class_style .= "\n\tfont-size:".$s_w_size." !important;";

	if($s_color != '')
		$class_style .= "\n\tcolor:#".$s_color." !important;";

	if($s_weight != '')
		$class_style .= "\n\tfont-weight:".$s_weight." !important;";

	if($s_line_height != '')
		$class_style .= "\n\tline-height:".$s_line_height." !important;";

	if($s_word_spacing != '')
		$class_style .= "\n\tword-spacing:".$s_word_spacing." !important;";

	if($s_letter_spacing != '')
		$class_style .= "\n\tletter-spacing:".$s_letter_spacing." !important;";

	$class_style .= "\n}\n\n";

	if($s_m_size != ''){
		$class_style .= "@media(min-width:320px) and (max-width:480px){\n";
		$class_style .= $class."{\n\tfont-size:".$s_m_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	if($s_t_size != ''){
		$class_style .= "@media(min-device-width:768px) and (max-device-width:1024px){\n";
		$class_style .= $class."{\n\tfont-size:".$s_t_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	echo $class_style;
}

if($classes['t']){
	$class = $classes['t'];
	$class_style = '';
	$class_style .= $class." {";

	if($t_w_size != '')
		$class_style .= "\n\tfont-size:".$t_w_size." !important;";

	if($t_color != '')
		$class_style .= "\n\tcolor:#".$t_color." !important;";

	if($t_weight != '')
		$class_style .= "\n\tfont-weight:".$t_weight." !important;";

	if($t_line_height != '')
		$class_style .= "\n\tline-height:".$t_line_height." !important;";

	if($t_word_spacing != '')
		$class_style .= "\n\tword-spacing:".$t_word_spacing." !important;";

	if($t_letter_spacing != '')
		$class_style .= "\n\tletter-spacing:".$t_letter_spacing." !important;";

	$class_style .= "\n}\n\n";

	if($t_m_size != ''){
		$class_style .= "@media(min-width:320px) and (max-width:480px){\n";
		$class_style .= $class."{\n\tfont-size:".$t_m_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	if($t_t_size != ''){
		$class_style .= "@media(min-device-width:768px) and (max-device-width:1024px){\n";
		$class_style .= $class."{\n\tfont-size:".$t_t_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	echo $class_style;
}

if($classes['fo']){
	$class = $classes['fo'];
	$class_style = '';
	$class_style .= $class." {";

	if($fo_w_size != '')
		$class_style .= "\n\tfont-size:".$fo_w_size." !important;";

	if($fo_color != '')
		$class_style .= "\n\tcolor:#".$fo_color." !important;";

	if($fo_weight != '')
		$class_style .= "\n\tfont-weight:".$fo_weight." !important;";

	if($fo_line_height != '')
		$class_style .= "\n\tline-height:".$fo_line_height." !important;";

	if($fo_word_spacing != '')
		$class_style .= "\n\tword-spacing:".$fo_word_spacing." !important;";

	if($fo_letter_spacing != '')
		$class_style .= "\n\tletter-spacing:".$fo_letter_spacing." !important;";

	$class_style .= "\n}\n\n";

	if($fo_m_size != ''){
		$class_style .= "@media(min-width:320px) and (max-width:480px){\n";
		$class_style .= $class."{\n\tfont-size:".$fo_m_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	if($fo_t_size != ''){
		$class_style .= "@media(min-device-width:768px) and (max-device-width:1024px){\n";
		$class_style .= $class."{\n\tfont-size:".$fo_t_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	echo $class_style;
}

if($classes['fi']){
	$class = $classes['fi'];
	$class_style = '';
	$class_style .= $class." {";

	if($fi_w_size != '')
		$class_style .= "\n\tfont-size:".$fi_w_size." !important;";

	if($fi_color != '')
		$class_style .= "\n\tcolor:#".$fi_color." !important;";

	if($fi_weight != '')
		$class_style .= "\n\tfont-weight:".$fi_weight." !important;";

	if($fi_line_height != '')
		$class_style .= "\n\tline-height:".$fi_line_height." !important;";

	if($fi_word_spacing != '')
		$class_style .= "\n\tword-spacing:".$fi_word_spacing." !important;";

	if($fi_letter_spacing != '')
		$class_style .= "\n\tletter-spacing:".$fi_letter_spacing." !important;";

	$class_style .= "\n}\n\n";

	if($fi_m_size != ''){
		$class_style .= "@media(min-width:320px) and (max-width:480px){\n";
		$class_style .= $class."{\n\tfont-size:".$fi_m_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	if($fi_t_size != ''){
		$class_style .= "@media(min-device-width:768px) and (max-device-width:1024px){\n";
		$class_style .= $class."{\n\tfont-size:".$fi_t_size." !important;\n}";
		$class_style .= "}\n\n";
	}

	echo $class_style;
}