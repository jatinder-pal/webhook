<?php
$data = '';
	$webhook = fopen('php://input' , 'rb'); 
	while(!feof($webhook)){
		$data .= fread($webhook, 4096); 
	}
	fclose($webhook);
	$data1 = json_decode($data, true);
	//if($data1){
		//$order_id=$data1['order_id'];
		$order_id=72297906190;
		$url='https://fd618d2f010bae1b72fc359c2e9ec5e6:058e8334fcd174ffa4ebdd761bf5e752@jai-shri-ram-2.myshopify.com/admin/orders/'.$order_id.'.json';
		$order_data = get_data($url);
		 $order_data=json_decode($order_data, true);
		 echo "<pre>";print_r($order_data);echo "</pre>";
		 $gateway=$data1['gateway']; 
		echo $fulfillment_status = $order_data['order']['fulfillment_status']; 
		echo $tracking_number=$order_data['order']['fulfillments'][0]['tracking_number']; 
		echo $tracking_company='FEDEX'; 
		if($fulfillment_status == 'fulfilled'){
			$fulfillment_status = 'DELIVERED';
		}
		 echo $order_data['order']['gateway'];
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
		//$ch = curl_init("https://48889f0c2488fe101c19b98c2b12ad36:0b69dd28a3c9d7753bef022b939566e3@unmatched-market.myshopify.com/admin/orders/".$order_id.".json");
		$ch = curl_init("https://fd618d2f010bae1b72fc359c2e9ec5e6:058e8334fcd174ffa4ebdd761bf5e752@jai-shri-ram-2.myshopify.com/admin/orders/".$order_id.".json");
	
		$order = array(
			"order" => array(
					"note_attributes" => 
						array(
						"name"=>"gateway2",
						"value"=> $gateway.'ful='.$fulfillment_status.'tracking='.$tracking_company.'tracking company='.$tracking_number
						)
					)
		);
		print_r($order);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order)); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch); // close curl session
		//print_r(json_decode($response, true));
		$arr1=json_decode($response, true);
		print_r($arr1);
		$arr2=$arr1['order'];
		if(count($response)>0){
			echo'SUCCESS';
		} else{
			echo 'ERROR';
	}
		 //if($gateway == 'paypal'){
			/* $url='https://48889f0c2488fe101c19b98c2b12ad36:0b69dd28a3c9d7753bef022b939566e3@unmatched-market.myshopify.com/admin/orders/'.$order_id.'/transactions.json';
			$order_data = get_data($url); 
			 $arr1=json_decode($order_data, true);
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
			} */
			$transaction_id='99L299517J726494B';
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
					  CURLOPT_POSTFIELDS => "{\n\"trackers\": [\n{\n\"transaction_id\": \"$transaction_id\",\n\"tracking_number\": \"$tracking_number\",\n\"status\": \"$fulfillment_status\",\n\"carrier\": \"$tracking_company\"\n}\n]\n}",
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
			
				 
			// }
				//mail('boskim.3ginfo@gmail.com','testing',$order_id,"From: webmaster@example.com" . "\r\n");	
		
		//}
	  
		
	?>
