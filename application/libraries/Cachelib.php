<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


require_once('libs/cache.class.php');

class Cachelib{

    public function __construct(){
        $this->CI =& get_instance();
       	$this->cache = new Cache(array(
       		'name'      => 'followersdata',
  			'path'      => '/Applications/XAMPP/xamppfiles/htdocsfollowersfactory/cache/',
  			'extension' => '.cache'
		));
    }
    
	public function store($key,$val,$expire){
		$this->cache->store($key, $val,$expire);
	}    	
	

	public function retrieve($key){
		return $this->cache->retrieve($key, false);
	}    	
}