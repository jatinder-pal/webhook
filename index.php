<?php
$data12 = '12';
	$webhook = fopen('php://input' , 'rb'); 
	while(!feof($webhook)){
		$data .= fread($webhook, 4096); 
	}
	fclose($webhook);
	$data1 = json_decode($data, true);
	if($data12 == '12'){
		$order_id=$data1['order_id'];
		echo $order_id=243687817245;
		echo $url='https://48889f0c2488fe101c19b98c2b12ad36:0b69dd28a3c9d7753bef022b939566e3@unmatched-market.myshopify.com/admin/orders/'.$order_id.'.json';
		
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		$order_data1 = $data;
		$order_data=json_decode($order_data1, true);
		echo "<pre>";print_r($order_data);echo "</pre>";
		echo $fulfillment_status = $order_data['order']['fulfillment_status']; 
		echo $tracking_number=$order_data['order']['fulfillments'][0]['tracking_number']; 
		echo $tracking_url=$order_data['order']['fulfillments'][0]['tracking_url']; 
		echo $tracking_company='OTHER'; 
		if($fulfillment_status == 'fulfilled'){
			$fulfillment_status = 'DELIVERED';
		}
		 echo $gateway=$order_data['order']['gateway'];
		
		/* add order note */
		/* $ch = curl_init("https://48889f0c2488fe101c19b98c2b12ad36:0b69dd28a3c9d7753bef022b939566e3@unmatched-market.myshopify.com/admin/orders/".$order_id.".json");
		//$ch = curl_init("https://fd618d2f010bae1b72fc359c2e9ec5e6:058e8334fcd174ffa4ebdd761bf5e752@jai-shri-ram-2.myshopify.com/admin/orders/".$order_id.".json");
		$order = array("order" => array("note_attributes" =>array("name"=>"gateway2","value"=>$gateway.'ful='.$fulfillment_status.'tracking='.$tracking_company.'tracking company='.$tracking_number)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order)); 
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch); 
		$arr1=json_decode($response, true);
		print_r($arr1);
		$arr2=$arr1['order'];
		if(count($response)>0){
			echo'SUCCESS';
		} else{
			echo 'ERROR';
		}
		*/
		/* add order note */ 
		
		 if($gateway == 'paypal'){
			 $url='https://48889f0c2488fe101c19b98c2b12ad36:0b69dd28a3c9d7753bef022b939566e3@unmatched-market.myshopify.com/admin/orders/'.$order_id.'/transactions.json';
			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
			$data = curl_exec($ch);
			curl_close($ch);
			$order_data = $data;
			 $arr1=json_decode($order_data, true);
			 print_r($arr1['transactions'][0]['gateway']);echo "</pre>";
			 echo $transaction_id=$arr1['transactions'][0]['receipt']['transaction_id'];
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
							$tracking_data= {
							"trackers": [
							{
							"transaction_id": "$transaction_id",
							"tracking_number": "$tracking_number",
							"status": "SHIPPED",
							"carrier":"OTHER",
							"carrier_name_other":"$tracking_url"
							}
							]
							};
							$tracking_data = json_encode($tracking_data);
							print_r($tracking_data);
					curl_setopt_array($curl, array(
					  CURLOPT_URL => "https://api.paypal.com/v1/shipping/trackers/",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					   CURLOPT_POSTFIELDS => $tracking_data,
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
				//mail('boskim.3ginfo@gmail.com','testing',$order_id,"From: webmaster@example.com" . "\r\n");	
		
	}
	  
		
	?>
