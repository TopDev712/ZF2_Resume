<?php

namespace Application\Service;

use Application\Entity\JobAlert;
use Application\Entity\JobSeeker;
use Application\Util\HttpClient;
use Application\Util\ZipRecruiter;
use Zend\Json\Json;

class JobAlertService extends AbstractService
{


    /**
     * @param $jobSeeker JobSeeker
     * @param $term string
     * @param $location string
     * @param $radius float
     * @return bool
     */
    public function create($jobSeeker, $term, $location, $radius=25)
    {


        $url = ZipRecruiter::$JOB_ALERT;
        $httpClient = new HttpClient();
		/*  OLD code using the SEARCH API KEY, which is not valid as of 4/18/2016 for Alert API functionality
        $response = $httpClient->post($url, array(
            "search" => $term,
            "location" => $location,
            "email" => $jobSeeker->getUser()->getEmail()
        ), ZipRecruiter::$API_KEY);
		*/
      
        $subscriberId = $jobSeeker->getSubscriberId();
    	if($subscriberId!=''){
			$dateTime = new \DateTime();
			$url = ZipRecruiter::$JOB_ALERT. "/" . $subscriberId . "/searches";
			$response = $httpClient->post($url, array(
					"search" => $term,
					"location" => $location,
					"create_time" => $dateTime->format('Y-m-d H:i:s')
			), ZipRecruiter::$API_ALERT_KEY);
		} else {
			$response = $httpClient->post($url, array(
					"search" => $term,
					"location" => $location,
					"email" => $jobSeeker->getUser()->getEmail()
			), ZipRecruiter::$API_ALERT_KEY);
		}
		
        if ($response["statusCode"] >= 200 && $response["statusCode"] < 300) {
            //$responseObj = Json::decode($response["data"]);
            $jobAlert = new JobAlert();            
            
            $subscriber = json_decode($response['data']);
            if(isset($subscriber->id) && $subscriberId==''){
            	$jobSeeker->setSubscriberId($subscriber->id);
            }
            
            $jobAlert->setJobSeeker($jobSeeker);
            if($subscriberId!='' && isset($subscriber->id)){
            	$jobAlert->setSearchId($subscriber->id);
            }
            elseif(isset($subscriber->initial_search_id)){
            	$jobAlert->setSearchId($subscriber->initial_search_id);
            }
            $jobAlert->setEnabledFlag(true);
            $jobAlert->setSettingJson(Json::encode(array(
                "title" => $term,
                "location" => $location,
                "radius_miles" => $radius
            )));
            $jobAlert->setDateTimeCreated(new \DateTime());
            $this->getEntityManager()->persist($jobAlert);
            $this->getEntityManager()->flush();
            return true;
        }
        return false;
    }
    
    /**
     * Delete the alert request and remove the alert from database
     * @param unknown $jobSeeker
     * @param unknown $jobAlertId
     */
    public function delete($jobSeeker,$jobAlertId)
    {
   
    	if ($this->triggerApi($jobSeeker, $jobAlertId)) {
    		
    		$jobAlert = $this->getEntityManager ()->getRepository ( 'Application\Entity\JobAlert' )->find ( $jobAlertId );
    		$this->getEntityManager ()->createQuery ( "delete 
            from \Application\Entity\JobAlert ja
            where ja.id = :jobAlertId and ja.searchId = :jobSearchId" )
    		->setParameter ( "jobAlertId", $jobAlertId )
    		->setParameter("jobSearchId", $jobAlert->getSearchId() )->execute ();
			
			return true;
		}
		return false;
	}
	
	/**
	 * Unsubscribe and update the enable flag to false
	 * @param unknown $jobSeeker
	 * @param unknown $jobAlertId
	 */
	public function unSubscribe($jobSeeker, $jobAlertId) {

		if ($this->triggerApi ( $jobSeeker, $jobAlertId)) {
			
			$jobAlert = $this->getEntityManager ()->getRepository ( 'Application\Entity\JobAlert' )->find ( $jobAlertId );
			
			$jobAlert->setEnabledFlag ($jobAlert->getEnabledFlag()==1?0:1);
			
			$this->getEntityManager ()->persist ( $jobAlert );
			$this->getEntityManager ()->flush ();
			
			return true;
		}
		return false;
	}


	/**
	 * Private Method to build and api
	 * @param unknown $jobSeeker
	 * @param unknown $jobAlertId
	 */
	private function triggerApi($jobSeeker, $jobAlertId) {
		$url = ZipRecruiter::$JOB_ALERT;
		$httpClient = new HttpClient ();
		$jobAlert = $this->getEntityManager ()->getRepository ( 'Application\Entity\JobAlert' )->find($jobAlertId);
		
		$subscriberId = $jobSeeker->getSubscriberId ();
		if ($subscriberId != '') {
			$url = ZipRecruiter::$JOB_ALERT . "/" . $subscriberId . "/searches" . "/" . $jobAlert->getSearchId ();
			$response = $httpClient->delete($url, ZipRecruiter::$API_ALERT_KEY );
		}
		if ($response ["statusCode"] >= 200 && $response ["statusCode"] < 300) {
			return true;
		}
		return false;
	}
	
	public function getRecentJobAlert($user) {
		$jobSeeker = $this->getEntityManager ()->getRepository ( 'Application\Entity\JobSeeker' )->find ( $user->getJobSeeker ()->getId () );
		
		$jobAlert = $this->getEntityManager ()->getRepository ( 'Application\Entity\JobAlert' )->findOneBy ( array (
				'jobSeeker' => $jobSeeker 
		), array (
				'id' => 'DESC' 
		) );
		
		if ($jobAlert) {
			return $jobAlert->toArray ();
		} else {
			return null;
		}
	}
	
	/**
	 * Edit the alert request and send delete request to ZR and update the alert_id with new alert settings
	 * @param unknown $jobSeeker
	 * @param unknown $jobAlertId
	 */
	public function edit($jobSeeker,$jobAlertId, $term, $location, $radius)
	{
		if ($this->triggerApi($jobSeeker, $jobAlertId)) {
				
			$dateTime = new \DateTime();
			$subscriberId = $jobSeeker->getSubscriberId();
			$url = ZipRecruiter::$JOB_ALERT. "/" . $subscriberId . "/searches";
			$httpClient = new HttpClient();
			$response = $httpClient->post($url, array(
					"search" => $term,
					"location" => $location,
					"create_time" => $dateTime->format('Y-m-d H:i:s')
			), ZipRecruiter::$API_ALERT_KEY);
				
			if ($response ["statusCode"] >= 200 && $response ["statusCode"] < 300) {
	
				$jobAlert = $this->getEntityManager ()->getRepository ( 'Application\Entity\JobAlert' )->find ( $jobAlertId );
				$subscriber = json_decode($response['data']);
				
				if($subscriberId!='' && isset($subscriber->id)){
					$jobAlert->setSearchId($subscriber->id);
				}
				elseif(isset($subscriber->initial_search_id)){
					$jobAlert->setSearchId($subscriber->initial_search_id);
				}
				$jobAlert->setEnabledFlag(true);
				$jobAlert->setSettingJson(Json::encode(array(
						"title" => $term,
						"location" => $location,
						"radius_miles" => $radius
				)));
				$jobAlert->setDateTimeCreated(new \DateTime());
				$this->getEntityManager()-> persist($jobAlert);
				$this->getEntityManager()->flush();
				return true;
			}
		}
		return false;
	}
}