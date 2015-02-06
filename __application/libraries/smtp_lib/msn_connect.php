<?php


class Msn_connect {



	  function get_user_info($required_code=""){
	  	

	    $client_id = '000000004011521E';
		$client_secret = 'ZscsT5nta49PCCO99T2g3-ENrARTzGT2';
	    $redirect_uri = 'http://clients.cloudnemo.com/vacalio/demo/my_test/msn';
		$auth_code = $required_code;
		$fields=array(
		'code'=>  urlencode($auth_code),
		'client_id'=>  urlencode($client_id),
		'client_secret'=>  urlencode($client_secret),
		'redirect_uri'=>  urlencode($redirect_uri),
		'grant_type'=>  urlencode('authorization_code')
		);


		$post = '';
		foreach($fields as $key=>$value)
		 { $post .= $key.'='.$value.'&'; }
		$post = rtrim($post,'&');
		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
		curl_setopt($curl,CURLOPT_POST,5);
		curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
		$result = curl_exec($curl);
		curl_close($curl);
		$response =  json_decode($result);
		$accesstoken = $response->access_token;
		//$accesstoken = $_SESSION['accesstoken'] ;//= $_GET['access_token'];
		$url = 'https://apis.live.net/v5.0/me?access_token='.$accesstoken.'&limit=2';
	   	$xmlresponse = $this->curl_file_get_contents($url);
		$xml = json_decode($xmlresponse, true);
        return $xml;
   }

	function curl_file_get_contents($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;

	}

} 


 ?>