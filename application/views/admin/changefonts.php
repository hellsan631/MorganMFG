<?php

 if($fonturl != ""){
 	$urls = explode('||', $fonturl);
 	foreach ($urls as $row => $value) {
 		echo str_replace(";", "", $value)."; ";	
 	} 	
 }


 if($bodyfont != ""){ 	 	
 		$font = str_replace(";", "", $paragraphs);	 	
 		echo 'body{ font-family:'.$font.' !important; } ';
 }

 if($paragraphs != ""){ 	 	
 		$font = str_replace(";", "", $paragraphs);	 	
 		echo 'p{ font-family:'.$font.' !important; } ';
 }

 if($headers != ""){ 	 	
 		$font = str_replace(";", "", $headers);	 	
 		echo 'h1, h2, h3, h4, h5, h6{ font-family:'.$font.' !important; } ';
 }

?>