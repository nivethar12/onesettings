<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
    public function __construct()
    {
    	parent::__construct();
    	$this->load->helper('exec_helper');
    }
    	
    
	public function login(){
		
//		$email = "onesettingapp@gmail.com";
//		$pass = "Test1234!";
//		$service = "tumblr";
		
		$email = $_POST["email"];
		$pass  = $_POST["password"];
		$service = $_POST["service"];
		$credId = $_POST["credId"];
		
		
		$phantomBase = "PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs /usr/local/bin/casperjs --ignore-ssl-errors=true --ssl-protocol=any";
		$loginBase = "/Applications/XAMPP/xamppfiles/htdocsonesettings/scripts/login/";
		$shellCode  = "$phantomBase $loginBase" . $service . ".js --user=$email --pass=$pass"; 
		$shellResult  = exec_timeout( $shellCode ,90);
		//$shellResult  = exec_timeout("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs /usr/local/bin/casperjs --ignore-ssl-errors=true --ssl-protocol=any /Applications/XAMPP/xamppfiles/htdocsonesettings/scripts/login/twitter.js --user=$email --pass=$pass" ,90);
		$result  = extractMsgFromShell($shellResult);
		//var_dump($result);
		
		$response =  array();
		if($result[0] == "SUCCESS"){
			$blogs = json_decode($result[1],true);
			$response["status"] = "SUCCESS";
			$response["credId"] = $credId;
			$response["service"] = $service;
		}else{
			$response["status"] = "ERROR";
			$response["credId"] = $credId;
			$response["service"] = $service;
		}
		
		
		
		/*
			$response["status"] = "SUCCESS";
			$response["credId"] = $credId;
			$response["service"] = $service;
		*/
		echo  json_encode($response);
	}

	public function changepass(){
		
		$email = "onesettingapp@gmail.com";
		$pass = "Test1234!";
		$service = "dropbox";		
		$newpass = "Test1234!!";
		
		$email = $_POST["email"];
		$pass  = $_POST["password"];
		$service = $_POST["service"];
		$credId = $_POST["credId"];
		$newpass = $_POST["newpass"];		
		
		
		$phantomBase = "PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs /usr/local/bin/casperjs --ignore-ssl-errors=true --ssl-protocol=any";
		$loginBase = "/Applications/XAMPP/xamppfiles/htdocsonesettings/scripts/changepassword/";
		$shellCode  = "$phantomBase $loginBase" . $service . ".js --user=$email --pass=$pass --newpass=$newpass"; 
		$shellResult  = exec_timeout( $shellCode ,90);
		//$shellResult  = exec_timeout("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs /usr/local/bin/casperjs --ignore-ssl-errors=true --ssl-protocol=any /Applications/XAMPP/xamppfiles/htdocsonesettings/scripts/login/twitter.js --user=$email --pass=$pass" ,90);
		$result  = extractMsgFromShell($shellResult);
		
		$response =  array();
		if($result[0] == "SUCCESS"){
			$blogs = json_decode($result[1],true);
			$response["status"] = "SUCCESS";
			$response["credId"] = $credId;
			$response["service"] = $service;
			$response["email"] = $email;
			$response["pass"] = $newpass;
			
		}else{
			$response["status"] = "ERROR";
			$response["credId"] = $credId;
			$response["service"] = $service;
			$response["email"] = $email;
			$response["pass"] = $newpass;
			
		}
		
		/*	
			$response["status"] = "SUCCESS";
			$response["credId"] = $credId;
			$response["service"] = $service;
			$response["email"] = $email;
			$response["pass"] = $newpass;
			*/
		
			echo  json_encode($response);
				
	}
	
	public function changeemail(){
		$email = "onesettingapp@gmail.com";
		$pass = "Test1234!";
		$service = "twitter";		
		$newemail = "followersfactory@gmail.com";
		
		$email = $_POST["email"];
		$pass  = $_POST["password"];
		$service = $_POST["service"];
		$credId = $_POST["credId"];
		$newemail = $_POST["newemail"];			
		
		
		
		$phantomBase = "PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs /usr/local/bin/casperjs --ignore-ssl-errors=true --ssl-protocol=any";
		$loginBase = "/Applications/XAMPP/xamppfiles/htdocsonesettings/scripts/changeemail/";
		$shellCode  = "$phantomBase $loginBase" . $service . ".js --user=$email --pass=$pass --newemail=$newemail"; 
		$shellResult  = exec_timeout( $shellCode ,90);
		//$shellResult  = exec_timeout("PHANTOMJS_EXECUTABLE=/usr/local/bin/phantomjs /usr/local/bin/casperjs --ignore-ssl-errors=true --ssl-protocol=any /Applications/XAMPP/xamppfiles/htdocsonesettings/scripts/login/twitter.js --user=$email --pass=$pass" ,90);
		$result  = extractMsgFromShell($shellResult);
		
		$response =  array();
		if($result[0] == "SUCCESS"){
			$blogs = json_decode($result[1],true);
			$response["status"] = "SUCCESS";
			$response["credId"] = $credId;
			$response["service"] = $service;
			$response["pass"] = $pass;
			$response["email"] = $newemail;
			
		}else{
			$response["status"] = "ERROR";
			$response["credId"] = $credId;
			$response["service"] = $service;
			$response["pass"] = $pass;
			$response["email"] = $newemail;
		}
		
		/*
			sleep(1);
			
			$response["status"] = "SUCCESS";
			$response["credId"] = $credId;
			$response["service"] = $service;
			$response["pass"] = $pass;
			$response["email"] = $newemail;
*/
		echo  json_encode($response);
		
	}
		
}
