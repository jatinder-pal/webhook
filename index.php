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
		$gateway=$data1['gateway']; 
		$fulfillment_status=$data1['fulfillment_status']; 
		$fulfillment_status=$data1['fulfillment_status']; 
		$tracking_number=$data1['fulfillments'][0]['tracking_number']; 
		$tracking_company=$data1['fulfillments'][0]['tracking_company']; 
		if($fulfillment_status == 'fulfilled'){
			$fulfillment_status = 'DELIVERED';
		}
		 if($gateway == 'paypal'){
			 
			 
		 }
	mail('boskim.3ginfo@gmail.com','testing',$order_id,"From: webmaster@example.com" . "\r\n");	
	
	}
	 echo $order_id=236171886621;
	 $transaction_id='39X24218SL5770941';
	 $tracking_number='xyz';
	 $fulfillment_status = 'DELIVERED';
	 $tracking_company='SG_SG_POST';
	 if($tracking_company == 'other'){
		 $carrier_name_other = ' \n\"carrier_name_other\": \"test\"';
		}
	// echo $url='https://fd618d2f010bae1b72fc359c2e9ec5e6:058e8334fcd174ffa4ebdd761bf5e752@jai-shri-ram-2.myshopify.com/admin/orders/'.$order_id.'/transactions.json';
		echo $url='https://48889f0c2488fe101c19b98c2b12ad36:0b69dd28a3c9d7753bef022b939566e3@unmatched-market.myshopify.com/admin/orders/'.$order_id.'/transactions.json';
		$order_data = get_data($url); //dumps the content, you can manipulate as you wish to
		//print_r($order_data);
		 $arr1=json_decode($order_data, true);
		 echo "<pre> hello";
		 print_r($arr1);
		 print_r($arr1['transactions'][0]['gateway']);echo "</pre>";
		 echo "<pre>";print_r($arr1['transactions'][0]['receipt']['transaction_id']);echo "</pre>";
		 $transaction_id=$arr1['transactions'][0]['receipt']['transaction_id'];
		 
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
		if($arr1['transactions'][0]['gateway'] == 'paypal') {
			echo "hhh" ;
			$ch = curl_init();
			$clientId = "ASEX-M6k-YobK8_DFB3vgFZiLvmjJKzDjP6cVGjUZgRxJWVUMQwpCO55C-FfGUqmjVu1JeJ9viUNglxC";
			$secret = "EORrLsDIcmU16qpFmaJYuRL2KH78rQWtuSBqK6zJAupJ2nAjeVFy-RHqelvMLpwQbqyiPfagZBWIQScB";
			curl_setopt($ch, CURLOPT_URL, "https://api.paypal.com/v1/oauth2/token");
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_USERPWD, $clientId.":".$secret);
			curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
			$result = curl_exec($ch);
			if(empty($result))die("Error: No response.");
			else
			{
				$json = json_decode($result);
				echo $access_token =$json->access_token;
					$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.paypal.com/v1/shipping/trackers/",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "{\n\"trackers\": [\n{\n\"transaction_id\": \"$transaction_id\",\n\"tracking_number\": \"$tracking_number\",\n\"status\": \"$fulfillment_status\",\n\"carrier\": \"$tracking_company\"\n,$carrier_name_other}\n]\n}",
				  CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer $access_token",
					"Cache-Control: no-cache",
					"Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  echo $response;
				} 
			}

			curl_close($ch);
		}
	?>
