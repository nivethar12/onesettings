<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Creditslib{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('oauth');
        $this->CI->load->helper('string');
        
		$this->CI->load->model('usermodel');
        $this->CI->load->model('creditsmodel');
    }

    private function getDateDiffFromNow($oldDateStr){
		$dateOld = new DateTime($oldDateStr);
		$date = new DateTime();
		$diff=date_diff($dateOld,$date);
		return ($diff->s * 1) + ($diff->i * 60) + ($diff->h * 60 * 60) + ($diff->d * 60 * 60 * 24) + ($diff->m  * 60 * 60 * 24 * 30);     
    }
    
    private function calculateCredits($credits,$lastUpdated){
    	$seconds = $this->getDateDiffFromNow($lastUpdated);
    	if($seconds == 0){
    		return $credits;
    	}
    	$creditsDecay  = floor($seconds / 900);
    	if($creditsDecay >= $credits){
    		return 0;
    	}else{
    		return $credits - $creditsDecay;
    	}
    } 
    
    private function creditTime($lastUpdated){
    	$seconds = $this->getDateDiffFromNow($lastUpdated);
        if($seconds == 0){
    		return 0;
    	}
    	return $seconds % 900;
    }
    
	function getCreditsFull($accountId){
		$result = array();
		$creditsData = $this->CI->creditsmodel->getCredits($accountId);
		if($creditsData){
			$result["credit"] = $this->calculateCredits($creditsData[0]->credits,$creditsData[0]->last_updated);
			if($result["credit"] == 0){
				$result["timebalance"] = 900;
			}else{
				$result["timebalance"] = $this->creditTime($creditsData[0]->last_updated);
			}
			return $result;
		}else{
			return false;
		}
	}  
    
	function getCredits($accountId){
		$creditsData = $this->CI->creditsmodel->getCredits($accountId);
		if($creditsData){
			return $this->calculateCredits($creditsData[0]->credits,$creditsData[0]->last_updated);
		}else{
			return 0;
		}
	}  
	
	function earnCredits($accountId,$tumblrDomain,$deltaCredit,$addToStats){
		$finalCredits = $deltaCredit;
		$creditsData = $this->CI->creditsmodel->getCredits($accountId);
		if($creditsData){
			$currentCredits = $this->calculateCredits($creditsData[0]->credits,$creditsData[0]->last_updated);
			$finalCredits =  $currentCredits + $deltaCredit;
			$today = 0;
			$week = 0;
			if(is_numeric($creditsData[0]->today)){
				$today =  $creditsData[0]->today;
			}

			if(is_numeric($creditsData[0]->week)){
				$week =  $creditsData[0]->week;
			}
			$updateCredits = array(
   				'credits' => $finalCredits,
   				'last_updated'  => date('Y-m-d H:i:s',time()) 
    		);
    		if($addToStats){
    			$updateCredits['today'] =  $today + $deltaCredit;
    			$updateCredits['week'] =  $week + $deltaCredit;
    		}
    		$this->CI->creditsmodel->updateCredits($accountId,$updateCredits);			
		}else{
		    $newCredits = array(
		    		'account_id' => $accountId,
            		'tumblr_domain' => $tumblrDomain,
   					'credits' => $deltaCredit,  
   					'last_updated'  => date('Y-m-d H:i:s',time()), 
    		);
		    if($addToStats){
    			$updateCredits['today'] =  $deltaCredit;
    			$updateCredits['week'] =  $deltaCredit;
    		}    		
    		$this->CI->creditsmodel->insertCredits($newCredits);  	
		}
    	return $finalCredits;	
	}
	
	function spendCredits($accountId,$deltaCredit,$addToStats){
		$finalCredits = $deltaCredit;
		$creditsData = $this->CI->creditsmodel->getCredits($accountId);
		if($creditsData){
			$currentCredits = $this->calculateCredits($creditsData[0]->credits,$creditsData[0]->last_updated);
			$finalCredits =  $currentCredits - $deltaCredit;
			$today = 0;
			$week = 0;
			if(is_numeric($creditsData[0]->today)){
				$today =  $creditsData[0]->today;
			}

			if(is_numeric($creditsData[0]->week)){
				$week =  $creditsData[0]->week;
			}
			$updateCredits = array(
   				'credits' => $finalCredits,
   				'last_updated'  => date('Y-m-d H:i:s',time()) 
    		);
    		if($addToStats){
    			$updateCredits['today'] =  $today - $deltaCredit;
    			$updateCredits['week'] =  $week - $deltaCredit;
    		}
    		$this->CI->creditsmodel->updateCredits($accountId,$updateCredits);			
		}		
	}
	
	
	
}