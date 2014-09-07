<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
require_once('libs/tumblrapi/tumblroauth.php');


class Tumblrlib{
	var $tum_oauth;
	var $consumer_key = "DtF5zZZHqdqQccQMub0akNN7T0LiFDywTdtn7Q72bsEHVUBOUi";
	var $consumer_secret = "r83QWW0K1157sRZubTLTRBbZZ8pne612wWGoqwSbiag19f1Jx6";

	//var $consumer_key = "0iVrHuCQ68aKzXLL2FhQ71NkaIqCT3B3jtsF0LKLkINYbkDa5B";
	//var $consumer_secret = "adt5O8cdQ9Y6tehNqmZOXf1izDwbFP62MmpZ84RqZa7EZLbN7J";
	
	
    public function __construct()
    {
        $this->CI =& get_instance();
       	$this->tum_oauth = new TumblrOAuth($this->consumer_key, $this->consumer_secret);
    }

    function getRequestToken(){
    	$token = "";
    	$request_token = $this->tum_oauth->getRequestToken();
    	$resArray =  array();
    	$resArray['request_token'] = $token = $request_token['oauth_token'];
		$resArray['request_token_secret'] = $request_token['oauth_token_secret'];
    	switch ($this->tum_oauth->http_code) {
  			case 200:
		    	$url = $this->tum_oauth->getAuthorizeURL($token);
    			$resArray['redirect_url'] = $url;
		    	break;
			default:	
    			echo 'Could not connect to Tumblr. Refresh the page or try again later.';
		}
		return $resArray;
    }
    
    function setRequestToken($oauthToken = NULL, $oauthTokenSecret = NULL){
		$this->tum_oauth->setRequestToken($oauthToken,$oauthTokenSecret);
    }
    
    function getAccessToken($oauthVerifier){
       $access_token = $this->tum_oauth->getAccessToken($oauthVerifier);
 	   if (200 == $this->tum_oauth->http_code) {
  	 		return $access_token; 
		} else {
  			return false;
		}
    }
    
    function get($target){
    	return $this->tum_oauth->get($target);
    }

    function post($url,$parem){
    	$data = $this->tum_oauth->post($url,$parem);
    	if (200 == $this->tum_oauth->http_code) {
    		return true;
    	} else {
    		return false;
    	}
    }
}