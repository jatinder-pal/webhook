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
			 $data['trackers'] = array(
				"transaction_id"=>"65D90556FJ0877605",
				"tracking_number"=>"XYZ123456",
				"status"=>"SHIPPED",
				"shipment_date"=>"2018-01-23",
				"carrier"=>"FEDEX"
				);
				$arr1=json_encode($data);
				print_r($arr1);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Bearer A21AAGUrw_7kYCADI9vzOwWY9jPNJPNL_XoSxleKUNoktdC8OzSlUFTtm4ewSTHV3GLlZ2nA7mcwfESn4whbfj7pQGkxf2sUQ"));
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arr1));

			// Make the REST call, returning the result
			$response = curl_exec($curl);
			print_r($response );
			if (!$response) {
				die("Connection Failure.n");
			}
	?>
