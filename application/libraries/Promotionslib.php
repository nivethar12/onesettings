<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Promotionslib{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('oauth');
        $this->CI->load->helper('string');
        
		$this->CI->load->model('usermodel');
        $this->CI->load->model('promotionsmodel');
    }

    private function getDateDiffFromNow($oldDateStr){
		$dateOld = new DateTime($oldDateStr);
		$date = new DateTime();
		$diff=date_diff($dateOld,$date);
		return ($diff->s * 1) + ($diff->i * 60) + ($diff->h * 60 * 60) + ($diff->d * 60 * 60 * 24) + ($diff->m  * 60 * 60 * 24 * 30);     
    }
    
	function getRecentPromotions($tumblrDomain){
		$creditsData = $this->CI->creditsmodel->getCredits($tumblrDomain);
		return $this->calculateCredits($creditsData[0]->credits,$creditsData[0]->last_updated);
	}  

	
	function promoteBlog($tumblrDomain){
		$this->CI->promotionsmodel->deletePromotion($tumblrDomain);
    	$newPromotions = array(
            		'tumblr_domain' => $tumblrDomain,
   					'posted_on'  => date('Y-m-d H:i:s',time()), 
    	);
    	$this->CI->promotionsmodel->insertPromotion($newPromotions);     	
	}
	
	function getLastPromotedTime($tumblrDomain){
		$promo = $this->CI->promotionsmodel->getLatestPromotion($tumblrDomain);
		if(sizeof($promo) > 0){
			$secDiff = $this->getDateDiffFromNow($promo[0]->posted_on);
			if($secDiff > 600){
				return 601;
			}else{
				return $secDiff;
			}
		}else{
			return 601;
		}
	}
	
}