<?php
        $fields_string  =   "";
        $fields     =   array(
                            'api_key'       =>  '701c1b2d',
                            'api_secret'    =>  'IcXt6xLU9lq7U2Mi',
                            'to'            =>  '628119298089',
                            'from'          =>  "NEXMO",
                            'text'          =>  "asds"
        );
        $url        =   "https://rest.nexmo.com/sms/json";

        //url-ify the data for the POST
	foreach($fields as $key=>$value) { 
            $fields_string .= $key.'='.$value.'&'; 
            }
	rtrim($fields_string, '&');

		//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

	//execute post
	$result = curl_exec($ch);
	//close connection
	curl_close($ch);

        echo "<pre>";
        print_r($result); 
        echo "</pre>";
?>