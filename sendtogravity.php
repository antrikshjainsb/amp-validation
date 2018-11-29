<?php
require('wp-config.php');
echo '<pre>';
//print_r($_GET);
echo '</pre>';
if(isset($_POST['firstname']))
{
	//API for gravity form
	$api_key = '9a8af9cdab';
	$private_key = '04df3bc1d5d32cf';
	 
	//set route
	$route = 'forms/1/entries';

	function calculate_signature( $string, $private_key ) {
		$hash = hash_hmac( 'sha1', $string, $private_key, true );
		$sig = rawurlencode( base64_encode( $hash ) );
		return $sig;
	}

	//creating request URL
	$expires = strtotime( '+60 mins' );
	$string_to_sign = sprintf( '%s:%s:%s:%s', $api_key, 'POST', $route, $expires );
	$sig = calculate_signature( $string_to_sign, $private_key );
	$url = get_site_url() . '/gravityformsapi/' . $route . '?api_key=' . $api_key . '&signature=' . $sig . '&expires=' . $expires;

	$entries = array(
		array(
			'date_created' => date('Y-m-d H:i:s'),
			'is_starred'   => 0,
			'is_read'      => 0,
			'ip'           => '::1',
			'source_url'   => $_POST['URL'],
			'currency'     => 'USD',
			'created_by'   => 1,
			'user_agent'   => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0',
			'status'       => 'active',
			'1'            => $_POST['firstname'],
			'2'            => $_POST['lastname'],
			'3'            => $_POST['email'],
			'4'            => $_POST['phone'],
			'5'            => $_POST['project'],
			'6'            => $_POST['source'],
			'7'            => $_POST['visit'],
			'11'            => $_POST['UserMessage'],
		)
	);
	 
	//json encode array
	$entry_json = json_encode( $entries );
	 
	//retrieve data
	$response = wp_remote_request( $url , array( 'method' => 'POST', 'body' => $entry_json, 'timeout' => 25 ) );
	if ( wp_remote_retrieve_response_code( $response ) != 200 || ( empty( wp_remote_retrieve_body( $response ) ) ) ){
		//http request failed
		die( 'There was an error attempting to access the API.' );
	}
	 
	//result is in the response "body" and is json encoded.
	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	 
	if( $body['status'] > 202 ){
		$error = $body['response'];
	 
			//entry update failed, get error information, error could just be a string
		if ( is_array( $error )){
			$error_code     = $error['code'];
			$error_message  = $error['message'];
			$error_data     = isset( $error['data'] ) ? $error['data'] : '';
			$status     = "Code: {$error_code}. Message: {$error_message}. Data: {$error_data}.";
		}
		else{
			$status = $error;
		}
		die( "Could not post entries. {$status}" );
	}
	else
	{
		header('Location: http://wwww.localhost/sitewalkin/thankyou');
	}
}