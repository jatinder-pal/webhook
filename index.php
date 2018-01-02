<?php
echo "11";	
$data = '';
	$webhook = fopen('php://input' , 'rb'); 
	while(!feof($webhook)){
		$data .= fread($webhook, 4096); 
	}
	fclose($webhook);
	$data1 = json_decode($data, true);
	if($data1){
		$order_id=$data1['order_id']; 
		 
	mail('boskim.3ginfo@gmail.com','testing',$order_id,"From: webmaster@example.com" . "\r\n");	
	
	}
	 $order_id=72297906190;
	$url='https://fd618d2f010bae1b72fc359c2e9ec5e6:058e8334fcd174ffa4ebdd761bf5e752@jai-shri-ram-2.myshopify.com/admin/orders/'.$order_id.'.json'; //rss link for the twitter timeline
		$order_data = get_data($url); //dumps the content, you can manipulate as you wish to
		//print_r($order_data);
		 $arr1=json_decode($order_data, true);
		 echo "<pre>";print_r($arr1['order']['gateway']);echo "</pre>";
		 echo $arr1['order']['gateway'][0];
		/* gets the data from a URL */
                echo "hello";
		function get_data($url)
		{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
		}
echo "hello";


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.paypal.com/v1/oauth2/token",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "grant_type=client_credentials",
		  CURLOPT_HTTPHEADER => array(
			"Authorization: Basic QWU4czlHQi1BR21MUVI1OGlvYmVPVEJHd0Q0aW0wNnh4MW1hSFhWNmxCamY5cDk1ZFFUa3F0T3VoZjF4V1Y1S3FmUXdaaUlpeno1NmRrOEQ6RUJzZlJFbjFIYjhxZVotVTFkaE1iRmN1YXdqd1RRUGE3OEhPMHJGWUZCVjFobmx6a2NGbkpTMWVyRlYzMzZUQ1RIZFVVOWx3RmdmaDNNWFY=",
			"Cache-Control: no-cache",
			"Content-Type: application/x-www-form-urlencoded",
			"Postman-Token: e9f24fa5-35a4-0325-7893-15ab8708ef66"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  //echo $response;
		  echo $response['access_token'];
		}
/* 	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paypal.com/v1/shipping/trackers/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\"trackers\": [\n{\n\"transaction_id\": \"39X24218SL5770941\",\n\"tracking_number\": \"XYZ123456\",\n\"status\": \"SHIPPED\",\n\"carrier\": \"SG_SG_POST\"\n}\n]\n}",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer A21AAEQANA1o5GRhlkMh3IYyoRETfxHYoidhUivlXcL9ctEPVUAnl1IuM-YH6nqDGDR5DkxripUZYGo4DjO52tJ8zbX84z7QQ",
    "Cache-Control: no-cache",
    "Content-Type: application/json",
    "Postman-Token: 4324ca06-c982-f4c6-6f7c-ff3a14c7fb10"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
} */
	?>
