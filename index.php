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
			$curl = curl_init("https://api.sandbox.paypal.com/v1/shipping/trackers");
			$data = array(
			  "transaction_id"=>"123456789",
			  "tracking_number"=>"XYZ123456",
				"status"=>"SHIPPED",
				"shipment_date"=>"2015-05-31",
				"carrier"=>"SG_SG_POST"
			  );
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Bearer 'access_token$sandbox$mh5ztgxz3p9pjk8d$77b48e220fdb04a171060b98f2525887'"));
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

			// Make the REST call, returning the result
			$response = curl_exec($curl);
			print_r($response );
			if (!$response) {
				die("Connection Failure.n");
			}
	?>
