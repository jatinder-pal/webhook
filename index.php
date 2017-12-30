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
	echo $order_id=72297906190;
	$url='https://fd618d2f010bae1b72fc359c2e9ec5e6:058e8334fcd174ffa4ebdd761bf5e752@jai-shri-ram-2.myshopify.com/admin/orders/'.$order_id.'.json'; //rss link for the twitter timeline
		$order_data = get_data($url); //dumps the content, you can manipulate as you wish to
		//print_r($order_data);
		 $arr1=json_decode($order_data, true);
		 echo "<pre>";print_r($arr1['order']['gateway']);echo "</pre>";
		 echo $arr1['order']['gateway'][0];
		/* gets the data from a URL */
 
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
			$data = {
				"trackers": [
				{
				"transaction_id": "123456789",
				"tracking_number": "XYZ123456",
				"status": "SHIPPED",
				"shipment_date": "2015-05-31",
				"carrier": "SG_SG_POST"
				}
				]
			};
			$ch = curl_init("https://api.sandbox.paypal.com/v1/shipping/trackers/123456789-XYZ123456");
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
				curl_close($ch); // close curl session
			print_r(json_decode($response, true));
	?>
