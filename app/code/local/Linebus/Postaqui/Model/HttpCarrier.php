<?php

class HttpCarrier{
	private $url;
	private $auth;

	public $express;
	public $conventional;
	public $others, $data = array();

	public function __construct($url, $auth){
		$this->url = $url;
		$this->auth = $auth;
	}

	public function post($data){
		$curl = curl_init($this->url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Content-Type: application/json',
		    'Authorization: '.($this->auth))
			);

	    $response = json_decode(curl_exec($curl));
	    curl_close($curl);

	    return $response;
	}

	public function stripCarrierServices($dataApi){
		if(count($dataApi)){
            foreach($dataApi as $service){
                $this->data[] = $service;
            }
		}
	}
} 
