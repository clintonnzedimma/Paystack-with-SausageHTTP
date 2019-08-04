<?php 
include 'lib/SausageHTTP.php';

$client = new SausageHTTP(); //Creating a Sausage Client


if(!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])){  
  die("Transaction reference not found");
} else {

	// Setting reference.
	$reference = $_POST['reference']; 

	//Setting Sausage Request parameter
	$client->setRequest([
			"URL" =>'https://api.paystack.co/transaction/verify/'.$reference, 
			"METHOD" => 'POST',
			"HEADER" => array(
							'Content-Type: application/json', 
						 	'Authorization: Bearer *Your Paystack Private Key*'
						) 
	]);


	//Checking Sausage response and decoding it from JSON format to associative array
	if ($client->response) {
	  $result = json_decode($client->response, true);
	}


	//Checking if transaction is a success
	if (array_key_exists('data', $result)
	 	&& array_key_exists('status', $result['data']) 
	 	&& ($result['data']['status'] === 'success')) {
	 		 echo "success";
	 		 // Perform your necessary action here.

	}else{
	  echo "failed";
	}

}
 ?>